<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminPanelController extends Controller {

    public function showBooks (Request $request) {

        $sortBy = session('sortBy', 'id');
        
        $searchByTitle = session('searchByTitle', '');
        $searchByYear = session('searchByYear', '');
        $searchByAuthor = session('searchByAuthor', '');
        $searchByGenre = session('searchByGenre', '');

        $books = Book::getFiltered($searchByTitle, $searchByYear, $searchByAuthor, $searchByGenre)
            ->simplePaginate(10);

        $request->session()->flash('administrate');

        $request->session()->reflash();

        return view('admin.books', get_defined_vars());
    }
}
