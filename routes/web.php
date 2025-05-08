<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArticleController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/deepseek', function () {
    return view('template_dipsik');
});

Route::resource('articles', ArticleController::class);
