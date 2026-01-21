<?php

namespace App\Http\Controllers;

use App\Helpers\LogActivity;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;
use App\Models\User;
use App\Models\Logs;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::latest()->get();
        $logs = Logs::latest()->limit(50)->get();

        return view('website.admin.dashboard', compact('users', 'logs'));
    }

    public function create()
    {
        return view('website.admin.create_user');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => ['required','max:25'],
            'full_name' => ['required','max:50'],
            'email' => ['required','email',Rule::unique('users','email')],
            'password' => ['required','confirmed',Password::min(6)->letters()->numbers()],
            'role' => ['required','in:user,teacher,admin'],
        ]);

        User::create($data);

        LogActivity::add('Admin created user '.$data['username'], 'users');

        return redirect()->route('admin.dashboard')->with('success','User created');
    }

    public function edit(User $user)
    {
        return view('website.admin.edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|in:user,teacher,admin',
        ]);

        $user->update([
            'role' => $data['role'],
        ]);

        LogActivity::add(
            'Edit '.$user->username.' role to '.$data['role'],
            'users'
        );

        return redirect()->route('admin.dashboard')->with('success','User updated');
    }
}
