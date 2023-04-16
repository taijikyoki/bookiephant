<?php

use App\Http\Controllers\AdminPanelController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

use Illuminate\Support\Facades\Route;

Route::get('/', [HomepageController::class, 'show'])
    ->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/', [AdminPanelController::class, 'showBooks'])
    ->middleware('auth')
    ->name('admin-home');
});

Route::get('/signin', [LoginController::class, 'show'])
    ->name('login');

Route::get('/signup', [RegistrationController::class, 'show'])
    ->name('register');

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/set_filters', [BookController::class, 'setFilters']);

Route::post('/do_register', [UserController::class, 'register']);

Route::post('/do_login', [UserController::class, 'login']);

