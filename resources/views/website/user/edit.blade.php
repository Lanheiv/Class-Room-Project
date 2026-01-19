<x-layout>
<x-slot:title>Edit Profile</x-slot:title>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-zinc-900 px-4">
    <form method="POST" action="/profile/edit" enctype="multipart/form-data"
          class="w-full max-w-md bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow space-y-6">
        @csrf

        <div class="flex flex-col items-center">
            <img 
                src="{{ $user->profilePicture ? asset('storage/'.$user->profilePicture->file_path) : asset('default-avatar.png') }}" 
                alt="Profile Picture" 
                class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-red-600"
            >
            <label class="text-gray-700 dark:text-zinc-200 mb-2">Change Profile Picture</label>
            <input type="file" name="profile_picture" accept="image/*"
                   class="w-full px-4 py-2 border rounded-xl focus:ring-2 focus:ring-red-500 dark:bg-zinc-700 dark:text-gray-200">
        </div>

        <input name="username" type="text" value="{{ old('username', $user->username) }}" placeholder="Username"
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 dark:bg-zinc-700 dark:text-gray-200">

        <input name="full_name" type="text" value="{{ old('full_name', $user->full_name) }}" placeholder="Full name"
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 dark:bg-zinc-700 dark:text-gray-200">

        <input name="email" type="email" value="{{ old('email', $user->email) }}" placeholder="Email"
               class="w-full px-4 py-3 border rounded-xl focus:ring-2 focus:ring-red-500 dark:bg-zinc-700 dark:text-gray-200">

        @if ($errors->any())
            <div class="text-sm text-red-500 space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <button type="submit" 
                class="w-full bg-red-600 text-white py-3 rounded-xl font-medium hover:bg-red-700 transition">
            Save Changes
        </button>
    </form>
</div>
</x-layout>
