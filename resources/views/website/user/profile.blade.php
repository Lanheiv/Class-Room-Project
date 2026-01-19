<x-layout>
<x-slot:title>Profile</x-slot:title>

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-zinc-900 px-4">
    <div class="w-full max-w-md bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow space-y-6">
        <div class="flex flex-col items-center">
            <img 
                src="{{ $user->profilePicture ? asset('storage/'.$user->profilePicture->file_path) : asset('default-avatar.png') }}" 
                alt="Profile Picture" 
                class="w-24 h-24 rounded-full object-cover mb-4 border-2 border-red-600"
            >
            <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100">{{ $user->full_name }}</h2>
            <p class="text-gray-600 dark:text-zinc-300">{{ $user->username }}</p>
            <p class="text-gray-600 dark:text-zinc-300">{{ $user->email }}</p>
        </div>

        <div class="flex justify-center">
            <a href="/profile/edit" 
               class="px-6 py-2 bg-red-600 text-white rounded-xl font-medium hover:bg-red-700 transition">
               Edit Profile
            </a>
        </div>
    </div>
</div>
</x-layout>
