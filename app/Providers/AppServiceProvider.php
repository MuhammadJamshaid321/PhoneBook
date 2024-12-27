<?php

namespace App\Providers;
use Illuminate\Support\ServiceProvider;
use App\Repositories\ContactRepository;
<<<<<<< HEAD
=======
use App\Facades\ContactRepositoryFacade;
use Illuminate\Pagination\Paginator;
>>>>>>> 3d6ff3b (Facades Pattern and Pagination Added)
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
{
<<<<<<< HEAD
    $this->app->singleton(
        \App\Repositories\ContactRepository::class
    );
=======
    $this->app->singleton(ContactRepository::class);
>>>>>>> 3d6ff3b (Facades Pattern and Pagination Added)
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
