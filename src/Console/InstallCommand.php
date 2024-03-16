<?php

namespace Helpers\ApiHelpers\Console;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

class InstallCommand extends Command
{
    protected $signature = 'api-helpers:install';

    protected $description = 'Install Api Helpers traits';

    public function handle(): int
    {
        return $this->installApiHelpers();
    }

    protected function installApiHelpers()
    {
        //Controllers...
        (new Filesystem)->ensureDirectoryExists(app_path('Http/Controllers'));
        (new Filesystem)->copy(__DIR__ . '/../../app/Http/Controllers/Controller.php', app_path('Http/Controllers/Controller.php'));

        //Providers...
        (new Filesystem)->ensureDirectoryExists(app_path('Providers'));
        (new FileSystem)->copy(__DIR__ . '/../../app/Providers/RouteServiceProvider.php', app_path('Providers/RouteServiceProvider.php'));

        //Traits...
        (new FileSystem)->ensureDirectoryExists(app_path('Traits'));
        (new FileSystem)->copyDirectory(__DIR__ . '/../../app/Traits', app_path('Traits'));

        //Routes...
        copy(__DIR__ . '/../../routes/api.php', base_path('routes/api.php'));

        $this->components->info('Yor api helpers installed');

        return 1;
    }
}
