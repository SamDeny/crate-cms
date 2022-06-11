<?php declare(strict_types=1);

namespace Crate\Services;

use Citrus\Concerns\Service;
use Crate\Modules\ModuleRegistry;

class RuntimeService extends Service
{

    public function bootstrap()
    {
        $registry = $this->application->make(ModuleRegistry::class);
        $registry->init();
        $registry->load('@crate/core');
    }

    public function finalize()
    {
        
    }

}
