<x-layout>
<x-slot:title>Sākumlapa</x-slot:title>

<div class="min-h-screen flex flex-col items-center justify-center bg-gray-100 dark:bg-zinc-900 px-4">
    <h1 class="text-2xl font-semibold text-center text-gray-800 dark:text-zinc-100 mb-6">
        My Classes
    </h1>

    @if($userClasses->isEmpty())
        <p class="text-center text-gray-600 dark:text-zinc-300 mb-6">
            You haven’t joined any classes yet.
        </p>
    @else
        <div class="w-full max-w-sm space-y-4">
            @foreach($userClasses as $class)
                <a href="{{ url('/classes/'.$class->id) }}"
                   class="block w-full bg-white dark:bg-zinc-800 p-6 rounded-2xl shadow hover:shadow-lg transition">
                    <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100">
                        {{ $class->class_name }}
                    </h2>
                    <p class="text-gray-600 dark:text-zinc-300">{{ $class->subject }}</p>
                    <p class="text-sm text-gray-500 dark:text-zinc-400 mt-2">
                        Access code: {{ $class->access_code }}
                    </p>
                    <span class="inline-block mt-2 px-2 py-1 text-xs font-medium rounded-full
                        {{ $class->pivot->role == 'teacher' ? 'bg-green-500 text-white' : ($class->pivot->role == 'admin' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800') }}">
                        {{ ucfirst($class->pivot->role) }}
                    </span>
                </a>
            @endforeach
        </div>
    @endif
</div>
</x-layout>
