<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create() {
        return view("website.auth.login");
    }
    public function store(request $request) {
        $validate = $request->validate([
            "username" => ["required", "email"],
            "password" => ["required"]
        ]);


        if (Auth::attempt($validate)) {
            $request->session()->regenerate();

            return redirect("/");
        } else {
            return redirect()->back()->withErrors(['error' => 'error']);
        }
    }
    public function destroy() {
        Auth::logout();

        return redirect("/");
    }
}