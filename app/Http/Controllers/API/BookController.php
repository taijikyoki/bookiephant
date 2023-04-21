<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookCollection;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\PersonalAccessToken;

class BookController extends Controller {

    public function show (Request $request, int $id) {

        $book = Book::find($id);

        if (!$book) {
            return [
                'error' => 'book not found',
            ];
        }

        return [
            'id'    => $book->id,
            'title' => $book->title,
            'author'=> $book->author,
            'genres'=> $book->genres,
            'year'  => $book->release_year,
            'type'  => $book->publishing_type,
        ];
    }

    public function list(Request $request) {

        $books = Book::paginate(5);

        return new BookCollection($books);
    }

    public function destroy(Request $request, int $id) {

        $book = Book::find($id);
    
        if (!$book) {
          return [
            'error' => 'book not found',
          ];
        }

        if (PersonalAccessToken::findToken($request->bearerToken())->tokenable->author->id != $book->author->id) {
            return [
                'error' => 'you are not author of this book',
            ];
        }
    
        $book->delete();

        Log::info('Book deleted', [
            'id' => $id,
        ]);
    
        return [
          'success' => 'book '. $id . ' successfully deleted',
        ];
    
    }

    public function update (Request $request, int $id) {
    
        $book = Book::find($id);
    
        if (!$book) {
          return [
            'error' => 'book not found',
          ];
        }

        if (PersonalAccessToken::findToken($request->bearerToken())->tokenable->author->id != $book->author->id) {
            return [
                'error' => 'you are not author of this book',
            ];
        }
    
        $validator = Validator::make($request->all(), [
          'title' => 'unique:books, title, {$book->id}|max:255',
          'year' => 'numeric',
        ]);    
        
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 401);
        }
    
        $book->title = $request->title ? $request->title : $book->title;
        if ($request->description != '') {
            $book->description = $request->description;
        }
    
        $book->release_year = $request->year ? $request->year : $book->year;
    
        $book->publishing_type = $request->publishing_type ? $request->publishing_type : $book->publishing_type;
    
        $book->save();
    
        if ($request->genres) {
            $book->genres()->detach();
    
            foreach ($request->genres as $genre) {
                $book->genres()->attach($genre);
            }
        }
        
        Log::info('Book updated', [
            'book' => $book,
        ]);

        return [
          'success' => 'book '. $id . ' successfully updated',
        ];
    
    }
}
