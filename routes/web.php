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
    Route::get('/books', [AdminPanelController::class, 'showBooks'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-books');

    Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-delete-book');

    Route::get('/books/create', [BookController::class, 'createPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-create-book');

    Route::get('/books/edit/{id}', [BookController::class, 'editPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-edit-book');

    Route::post('/create_book', [BookController::class, 'create'])
        ->middleware('auth')
        ->middleware('admin');

    Route::put('/update_book/{id}', [BookController::class, 'update'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-update-book');
});
    

Route::get('/signin', [LoginController::class, 'show'])
    ->name('login');

Route::get('/signup', [RegistrationController::class, 'show'])
    ->name('register');

Route::get('/logout', [UserController::class, 'logout']);

Route::post('/set_filters', [BookController::class, 'setFilters']);

Route::post('/do_register', [UserController::class, 'register']);

Route::post('/do_login', [UserController::class, 'login']);

Route::get('/book/{id}', [BookController::class, 'showPage'])
    ->name('show-book');

