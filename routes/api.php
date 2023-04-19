<?php

use App\Http\Controllers\API\AuthorController;
use App\Http\Controllers\API\BookController;
use App\Http\Controllers\API\GenreController;

use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;
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
  Route::get('/books', function () {
    return BookResource::collection(Book::all());
  });
  //   ->middleware(['auth:sanctum', 'abilities:author']);
});

Route::middleware('auth:sanctum')->get('/books/{id}', function (Request $request, $id) {
  return BookResource::make(Book::find($id));
});
