<?php declare(strict_types=1);

use Crate\Classes\ModuleRegistry;

/**
 * Register Module
 */
citrus(function (ModuleRegistry $registry) {

    $registry->register('welcome', [
        'version'   => '0.1.0',
    ]);

});
