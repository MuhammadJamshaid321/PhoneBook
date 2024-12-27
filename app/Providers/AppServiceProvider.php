<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ContactRepository;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(
        \App\Repositories\ContactRepository::class
    );
}
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
