<?php

namespace App\Http\Controllers;

use App\Models\Month;

class UserController extends Controller
{
    public function index() {
        
        return view ('user.dashboard',[
            'months' => Month::with('categories', 'expenses')
                ->orderby('id','desc')
                ->get(),
        ]);
    }
}
