<?php

namespace App\Providers;
use App\Models\Classes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View; 
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
        // $classes = Classes::with('students')->get();

        // // Share the data with all views
        // View::share('classes', $classes);

        View::composer('*', function ($view) {
            $user = Auth::user();
    
            // // Only load assigned classes if user is authenticated and has classes
            // if ($user && $user->role === 'teacher' && $user->teacher) {
            //     // Access classes through teacher
            //     $classes = $user->teacher->classes()->with('students')->get();
            // } else {
            //     $classes = collect(); // Return empty if not a teacher or not logged in
            // }

            if ($user && $user->role === 'teacher' && $user->teacher) {
                $teacherClasses = $user->teacher->classes()->with('students')->get();
            } else {
                $teacherClasses = collect(); // Empty if not a teacher
            }
    
            $view->with('teacherClasses', $teacherClasses);
        });
    }
}
