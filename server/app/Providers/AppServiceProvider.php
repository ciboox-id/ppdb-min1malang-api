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

        Gate::define('verifikator', function (User $user) {
            $verifikator_names = ['Admin PPDB MIN 1 Malang', 'HELPDESK', 'VINA', 'ADI', 'QONITA', 'NAKHEL', 'YAQIN', 'ELOK', 'YULI', 'OKTA', 'AZAM', 'RIZAL'];

            return in_array($user->nama_lengkap, $verifikator_names);
        });

        Gate::define('pemetaan', function (User $user) {
            $pemetaan_names = [
                "zahrotul_musailin@tahfidz.com",
                "ahmad_syahrul@tahfidz.com",
                "fadli@tahfidz.com",
                "fahmi_abdul@tahfidz.com",
                "hasanuddin@agama.com",
                "khoirul@agama.com",
                "imam@agama.com",
                "cici@agama.com",
                "shafraji@agama.com",
                "elly@agama.com",
                "jamaarif@agama.com",
                "nur@agama.com",
                "wahyu@agama.com",
                "irfan@agama.com",
                "rachmawati@agama.com",
                "kasyful@agama.com",
                "dwi@agama.com",
                "rokhimaningsih@agama.com",
                "umi@agama.com",
                "nafisatul@agama.com",
                "anizakiyah@umum.com",
                "ismawati@umum.com",
                "fauriza@umum.com",
                "naimatul@umum.com",
                "susmiyati@umum.com",
                "mutamimah@umum.com",
                "nurul@umum.com",
                "qudriyatul@umum.com",
                "sri@umum.com",
                "khusnul@umum.com",
                "qonitah@umum.com",
                "nanik@umum.com",
                "indah@umum.com",
                "fitrah@umum.com",
                "siti@umum.com",
                "ika@umum.com"
            ];

            return strpos($user->email, 'umum') !== false || strpos($user->email, 'agama') !== false || strpos($user->email, 'tahfidz') !== false;
        });

        Gate::define('umum', function (User $user) {
            $umum_names = [
                "anizakiyah@umum.com",
                "ismawati@umum.com",
                "fauriza@umum.com",
                "naimatul@umum.com",
                "susmiyati@umum.com",
                "mutamimah@umum.com",
                "nurul@umum.com",
                "qudriyatul@umum.com",
                "sri@umum.com",
                "khusnul@umum.com",
                "qonitah@umum.com",
                "nanik@umum.com",
                "indah@umum.com",
                "fitrah@umum.com",
                "siti@umum.com",
                "ika@umum.com"
            ];
            return strpos($user->email, 'umum') !== false;
        });

        Gate::define('agama', function (User $user) {
            $agama_names = [
                "hasanuddin@agama.com",
                "khoirul@agama.com",
                "imam@agama.com",
                "cici@agama.com",
                "shafraji@agama.com",
                "elly@agama.com",
                "jamaarif@agama.com",
                "nur@agama.com",
                "wahyu@agama.com",
                "irfan@agama.com",
                "rachmawati@agama.com",
                "kasyful@agama.com",
                "dwi@agama.com",
                "rokhimaningsih@agama.com",
                "umi@agama.com",
                "nafisatul@agama.com",
            ];

            return strpos($user->email, 'agama') !== false;
        });

        Gate::define('tahfidz', function (User $user) {
            $tahfidz_names = [
                "zahrotul_musailin@tahfidz.com",
                "ahmad_syahrul@tahfidz.com",
                "fadli@tahfidz.com",
                "fahmi_abdul@tahfidz.com",
            ];

            return strpos($user->email, 'tahfidz') !== false;
        });

        Gate::define('helpdesk', function (User $user) {
            return strpos($user->email, 'helpdesk') !== false;
        });

        Gate::define('superadmin', function (User $user) {
            return $user->email == "admin@gmail.com";
        });
    }
}
