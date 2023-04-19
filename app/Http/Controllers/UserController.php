<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    
    public function showId ($id) {
        return User::findOrFail($id)->pluck('id');
    }

    public function register(Request $request) {

        $request->validate([
            'name'  => 'required',                       
            'email' => 'required|email|unique:users',
            'pwd'   => 'required',
            'cpwd'  => 'required|same:pwd'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->pwd);
        $user->email = $request->email;

        $user->save();

        if (!$request->is_author) {

            auth()->login($user);

            return redirect()->away('/');
        }

        $request->validate([
            'name' => 'unique:authors',
        ]);

        $user->addRole('author');

        $user->createToken('author', ['author']);

        $userAuthor = new Author();
        $userAuthor->name = $user->name;
        $userAuthor->save();

        $user->author()->associate($userAuthor);
        $userAuthor->user()->associate($user);

        $userAuthor->save();
        $user->save();

        auth()->login($user);

        return redirect()->away('/');

    }

    public function login(Request $request) {

        $request->validate([                        
            'email' => 'required|exists:users',
            'pwd'   => 'required',
        ]);

        if ($request->pwd == '' or $request->email == '') {
            redirect()->back()->with("error", "All fields required!");
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->pwd])) {
            return redirect('/');
        }

        return redirect()->back()->with('error', "User don't found, try again!");
    }

    public function logout (Request $request) {

        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect("/");
    }
}
