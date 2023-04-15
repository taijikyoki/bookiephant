<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function show () {
        
        $email = '';
        $name = '';
        $pwd = '';
        $cpwd = '';
        
        return view('registration', get_defined_vars());
    }
}
