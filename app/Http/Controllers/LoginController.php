<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index() {

        return view ('user.login');
    }

    public function userAuthentication(Request $request) {
        
        $attributes=$request->validate ([   
            'email' =>  'required|email',
            'password' => 'required|min:8'
        ]);

        if (Auth::attempt($attributes)){

            return redirect('/');
        }

        return back()->with('error', 'Wrong Credentials');
    }
    
    public function logout() {

        Auth::logout();

        return redirect('/');
    }  
}
