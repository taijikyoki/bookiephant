<?php

namespace App\Http\Controllers;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class AdminPanelController extends Controller {

    public function show (Request $request) {

        $sortBy = session('sortBy', 'id');
        
        $searchByTitle = session('searchByTitle', '');
        $searchByYear = session('searchByYear', '');

        $books = Book::getFiltered($searchByTitle, $searchByYear)->simplePaginate(5);

        $request->session()->reflash();

        return view('admin', get_defined_vars());
    }
}
