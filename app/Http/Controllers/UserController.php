<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    
    public function showId ($id) {
        return User::findOrFail($id)->pluck('id');
    }

    public function register(Request $request) {

        if ($request->name == '' or $request->pwd == '' or $request->email == '') {
            $request->session()->flash("error", "All fields required!");
            redirect()->back();
        }

        $user = new User();
        $user->name = $request->name;
        $user->password = Hash::make($request->pwd);
        $user->email = $request->email;
        $user->save();

        auth()->login($user);

        return redirect()->away('/');
    }

    public function login(Request $request) {

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
