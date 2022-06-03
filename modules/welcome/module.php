<?php declare(strict_types=1);

use Crate\Extensions\ModuleRegistry;

/**
 * Register Module
 */
citrus(function (ModuleRegistry $registry) {

    $registry->register('welcome', [
        'version'   => '0.1.0',
    ]);

});
