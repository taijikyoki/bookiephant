<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller {

    public function create (Request $request) {

        $request->validate([
            'name' => 'required|unique:authors|max:64',
        ]);

        $author = new Author();
        
        $author->name = $request->name;

        $author->save();

        return redirect()
            ->route('admin-authors')
            ->with('success','Author created successfully.');
    }

    public function update (Request $request, $id) {

        $request->validate([
            'name' => 'required|unique:authors, name, {$author->id}|max:64',
        ]);

        $author = Author::find($id);

        $author->name = $request->name;

        $author->save();

        return redirect()
            ->route('admin-authors')
            ->with('success','Author updated successfully');
    }

    public function destroy($id) {

        $author = Author::find($id);
        
        $author->delete();

        return redirect()
            ->back()
            ->with('success', 'Author deleted successfully');
    }

    public function createPage () {

        $authors = Author::get();

        return view('admin.author.create', get_defined_vars());
    }

    public function editPage ($id) {

        $author = Author::find($id);

        return view('admin.author.edit', get_defined_vars());
    }

    public function showAuthorsAdmin (Request $request) {

        $authors = Author::simplePaginate(10);

        $request->session()->reflash();

        return view('admin.authors', get_defined_vars());
    }
}
