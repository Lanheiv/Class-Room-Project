<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tasks;
use App\Models\TaskSubmission;
use Illuminate\Support\Facades\Storage;
use App\Helpers\LogActivity;

class SubmissionController extends Controller
{
    public function store(Request $request, $taskId)
    {
        $task = Tasks::findOrFail($taskId);

        $data = $request->validate([
            'file' => 'required|file|max:10240',
            'comment' => 'nullable|string|max:500',
        ]);

        $file = $request->file('file');
        $path = $file->store('submissions', 'public');

        $submission = TaskSubmission::updateOrCreate(
            ['task_id' => $task->id, 'student_id' => auth()->id()],
            [
                'file_name' => $file->getClientOriginalName(),
                'file_path' => $path,
                'comment' => $data['comment'] ?? null,
            ]
        );

        LogActivity::add("Submitted work for task '{$task->title_name}'", 'submissions');

        return redirect()->back()->with('success', 'Submission uploaded!');
    }

    public function grade(Request $request, $submissionId)
    {
        $submission = TaskSubmission::with('task')->findOrFail($submissionId);

        $request->validate([
            'grade' => [
                'required',
                'integer',
                'min:0',
                'max:' . $submission->task->max_points,
            ],
        ]);

        $submission->update([
            'grade' => $request->grade,
        ]);

        LogActivity::add(
            "Graded submission #{$submission->id} with {$request->grade} points",
            'submissions'
        );

        return redirect()->back()->with('success', 'Submission graded!');
    }
}
