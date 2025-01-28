<?php

namespace App\Providers;

use App\Services\BreadcrumbService;
use App\Services\Sorter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BreadcrumbService::class, function ($app){
            return new BreadcrumbService();
        });
        $this->app->singleton(Sorter::class, function ($app){
            return new Sorter();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
