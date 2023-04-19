<?php

use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegistrationController;

use Illuminate\Support\Facades\Route;

Route::get('/', [BookController::class, 'showBooksCommon'])
    ->name('home');

Route::prefix('admin')->group(function () {
    Route::get('/books', [BookController::class, 'showBooksAdmin'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-books');

    Route::get('/genres', [GenreController::class, 'showGenresAdmin'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-genres');

    Route::get('/authors', [AuthorController::class, 'showAuthorsAdmin'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-authors');

    Route::delete('/books/delete/{id}', [BookController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-delete-book');
    
    Route::delete('/genres/delete/id/{id}', [GenreController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-delete-genre');

    Route::delete('/authors/delete/id/{id}', [AuthorController::class, 'destroy'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-delete-author');

    Route::get('/books/create', [BookController::class, 'createPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-create-book');

    Route::get('/genres/create', [GenreController::class, 'createPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-create-genre');

    Route::get('/authors/create', [AuthorController::class, 'createPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-create-author');

    Route::get('/books/edit/id/{id}', [BookController::class, 'editPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-edit-book');
    
    Route::get('/genres/edit/id/{id}', [GenreController::class, 'editPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-edit-genre');

    Route::get('/authors/edit/id/{id}', [AuthorController::class, 'editPage'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-edit-author');

    Route::post('/create_book', [BookController::class, 'create'])
        ->middleware('auth')
        ->middleware('admin');
    
    Route::post('/create_genre', [GenreController::class, 'create'])
        ->middleware('auth')
        ->middleware('admin');
    
    Route::post('/create_author', [AuthorController::class, 'create'])
        ->middleware('auth')
        ->middleware('admin');

    Route::put('/update_book/id/{id}', [BookController::class, 'update'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-update-book');

    Route::put('/update_genre/id/{id}', [GenreController::class, 'update'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-update-genre');

    Route::put('/update_author/id/{id}', [AuthorController::class, 'update'])
        ->middleware('auth')
        ->middleware('admin')
        ->name('admin-update-author');
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

