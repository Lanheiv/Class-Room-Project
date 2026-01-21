<x-layout>
<x-slot:title>{{ $class->class_name }}</x-slot:title>

<div class="min-h-screen bg-gray-100 dark:bg-zinc-900 px-4 py-8 space-y-8">

    <div>
        <h1 class="text-3xl font-bold text-gray-800 dark:text-zinc-100 mb-2">{{ $class->class_name }} ({{ $class->subject }})</h1>
        <p class="text-gray-600 dark:text-zinc-300 mb-4">{{ $class->description }}</p>
        <p class="text-gray-600 dark:text-zinc-300 mb-4">Code: {{ $class->access_code }}</p>
    </div>

    @if(auth()->user()->role == 'teacher')
        <div class="bg-white dark:bg-zinc-800 p-4 rounded-2xl shadow space-y-4">
            <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100">Add New Task</h2>
            <form method="POST" action="/classes/{{ $class->id }}/tasks" enctype="multipart/form-data" class="space-y-3">
                @csrf
                <input type="text" name="title_name" placeholder="Task title" class="w-full p-2 rounded-lg dark:bg-zinc-900 dark:text-zinc-100" required>
                <textarea name="description" placeholder="Description" class="w-full p-2 rounded-lg dark:bg-zinc-900 dark:text-zinc-100"></textarea>
                <input
                    type="datetime-local"
                    name="time_for_task"
                    min="{{ now()->format('Y-m-d\TH:i') }}"
                    class="w-full p-2 rounded-lg dark:bg-zinc-900 dark:text-zinc-100">

                <input type="number" name="max_points" placeholder="Max points" class="w-full p-2 rounded-lg dark:bg-zinc-900 dark:text-zinc-100">
                <input type="file" name="file" class="w-full">
                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">Add Task</button>
            </form>
        </div>
    @endif

    <div class="space-y-6">
        @foreach($class->tasks as $task)
            <div class="bg-white dark:bg-zinc-800 p-4 rounded-2xl shadow space-y-2">
                <h3 class="font-semibold text-gray-800 dark:text-zinc-100">{{ $task->title_name }}</h3>
                <p class="text-gray-600 dark:text-zinc-300 ">{{ $task->description }}</p>
                <p class="text-sm text-gray-500 dark:text-zinc-400">Due: {{ $task->time_for_task?->format('Y-m-d H:i') ?? 'N/A' }}</p>
                <p class="text-sm text-gray-500 dark:text-zinc-400">Max points: {{ $task->max_points ?? 'N/A' }}</p>

                @if($task->files->isNotEmpty())
                    <div class="flex flex-wrap gap-2 mt-2">
                        @foreach($task->files as $file)
                            <a href="{{ asset('storage/'.$file->file_path) }}" target="_blank" class="px-2 py-1 bg-gray-200 dark:bg-zinc-700 rounded-lg text-sm hover:bg-gray-300 dark:hover:bg-zinc-600">{{ $file->file_name }}</a>
                        @endforeach
                    </div>
                @endif

                <div class="mt-3 space-y-2">
                    @if(auth()->user()->role == 'teacher')
                        <h4 class="font-semibold text-gray-800 dark:text-zinc-100">Student Submissions</h4>
                        @foreach($task->submissions as $submission)
                            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2 p-2 bg-gray-100 dark:bg-zinc-900 rounded-lg">
                                <div>
                                    <p class="text-sm text-gray-700 dark:text-zinc-200">{{ $submission->student->full_name }}</p>
                                    <p class="text-xs text-gray-500 dark:text-zinc-400">{{ $submission->comment }}</p>
                                    <a href="{{ asset('storage/'.$submission->file_path) }}" target="_blank" class="text-red-600 hover:underline">View file</a>
                                </div>
                                <form method="POST" action="{{ route('submission.grade', $submission->id) }}" class="flex items-center gap-2">
                                    @csrf
                                    <input type="number" name="grade" value="{{ $submission->grade }}" placeholder="Grade" class="w-16 p-1 rounded-lg border dark:bg-zinc-900 dark:text-zinc-100">
                                    <button type="submit" class="px-3 py-1 bg-green-600 text-white rounded-lg hover:bg-green-700 transition">Grade</button>
                                </form>
                            </div>
                        @endforeach
                    @else
                        <h4 class="font-semibold text-gray-800 dark:text-zinc-100">Submit Your Work</h4>
                        @php
                            $userSubmission = $task->submissions->where('student_id', auth()->id())->first();
                        @endphp
                            <form method="POST" action="/tasks/{{ $task->id }}/submit" enctype="multipart/form-data" class="flex flex-col sm:flex-row gap-2 items-start sm:items-center">
                                @csrf
                                <input type="file" name="file" required class="p-2 rounded-lg border dark:bg-zinc-900 dark:text-zinc-100">
                                <input type="text" name="comment" placeholder="Comment" value="{{ $userSubmission->comment ?? '' }}" class="p-2 rounded-lg border dark:bg-zinc-900 dark:text-zinc-100 flex-1">
                                <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-xl hover:bg-red-700 transition">Submit</button>
                            </form>
                        @if($userSubmission)
                            <p class="text-sm text-gray-500 dark:text-zinc-400 mt-1">Already submitted. Grade: {{ $userSubmission->grade ?? 'N/A' }}</p>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>

    <h2 class="text-xl font-semibold text-gray-800 dark:text-zinc-100 mt-6">In class</h2>
    <div class="flex flex-wrap gap-2">
        @foreach($class->users as $user)
            <span class="px-3 py-1 rounded-full text-sm font-medium {{ $user->pivot->role == 'teacher' ? 'bg-green-500 text-white' : ($user->pivot->role == 'admin' ? 'bg-blue-500 text-white' : 'bg-gray-300 text-gray-800') }}">
                {{ $user->full_name }}
            </span>
        @endforeach
    </div>

</div>
</x-layout>
