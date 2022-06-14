<?php declare(strict_types=1);

/**
 * Initialize Application
 * ------------------------------------------------------------
 * Crate relies on the in-house Citrus Application Framework,
 * thus we need to initialize it an tell Citrus where the root 
 * directory is located.
 */
$citrus = new Citrus\Framework\Application(__DIR__ . '/../');


/**
 * Load Application Environment
 * ------------------------------------------------------------
 * Now we need to tell Citrus about the basic configuration
 * used for Citrus and the Crate ecosystem. This data MUST be 
 * present as .env file in the root directory.
 */
$citrus->loadEnvironment(null, 'CRATE_ENV');


/**
 * Set Application Paths
 * ------------------------------------------------------------
 * To provide a proper pathing within the whole application, we 
 * need to initialize all available path ids. When changing the 
 * CITRUS_PATHS environment value you've to make sure, that the 
 * required paths stay alive.
 */
$paths = $citrus->getEnvironment('CITRUS_PATHS', null);
if (empty($paths)) {
    throw new RuntimeException("The CITRUS_PATHS environment variable cannot be empty or missing.");
}

$paths = explode(',', $paths);
foreach ($paths AS $path) {
    $key = strtoupper($path);
    if (($value = $citrus->getEnvironment('PATH_' . $key)) === null) {
        throw new RuntimeException("The PATH_$key environment variable cannot be empty or missing.");
    }
    $citrus->setPath($path, $value);
}


/**
 * Load Container Environment
 * ------------------------------------------------------------
 * The last required Citrus step is to load the Application
 * container which provides a neat basic dependency injection 
 * system (see `$citrus->make()` and `$citrus->call()`).
 */
$citrus->loadContainer();


/**
 * Load Bootstrap Before-Hook
 * ------------------------------------------------------------
 * This is the first of two hardcoded file hooks, which allows 
 * to adapt the core environment for usage-specific purposes.
 * Just create the `$/crate/hooks/before.php` file and do 
 * whatever you wanna do.
 */
$citrus->loadBootstrap(':crate/hooks/before.php');


/**
 * Finish Citrus
 * ------------------------------------------------------------
 * After everything is loaded, we can now finalize the set-up 
 * step and passing the RuntimeService class name of the only 
 * required module: '@crate/core'. This RuntimeService handles
 * and bootstraps the Crate environment.
 */
$citrus->finalize(\Crate\Core\Services\RuntimeService::class);


/**
 * Load Bootstrap After-Hook
 * ------------------------------------------------------------
 * This is the second of two hardcoded file hooks, which allows 
 * to adapt the core environment for usage-specific purposes.
 * You should only rely on this files in really specific cases, 
 * usually it is not required to work with this hooks.
 */
$citrus->loadBootstrap(':crate/hooks/after.php');
