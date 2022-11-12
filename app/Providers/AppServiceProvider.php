<?php

namespace App\Providers;

use App\Models\User;
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
        Paginator::useBootstrapFive();

        Gate::define('admin', function (User $user) {
            return $user->jabatan == 'Admin';
        });
        Gate::define('master', function (User $user) {
            return $user->jabatan == 'Master Admin';
        });
        Gate::define('pimpinan', function (User $user) {
            return $user->jabatan == 'Pimpinan';
        });
        Gate::define('produksi', function (User $user) {
            return $user->jabatan == 'Produksi';
        });
    }
}
