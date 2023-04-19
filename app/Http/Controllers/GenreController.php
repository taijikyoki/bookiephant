<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller{

    public function create (Request $request) {

        $request->validate([
            'name' => 'required|unique:genres|max:64',
        ]);

        $genre = new Genre();
        
        $genre->name = $request->name;

        $genre->save();

        return redirect()
            ->route('admin-genres')
            ->with('success','Genre created successfully.');
    }

    public function update (Request $request, $id) {

        $request->validate([
            'name' => 'required|unique:genres, name, {$genre->id}|max:64',
        ]);

        $genre = Genre::find($id);

        $genre->name = $request->name;

        $genre->save();

        return redirect()
            ->route('admin-genres')
            ->with('success','Genre updated successfully');
    }

    public function destroy($id) {

        $genre = Genre::find($id);
        
        $genre->delete();

        return redirect()
            ->back()
            ->with('success', 'Genre deleted successfully');
    }

    public function createPage () {

        $genres = Genre::get();

        return view('admin.genre.create', get_defined_vars());
    }

    public function editPage ($id) {

        $genre = Genre::find($id);

        return view('admin.genre.edit', get_defined_vars());
    }

    public function showGenresAdmin (Request $request) {

        $genres = Genre::simplePaginate(10);

        $request->session()->reflash();

        return view('admin.genres', get_defined_vars());
    }
}
