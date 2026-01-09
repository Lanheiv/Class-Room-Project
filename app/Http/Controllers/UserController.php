<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

use App\models\User;

class UserController extends Controller
{
    public function create(){
        return view("website.auth.register");
    }
    public function store(Request $request) {
        $validate = $request->validate([
            "username" => ["required", "max:25"],
            "fullName" => ["required", "max:25"],
            "email" => ['required', Rule::unique('users', 'email')],
            "password" => ["required", "confirmed", Password::min(6)->numbers()->letters()],
        ]);
        $user = User::create($validated);
        Auth::login($user);

        return redirect("/");
    }
}
