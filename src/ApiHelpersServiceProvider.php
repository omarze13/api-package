<?php

namespace Helpers\ApiHelpers;

use Illuminate\Support\ServiceProvider;

class ApiHelpersServiceProvider extends ServiceProvider
{
    public function register(): void
    {

    }

    public function boot(): void
    {
        if (!$this->app->runningInConsole()) {
            return;
        }

        $this->commands([
            Console\InstallCommand::class,
        ]);
    }
}
