<x-layout>
<x-slot:title>Edit User</x-slot:title>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-zinc-900 px-4">
    <form method="POST" action="{{ route('admin.user.update', $user) }}"
          class="w-full max-w-sm bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow space-y-6">
        @csrf
        @method('PUT')

        <h1 class="text-xl font-semibold text-center text-gray-800 dark:text-zinc-100">
            Edit User Role
        </h1>

        <div class="text-sm text-gray-600 dark:text-zinc-300">
            <p><strong>Username:</strong> {{ $user->username }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
        </div>

        @if($user->role !== 'admin')
        <select name="role"
            class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
                   text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500">
            <option value="user" @selected($user->role === 'user')>User</option>
            <option value="teacher" @selected($user->role === 'teacher')>Teacher</option>
        </select>
        
        <button type="submit"
            class="w-full bg-red-600 text-white py-3 rounded-xl font-medium hover:bg-red-700 transition">
            Save
        </button>
        @endif
    </form>
</div>
</x-layout>
