<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clases;
use App\Models\Tasks;
use App\Models\TasksFiles;
use App\Models\TaskSubmissions;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Helpers\LogActivity;

class TaskController extends Controller
{
    public function store(Request $request, $classId)
    {
        $class = Clases::findOrFail($classId);

        $data = $request->validate([
            'title_name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'time_for_task' => 'nullable|date',
            'max_points' => 'nullable|integer',
            'file' => 'nullable|file|max:10240',
        ]);

        $task = Tasks::create([
            'class_id' => $class->id,
            'title_name' => $data['title_name'],
            'description' => $data['description'] ?? null,
            'time_for_task' => $data['time_for_task'] ?? null,
            'max_points' => $data['max_points'] ?? null,
        ]);

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('tasks_files', 'public');
            TasksFiles::create([
                'task_id' => $task->id,
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'file_type' => $file->getClientMimeType(),
                'file_size' => $file->getSize(),
            ]);
        }

        LogActivity::add("Created task '{$task->title_name}' in class '{$class->class_name}'", 'tasks');

        return redirect()->back()->with('success', 'Task created successfully!');
    }
}
