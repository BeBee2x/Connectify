<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //for signup page
    public function signupPage(){
        return view("Authentication.signup");
    }

    //for login page
    public function loginPage(){
        return view("Authentication.login");
    }
}
