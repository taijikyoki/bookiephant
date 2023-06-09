<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GenreController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// if registered as author
Route::post('/author/get_token', [AuthorController::class, 'get_token']);

// if not registered
Route::post('/author/reg_token', [AuthorController::class, 'register']);

Route::group(['as' => 'api.'], function () {
  Route::get('/books/{id}', [BookController::class, 'show']);

  Route::get('/books', [BookController::class, 'list']);

  Route::get('/authors', [AuthorController::class, 'list']);

  Route::get('/authors/{id}', [AuthorController::class, 'show']);

  Route::get('/genres', [GenreController::class, 'list']);

  Route::middleware(['auth:sanctum', 'abilities:author'])
    ->group(function () {

      Route::delete('books/{id}', [BookController::class, 'destroy']);
   
      Route::put('books/{id}', [BookController::class, 'update']);

      Route::post('books/create', [BookController::class, 'create']);
      
      Route::put('authors/{id}', [AuthorController::class, 'update']);
    });
});
