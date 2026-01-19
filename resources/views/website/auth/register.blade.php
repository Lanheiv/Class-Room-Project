<x-layout>
<x-slot:title>Reģistrācija</x-slot:title>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-zinc-900">
<form method="POST" action="{{ route('user.store') }}"
class="w-full max-w-sm bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow-lg space-y-6">
@csrf

<h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-zinc-100">
Classroom
</h1>

<input name="username" type="text" value="{{ old('username') }}" placeholder="Username"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500" required>

<input name="full_name" type="text" value="{{ old('full_name') }}" placeholder="Full name"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500" required>

<input name="email" type="email" value="{{ old('email') }}" placeholder="Email"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500" required>

<input name="password" type="password" placeholder="Password"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500" required>

<input name="password_confirmation" type="password" placeholder="Confirm password"
class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none
focus:ring-2 focus:ring-red-500" required>

@if ($errors->any())
<div class="text-sm text-red-500 space-y-1">
@foreach ($errors->all() as $error)
<p>{{ $error }}</p>
@endforeach
</div>
@endif

<button type="submit"
class="w-full bg-red-600 text-white py-3 rounded-xl font-medium hover:bg-red-700 transition">
Create account
</button>

<p class="text-sm text-center text-gray-500 dark:text-zinc-400">
Already have an account?
<a href="{{ route('session.create') }}" class="text-red-600 hover:underline">Sign in</a>
</p>

</form>
</div>
</x-layout>
