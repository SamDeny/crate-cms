<?php declare(strict_types=1);

/**
 * Initialize Application
 * ----------------------------------------
 */
$citrus = new Citrus\Framework\Application(__DIR__ . '/../');


/**
 * Load Application Environment
 * ----------------------------------------
 */
$citrus->loadEnvironment(null, 'CRATE_ENV');


/**
 * Load Application Configuration
 * ----------------------------------------
 */
$citrus->loadConfiguration(__DIR__ . '/../config');


/**
 * Load Container Environment
 * ----------------------------------------
 */
$citrus->loadContainer();


/**
 * Set Application Paths
 * ----------------------------------------
 */
$citrus->setPaths($citrus->getConfiguration('paths'));


/**
 * Set Basic Factories
 * ----------------------------------------
 */
$citrus->setFactories([
    \Crate\Database\Connection::class   => \Crate\Factories\ConnectionFactory::class,
    \Crate\Mailer\Mailer::class         => \Crate\Factories\MailerFactory::class
]);


/**
 * Set Basic Services
 * ----------------------------------------
 */
$citrus->setServices([
    'session'       => \Crate\Services\SessionService::class,
    'runtime'       => \Crate\Services\RuntimeService::class
]);


/**
 * Set Basic Aliases
 * ----------------------------------------
 */
$citrus->setAliases([
    'mailer'        => \Crate\Mailer\Mailer::class,
    'mail'          => \Crate\Mailer\Mail::class,
    'modules'       => \Crate\Modules\ModuleRegistry::class
]);


/**
 * Finish Citrus
 * ----------------------------------------
 */
$citrus->finalize(\Crate\Services\RuntimeService::class);



citrus(function(\Citrus\Router\Router $router) {
    $router->get('/', function() {
        $response = new \Citrus\Http\Response();
        $response->setJSON(['hello' => 'world']);
        return $response;
    });
});
