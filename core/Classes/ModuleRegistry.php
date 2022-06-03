<?php declare(strict_types=1);

namespace Crate\Classes;


class ModuleRegistry 
{

    /**
     * Register a new Module.
     *
     * @param string $module_id
     * @param array $module_data
     * @return Module
     */
    public function register(string $module_id, array $module_data = []): Module
    {
        return new Module;
    }

    /**
     * Undocumented function
     *
     * @param string $module
     * @return boolean
     */
    public function isEnabled(string $module): bool
    {
        return false;
    }

    /**
     * Undocumented function
     *
     * @param string $module
     * @return boolean
     */
    public function isDisabled(string $module): bool
    {
        return false;
    }

}
