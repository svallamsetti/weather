<?php

namespace App\Providers;

use App\SearchHistoryRepository\SearchHistoryContract;
use App\SearchHistoryRepository\SearchHistoryEloquent;
use App\WeatherRepository\WeatherContract;
use App\WeatherRepository\WeatherRESTImplementation;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->instance(WeatherContract::class, resolve(WeatherRESTImplementation::class));
        $this->app->instance(SearchHistoryContract::class, resolve(SearchHistoryEloquent::class));
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('Weather.components.zip-code', 'zip-code');
        Blade::component('Weather.components.weather-card', 'weather-card');
        Blade::component('Weather.components.search-history', 'search-history');
    }
}
