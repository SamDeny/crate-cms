<?php declare(strict_types=1);

/**
 * Create a new Citrus Application
 * ---
 * Citrus is the main application runtime / framework, so the secret power 
 * behind Crate. It handles many basic functions, such as the HTTP Request and 
 * Response handling, but also Log, Event and Route features.
 */
$crate = new \Citrus\Framework\Application(__DIR__ . '/../');


/**
 * Prepare Citrus
 * ---
 * Citrus is designed as independent library and does NOT directly rely on Crate
 * itself. Thus we need to configure Citrus in the same way as we would do it 
 * with other Frameworks like Laravel or Simfony.
 */
$crate->loadEnvironment();


/**
 * Setup Directory Structure
 * ---
 * Citrus does not provide a strict folder structure, thus we need to tell it 
 * which paths we would like to have, the $ symbol indicates the root folder. 
 * We can use the alias in the Citrus->getPath() or shortcut path() function.
 */
$crate->setDirectories([
    'crate'         => '$/crate',
    'public'        => '$/public',
    'storage'       => '$/storage',
    'cache'         => '$/storage/cache',
    'tmp'           => '$/storage/tmp'
]);


/**
 * Setup Dependency Injection
 * ---
 * With Dependency Injection we're able to autowire required classes directly 
 * within the function / class arguments itself and do not need to instantiate 
 * them on our own. That's pretty handy. Citrus uses PHP-DI for this.
 */
$crate->initContainer();


/**
 * Setup Runtime Service
 * ---
 * The primary Runtime Service is a lowlevel class, which prepares the desired 
 * system and runs together with the Citrus core itself. Using a Runtime Service 
 * is optional, you can also directly work with Citrus here as well.
 */
$crate->useRuntimeService(\Crate\Core\Services\RuntimeService::class);


/**
 * Finish Setup
 * ---
 * Let us finish the Citrus -> Crate setup. This method will check, update and 
 * invalidates all used caches and ensures that your Crate project is as fast
 * and active as possible.
 */
$crate->finish();
