<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller {
    public function show () {

        $email = '';
        $pwd = '';
        return view('loginpage', get_defined_vars());
    }
}
