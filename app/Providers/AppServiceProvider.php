<?php

namespace App\Providers;

use App\Models\AppSetting;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

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
        // Implicitly grant "Super Admin" role all permissions
        // This works in the app by using gate-related functions like $user->can()
        Gate::before(function ($user, $ability) {
            return $user->hasRole('Super Admin') ? true : null;
        });

        view()->composer('*', function ($view) {
            try {
                if (Schema::hasTable('app_settings')) {
                    $settings = AppSetting::first() ?? new AppSetting([
                        'app_name' => 'UNEMO Universitas Modern',
                        'primary_color' => '#1e3a8a',
                        'secondary_color' => '#d97706',
                    ]);
                } else {
                    $settings = new AppSetting([
                        'app_name' => 'UNEMO Universitas Modern',
                        'primary_color' => '#1e3a8a',
                        'secondary_color' => '#d97706',
                    ]);
                }
            } catch (\Throwable $e) {
                $settings = new AppSetting([
                    'app_name' => 'UNEMO Universitas Modern',
                    'primary_color' => '#1e3a8a',
                    'secondary_color' => '#d97706',
                ]);
            }
            $view->with('settings', $settings);
        });
    }
}
