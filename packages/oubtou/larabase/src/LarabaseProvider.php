<?php

namespace Oubtou\Larabase;

use Illuminate\Support\ServiceProvider;

class LarabaseProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        include __DIR__.'/modulecreator/routes.php';
        include __DIR__.'/translator/routes.php';
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('Oubtou\Larabase\ModuleCreator\ModuleCreatorController');
        $this->loadViewsFrom( __DIR__.'/modulecreator/views', 'ModuleCreator');
        
        $this->app->make('Oubtou\Larabase\Translator\TranslatorController');
        $this->loadViewsFrom( __DIR__.'/translator/views', 'Translator');
    }
}
