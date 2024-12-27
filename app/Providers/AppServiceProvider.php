<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ContactRepository;
use App\Facades\ContactRepositoryFacade;
use Illuminate\Pagination\Paginator;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
    $this->app->singleton(ContactRepository::class);
}
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFive();
        Paginator::useBootstrapFour();
    }
}
