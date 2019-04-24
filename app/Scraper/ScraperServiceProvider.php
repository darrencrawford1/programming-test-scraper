<?php

namespace App\Scraper;

use Illuminate\Support\ServiceProvider;

class ScraperServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(__DIR__ . '/Providers/*.php') as $file) {
            $baseName = strtolower(basename($file, '.php'));
            $className = __NAMESPACE__ . "\Providers\\" . (basename($file, '.php'));
            $instance =  app($className);

            $this->app->instance($baseName, $instance);
        }
    }
}
