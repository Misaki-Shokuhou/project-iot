<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
<<<<<<< HEAD
use Illuminate\Support\Facades\DB;
=======
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a

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
<<<<<<< HEAD
        DB::statement("SET time_zone = '+08:00';");
=======
        //
>>>>>>> a8bc0e0b061f5b185dea85b86e4b70077253247a
    }
}
