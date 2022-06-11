<?php declare(strict_types=1);

/**
 * Load Composer | Vendors
 * ----------------------------------------
 */
require_once __DIR__ . '/../vendor/autoload.php';


/**
 * Bootstrap Application
 * ----------------------------------------
 */
require_once __DIR__ . '/../crate/bootstrap.php';


/**
 * Run Application
 * ----------------------------------------
 */
citrus()->run();
