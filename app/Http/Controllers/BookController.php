<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function show ($id) {
        return Book::findOrFail($id)->title;
    }

    public function setFilters (Request $request) {
        
        $request->session()->flash('sortBy', $request->sortBy);
        $request->session()->flash('searchByTitle', $request->title);
        $request->session()->flash('searchByYear', $request->year);
        $request->session()->flash('searchByAuthor', $request->author);
        $request->session()->flash('searchByGenre', $request->genre);
        
        return redirect()->back();
    }
}
