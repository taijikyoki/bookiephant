<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'show'])
    ->name('home');

Route::get('/admin', [AdminPanelController::class, 'show'])
    ->middleware('auth')
    ->name('admin');

Route::get('/signin', [HomepageController::class, 'login'])
    ->name('login');

Route::get('/signup', [HomepageController::class, 'registration']);

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/set_filters', [HomepageController::class, 'setFilters']);

Route::post('/do_register', [UserController::class, 'register']);

Route::post('/do_login', [UserController::class, 'login']);

