<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            $userClasses = auth()->user()->classes()->get();

            return view('website.main.auth_index', compact('userClasses'));
        }
        return redirect('/login');
    }
}
