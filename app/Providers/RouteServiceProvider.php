<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Article;
use Illuminate\Support\Facades\Route;

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
        parent::boot();

        // Binding model Article dengan slug
        Route::bind('article', function ($value) {
            return Article::where('slug', $value)->firstOrFail();
        });
    }
}
