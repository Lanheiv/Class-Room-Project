<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\LogActivity;

use App\Models\ProfilePicture;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        return view('website.user.profile', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
        return view('website.user.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $data = $request->validate([
            'username' => 'required|max:25|unique:users,username,' . $user->id,
            'full_name' => 'required|max:25',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'profile_picture' => 'nullable|image|max:2048',
        ]);

        $user->update($data);

        if ($request->hasFile('profile_picture')) {
            $activePicture = $user->profilePicture;

            if ($activePicture) {
                \Storage::disk('public')->delete($activePicture->file_path);
                $activePicture->delete();
            }

            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');

            ProfilePicture::create([
                'user_id' => $user->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
                'is_active' => true,
            ]);

            LogActivity::add(
                'Changed profile picture to ' . $file->getClientOriginalName(),
                'profile_pictures'
            );
        }

        return redirect('/profile')->with('success', 'Profile updated!');
    }
}
