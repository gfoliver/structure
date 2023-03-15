<?php

namespace Gfoliver\Structure\Providers;

use Gfoliver\Structure\Commands\Organize;
use Gfoliver\Structure\Commands\MakeService;
use Gfoliver\Structure\Commands\MakeRepository;

class StructureProvider extends \Illuminate\Support\ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole())
        {
            $this->commands([
                Organize::class,
                MakeService::class,
                MakeRepository::class
            ]);
        }
    }
}
