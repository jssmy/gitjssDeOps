<?php

namespace GitScrum\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use GitScrum\Classes\Github;
use GitScrum\Classes\Trello;
use GitScrum\Classes\Google;

use Config;

class AppServiceProvider extends ServiceProvider
{ 
    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Relation::morphMap(Config::get('database.relation'));
    }

    /** 
     * Register any application services.
     */
    public function register()
    {
        foreach (Config::get('app.services') as $service) {
            $this->app->singleton($service, function () use ($service) {
                $namespace = 'GitScrum\\Services\\' . $service;
                //echo "$namespace";
                return new $namespace();
            });
        }

        $this->app->singleton('Github', function () {
            return new Github();
        });
        $this->app->singleton('Google', function () {
            return new Google();
        });
        $this->app->singleton('Trello', function () {
            return new Trello();
        });
    }

    public function provides()
    {
        return ['Github','Google','Trello'];
    }
}
