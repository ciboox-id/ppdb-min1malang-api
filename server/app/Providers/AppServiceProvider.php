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
        Paginator::useBootstrap();

        Gate::define('admin', function (User $user) {
            return $user->role == "admin";
        });

        Gate::define('siswa', function (User $user) {
            return $user->role == "siswa";
        });

        Gate::define('verifikator', function(User $user) {
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK' ,'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];

            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('pemetaan', function(User $user) {
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK' ,'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];

            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('umum', function(User $user){
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK' ,'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];
            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('agama', function(User $user){
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK' ,'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];
            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('tahfidz', function(User $user){
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK' ,'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];
            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('superadmin', function (User $user) {
            return $user->nama_lengkap == "Admin PPDB MIN 1 Malang";
        });
    }
}
