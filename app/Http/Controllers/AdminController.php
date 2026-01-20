<?php

namespace App\Http\Controllers;
use App\Helpers\LogActivity;
use Illuminate\Http\Request;

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
    public function edit(User $user)
    {
        return view('website.admin.edit_user', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $data = $request->validate([
            'role' => 'required|in:user,teacher',
        ]);

        $user->update([
            'role' => $data['role'],
        ]);
        LogActivity::add(
            'Edit ' . $user["username"] . ' role to ' . $data['role'],
            'users'
        );

        return redirect()->route('admin.dashboard')->with('success', 'User updated');
    }
}
