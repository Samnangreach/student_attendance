<?php

namespace App\Providers;
use App\Models\Classes;
use Illuminate\Support\Facades\View; 
use Illuminate\Support\ServiceProvider;

class SidebarServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot()
    {
        // $classes = Classes::with('students')->get();
        // return view('dashboard', compact('classes'));
    }
}
