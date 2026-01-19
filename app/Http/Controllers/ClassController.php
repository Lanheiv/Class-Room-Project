<?php

namespace App\Http\Controllers;

use App\Models\Clases;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
}

