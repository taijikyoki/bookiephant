<?php

namespace App\Http\Controllers;

use App\Models\Book;

class BookController extends Controller {
    public function show ($id) {
        return Book::findOrFail($id)->title;
    }
}
