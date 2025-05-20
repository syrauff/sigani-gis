<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\PortalController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PortalController::class, 'index'])->name('main');
Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');
Route::get('/all-news', [PortalController::class, 'allNews'])->name('all-news');
Route::get('/article-view/{slug}', [PortalController::class, 'articleView'])->name('article_view');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::Resource('article', ArticleController::class);

require __DIR__.'/auth.php';
