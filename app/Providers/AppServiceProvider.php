<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\MaintenanceRequest;
use App\Policies\MaintenanceRequestPolicy;

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
        //
    }

    protected $policies = [
        MaintenanceRequest::class => MaintenanceRequestPolicy::class,
    ];
}
