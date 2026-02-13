<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator; // Tambahan opsional untuk styling pagination

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
        // Jika kamu ingin memaksa redirect global bisa diatur di sini, 
        // tapi Breeze biasanya sudah otomatis membaca rute 'dashboard'
    }
}