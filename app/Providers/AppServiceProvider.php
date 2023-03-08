<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        Str::macro('rupiah', function ($value) {
            return 'Rp. ' . \number_format($value, 0, ',', '.');
        });

        Gate::define('admin', function (User $user) {
            return $user->status == 1;
        });

        Gate::define('reception', function (User $user) {
            return $user->status == 2;
        });
    }
}
