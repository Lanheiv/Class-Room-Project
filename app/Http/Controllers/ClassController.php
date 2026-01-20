<?php

namespace App\Http\Controllers;

use App\Models\Clases;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use App\Helpers\LogActivity;

class ClassController extends Controller
{
    public function index($id)
    {
        $class = Clases::with('users', 'tasks.files')->findOrFail($id);
        return view('website.classes.show', compact('class'));
    }

    public function create()
    {
        return view('website.classes.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_name' => 'required|string|max:50',
            'subject' => 'required|string|max:50',
            'description' => 'nullable|string|max:255',
        ]);

        $data['access_code'] = strtoupper(Str::random(6));

        $class = Clases::create($data);
        LogActivity::add(
            'Create new class ' . $data['class_name'],
            'clases'
        );

        $class->users()->attach(auth()->id(), ['role' => true]);

        return redirect('/')->with('success', 'Class created!');
    }

    public function join()
    {
        return view('website.classes.join');
    }

    public function store_join(Request $request)
    {
        $request->validate([
            'access_code' => 'required|string|exists:clases,access_code',
        ]);

        $class = Clases::where('access_code', $request->access_code)->first();

        if (!$class->users->contains(auth()->id())) {
            $class->users()->attach(auth()->id(), ['role' => false]);
        }

        return redirect('/')->with('success', 'Joined class!');
    }

    
public function addTask($classId)
{
    $class = Clases::findOrFail($classId);
    return view('website.classes.add-task', compact('class'));
}

public function storeTask(Request $request, $classId)
{
    $request->validate([
        'title_name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'time_for_task' => 'nullable|date',
        'max_points' => 'nullable|integer',
        'file' => 'nullable|file|max:5120'
    ]);

    $task = Tasks::create([
        'class_id' => $classId,
        'title_name' => $request->title_name,
        'description' => $request->description,
        'time_for_task' => $request->time_for_task,
        'max_points' => $request->max_points
    ]);

    if($request->hasFile('file')) {
        $path = $request->file('file')->store('task_files', 'public');
        $task->files()->create([
            'file_name' => $request->file('file')->getClientOriginalName(),
            'file_path' => $path,
            'file_type' => $request->file('file')->getClientMimeType(),
            'file_size' => $request->file('file')->getSize()
        ]);
    }

    return redirect()->route('class.index', $classId)->with('success', 'Task created!');
}

public function submitTask(Request $request, $taskId)
{
    $request->validate([
        'file' => 'required|file|max:5120',
        'comment' => 'nullable|string'
    ]);

    $path = $request->file('file')->store('task_submissions', 'public');

    TaskSubmission::create([
        'task_id' => $taskId,
        'student_id' => auth()->id(),
        'file_path' => $path,
        'comment' => $request->comment
    ]);

    return redirect()->back()->with('success', 'Submission uploaded!');
}

public function gradeSubmission(Request $request, $submissionId)
{
    $request->validate([
        'grade' => 'required|integer|min:0'
    ]);

    $submission = TaskSubmission::findOrFail($submissionId);
    $submission->update(['grade' => $request->grade]);

    return redirect()->back()->with('success', 'Submission graded!');
}

}

