<x-layout>
<x-slot:title>{{ $class->class_name }}</x-slot:title>

<div class="min-h-screen bg-gray-100 dark:bg-zinc-900 px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 dark:text-zinc-100 mb-4">
        {{ $class->class_name }} ({{ $class->subject }})
    </h1>
    <p class="mb-6 text-gray-600 dark:text-zinc-300">{{ $class->description }}</p>

    <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100 mb-2">Tasks</h2>
    @if($class->tasks->isEmpty())
        <p class="text-gray-600 dark:text-zinc-300 mb-4">No tasks yet.</p>
    @else
        <div class="space-y-4 mb-6">
            @foreach($class->tasks as $task)
                <div class="bg-white dark:bg-zinc-800 p-4 rounded-2xl shadow hover:shadow-lg transition">
                    <h3 class="font-semibold text-gray-800 dark:text-zinc-100">{{ $task->title_name }}</h3>
                    <p class="text-gray-600 dark:text-zinc-300">{{ $task->description }}</p>
                    <p class="text-sm text-gray-500 dark:text-zinc-400">Due: {{ $task->time_for_task?->format('Y-m-d H:i') ?? 'N/A' }}</p>
                    <p class="text-sm text-gray-500 dark:text-zinc-400">Max points: {{ $task->max_points ?? 'N/A' }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100 mb-2">Students & Teachers</h2>
    <div class="flex flex-wrap gap-2">
        @foreach($class->users as $user)
            <span class="px-3 py-1 rounded-full text-sm font-medium
                {{ $user->pivot->role == 'teacher' ? 'bg-green-500 text-white' : ($user->pivot->role == 'admin' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800') }}">
                {{ $user->full_name }} ({{ ucfirst($user->pivot->role) }})
            </span>
        @endforeach
    </div>
</div>
</x-layout>
