<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Carbon::setLocale(config('app.locale'));
        date_default_timezone_set(config('app.timezone'));

        view()->composer('cms.nav', function($view) {
            $view->with('navGroups', \App\NavGroup::all());
            $view->with('entities', \App\Entity::all());
            $view->with('settings', \App\Settings::all()->first());
        });

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        
    }
}
