<?php declare(strict_types=1);

/**
 * Create a new Citrus Application
 * ---
 * Citrus is the main application runtime / framework, so the secret power 
 * behind Crate. While Crate is a heavily modified version of Cockpit CMS, 
 * Citrus is an own development, which replaces Cockpit's Lime Framework. 
 */
$crate = new \Citrus\Framework\Application(__DIR__ . '/../');


/**
 * Prepare Citrus
 * ---
 * Citrus is designed as stand-alone application, and does NOT rely on Crate
 * directly, thus we need to configure Citrus like we would do it with other 
 * Frameworks like Laravel or Simfony.
 * 
 * Environment variables can be received using the global `env('ENV')` function, 
 * similar with the configurations using `config('config')`. Sounds familar? 
 * Yeah, we're into Laravel as well ;)
 */
$crate->loadEnv();
$crate->configure('$/config');


/**
 * Setup Dependency Injection
 * ---
 * Dependency Injection allows us to autowire required class dependencies 
 * directly within the function itself instead of instantiate / receive every 
 * single class on our own. While Citrus already offers a basic dependency 
 * injection container, Crate still rely on PHP-DI for a better performance.
 */
$build = new \DI\ContainerBuilder();
if ($crate->getEnvironment() === 'production') {
    $build->enableCompilation($crate->cachePath());
    $build->writeProxiesToFile(true, $crate->cachePath('/proxies'));
}
$crate->setContainer($build->build());


/**
 * Register Factories
 * ---
 * Factories are classes, which builds and instantiate the corresponding classes 
 * used within Citrus. A Factory is always connected to a single class, thus 
 * you cannot only declare new ones, but also overwrite existing ones. Crate 
 * does this to take over the Reqest / Response handling.
 * 
 * Factories can be received by dependency-injection (when a container is set) 
 * or using the `citrus()->factory(`\Class\Path\To\Factory`)` syntax.
 * PS.: Or the shorthand `citrus('\Class\Path\To\Factory')` syntax.
 */
$crate->registerFactories([
    
    // Overwrite Request / Response classes
    \Citrus\Factories\RequestFactory::class     => \Crate\Http\Request::class,
    \Citrus\Factories\ResponseFactory::class    => \Crate\Http\Response::class,
    
    // Provide own Factories in the same syntax
    \Crate\Factories\MailerFactory::class       => \Crate\Mailer\Mailer::class,
    \Crate\Factories\DatabaseFactory::class     => \Crate\Database\Database::class,

]);


/**
 * Register Services
 * ---
 * Services are function-classes, which extends or overwrite the core features 
 * of Citrus. Crate provides a bunch of those feature-classes and also 
 * overwrites the RouteCollector and Route classes to extend those.
 * 
 * Services can be received by dependency-injection (when a container is set) 
 * or using the `citrus()->service('\Class\Path\To\Service')` syntax.
 * PS.: Or the shorthand `citrus('alias')` syntax.
 */
$crate->registerServices([

    // Overwrite Citrus services using core -> overwritten class syntax
    \Citrus\Router\Collector::class => \Crate\Http\RouteCollector::class,
    \Citrus\Router\Route::class     => \Crate\Http\Route::class,

    // Provide own services using alias -> class syntax
    'mail'                          => \Crate\Mailer\Mail::class,
    'mailer'                        => \Crate\Mailer\Mailer::class,
    'database'                      => \Crate\Database\Database::class,
    'connections'                   => \Crate\Database\ConnectionPool::class,

]);


/**
 * Register Routes
 * ---
 * Crate itself takes care about user accounts, policies, authentication, 
 * authorization as well as different kind of tokens. Thus we need to apply 
 * the respective rules, so the Crate modules can take use of them.
 * 
 * We use the global `citrus()` handler to call a Closure, this will ensure,
 * that the passed dependencies / parameters are passed as expected.
 */
citrus(function(\Crate\Http\RouteCollector $collector) {
    $collector->var = 3;
    /*
    $collector->get('/', \Crate\Controllers\CrateController::class);

    $collector->group([
        'api'   => true,
        'cli'   => true
    ], function(\Citrus\Router\Collector $collector) {
        $collector->ctrl('/users', \Crate\Controllers\UsersController::class);
        $collector->ctrl('/policies', \Crate\Controllers\PoliciesController::class);
    });
    */
});


/**
 * Inject Crate Environment
 * ---
 * Finally, we need to build up all required structured for the Crate system. 
 * This includes the Event/Dispatcher environment, Localization and Middleware 
 * classes as well as the installed modules.
 */
citrus(function() {

});


/**
 * Finish Setup
 * ---
 * Let us finish the Citrus -> Crate setup. This method will check, update and 
 * invalidates all used caches and ensures that your Crate project is as fast
 * and active as possible.
 */
$crate->finish();
