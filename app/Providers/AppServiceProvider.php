<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Lib\AHelper;
class AppServiceProvider extends ServiceProvider{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(){
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(){
        $this->app['ahelperclass'] = $this->app->share(function($app){
            return new AHelper;
        });
        $this->app['mailwebgisclass'] = $this->app->share(function($app){
            return new MailWebGIS;
        });

        $this->app->booting(function(){
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('AHelper', 'App\Lib\Facades\AHelperClass');
            $loader->alias('MailWebGIS', 'App\Lib\Facades\MailWebGISClass');
        });
    }
}
