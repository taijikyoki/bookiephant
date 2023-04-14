<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;

class HomepageController extends Controller {
    
    public function show (Request $request) {

        $sortBy = session('sortBy', 'id');
        
        $searchByTitle = session('searchByTitle', '');
        $searchByYear = session('searchByYear', '');

        $books = Book::getFiltered($searchByTitle, $searchByYear)->simplePaginate(5);

        $request->session()->reflash();

        return view('home', get_defined_vars());
    }

    public function setFilters (Request $request) {
        
        $request->session()->flash('sortBy', $request->sortBy);
        $request->session()->flash('searchByTitle', $request->title);
        $request->session()->flash('searchByYear', $request->year);
        
        return redirect()->back();
    }

    public function registration () {
        
        $email = '';
        $name = '';
        $pwd = '';
        $cpwd = '';
        
        return view('registration', get_defined_vars());
    }

    public function login () {

        $email = '';
        $pwd = '';
        return view('loginpage', get_defined_vars());
    }
}
