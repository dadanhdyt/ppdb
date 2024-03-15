<?php

namespace App\Providers;

use App\GlobalDataClass;
use App\Models\DataPrestasi;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Inertia::share('agama', GlobalDataClass::getAgama());
        Inertia::share('pekerjaan', GlobalDataClass::getPekerjaan());

        Gate::define('update_data_prestasi',function(User $user, DataPrestasi $dataPrestasi){
            $prestasi_ids = $user->pendaftaran->dataPrestasi()->pluck('id')->toArray();
            if(in_array($dataPrestasi->id,$prestasi_ids)) {
                return true;
            }
            return false;
        });
    }
}
