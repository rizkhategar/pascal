<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // 1. Wajib Import Facade View
use App\Models\AcademicProgram;      // 2. Wajib Import Model AcademicProgram

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
        // 3. Suntikkan data menu akademik secara dinamis hanya ke komponen header
        View::composer('component.header', function ($view) {
            $view->with('academicProgramsNav', AcademicProgram::select('name', 'slug')->get());
        });
    }
}
