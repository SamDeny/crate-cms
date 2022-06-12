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
 * Finish Citrus
 * ----------------------------------------
 */
$citrus->finalize(\Crate\Core\Services\RuntimeService::class);
