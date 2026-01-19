<x-layout>
<x-slot:title>Login</x-slot:title>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-zinc-900">
<form method="POST" action="{{ route('session.store') }}"
class="w-full max-w-sm bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow-lg space-y-6">
@csrf

<h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-zinc-100">
Class
</h1>

<input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500 focus:border-transparent" required>

<input name="password" type="password" placeholder="Password"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500 focus:border-transparent" required>

<button type="submit"
class="w-full bg-red-600 text-white py-3 rounded-xl font-medium
hover:bg-red-700 transition">
Sign in
</button>

<p class="text-sm text-center text-gray-500 dark:text-zinc-400">
No account?
<a href="{{ route('user.create') }}"
class="text-red-600 hover:underline">Create one</a>
</p>

</form>
</div>
</x-layout>
