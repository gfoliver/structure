<?php

namespace Gfoliver\Structure\Providers;

use Gfoliver\Structure\Commands\Organize;

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
            ]);
        }
    }
}
