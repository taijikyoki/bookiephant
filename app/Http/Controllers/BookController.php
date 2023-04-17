<?php

namespace App\Http\Controllers;

use App\Enum\BookPublicationType;
use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller {

    protected $guarded = [];

    public function showPage () {

        return view('book.show');
    }

    public function createPage () {

        $authors = Author::get();
        $genres = Genre::get();
        $publication_types = array_column(BookPublicationType::cases(), 'value');

        return view('admin.book.create', get_defined_vars());
     }

    public function editPage (Book $book) {

        return view('admin.book.edit', compact('book'));
    }

    public function setFilters (Request $request) {
        
        $request->session()->flash('sortBy', $request->sortBy);
        $request->session()->flash('searchByTitle', $request->title);
        $request->session()->flash('searchByYear', $request->year);
        $request->session()->flash('searchByAuthor', $request->author);
        $request->session()->flash('searchByGenre', $request->genre);
        
        return redirect()
            ->back();
    }

    public function create (Request $request) {

        $request->validate([
            'title' => 'required|unique:books|max:255',
            'year' => 'required|numeric',
            'author' => 'required',
            'genres' => 'required',
            'publishing_type' => 'required',
        ]);

        $book = new Book();

        
        $book->title = $request->title;
        if ($request->description != '') {
            $book->description = $request->description;
        }

        $book->author()->associate($request->author);

        $book->release_year = $request->year;

        $book->publishing_type = $request->publishing_type;

        $book->save();

        foreach ($request->genres as $genre) {
            $book->genres()->attach($genre);
        }

        return redirect()
            ->route('admin-books')
            ->with('success','Book created successfully.');
    }

    public function update (Request $request, Book $book) {

        $request->validate([
            'title' => 'required',
            'year' => 'required',
            'author' => 'required',
            'publishing_type' => 'required',
        ]);

        $book->update($request->all());

        return redirect()
            ->route('books.show')
            ->with('success','Book updated successfully');
    }

    public function destroy($id) {

        $book = Book::find($id);
        
        $book->delete();

        return redirect()
            ->back()
            ->with('success', 'Book deleted successfully');
    }
}
