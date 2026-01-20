<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

use App\Helpers\LogActivity;

class UserController extends Controller
{
    public function index() {
        return view("website.user.profile");
    }
    public function create()
    {
        return view('website.auth.register');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'username' => ['required', 'max:25'],
            'full_name' => ['required', 'max:25'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', Password::min(6)->letters()->numbers()],
        ]);
        $validated['role'] = 'user';

        $user = User::create($validated);
        LogActivity::add(
            'New user join ' . $validated['username'],
            'users'
        );

        Auth::login($user);

        return redirect('/');
    }
}
