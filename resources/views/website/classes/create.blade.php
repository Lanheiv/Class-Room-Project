<x-layout>
<x-slot:title>Create Class</x-slot:title>

<div class="min-h-screen flex items-center justify-center bg-gray-100 dark:bg-zinc-900 px-4">
    <form method="POST" action="{{ route('class.store') }}"
        class="w-full max-w-sm bg-white dark:bg-zinc-800 p-8 rounded-2xl shadow-lg space-y-6">
        @csrf

        <h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-zinc-100">
            Create New Class
        </h1>

        <input name="class_name" type="text" value="{{ old('class_name') }}" placeholder="Class Name"
            class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
                text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500" required>

        <input name="subject" type="text" value="{{ old('subject') }}" placeholder="Subject"
            class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
                text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500" required>

        <textarea name="description" placeholder="Description (optional)"
            class="w-full px-4 py-3 border border-gray-300 dark:border-zinc-700 bg-white dark:bg-zinc-900
                text-gray-900 dark:text-zinc-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-red-500"
            rows="3">{{ old('description') }}</textarea>

        @if ($errors->any())
            <div class="text-sm text-red-500 space-y-1">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <button type="submit"
            class="w-full bg-red-600 text-white py-3 rounded-xl font-medium hover:bg-red-700 transition">
            Create Class
        </button>
    </form>
</div>
</x-layout>
