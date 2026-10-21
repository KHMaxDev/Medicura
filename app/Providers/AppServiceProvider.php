<?php

namespace App\Providers;

use App\Models\Cita;
use App\Models\Tratamiento;
use App\Policies\CitaPolicy;
use App\Policies\TratamientoPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Gate::policy(Cita::class, CitaPolicy::class);
        Gate::policy(Tratamiento::class, TratamientoPolicy::class);
    }
}
