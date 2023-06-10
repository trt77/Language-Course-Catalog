<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Teacher::query();
        $column = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        $allowed = ['name', 'surname', 'education', 'email'];
        if (! in_array($column, $allowed)) {
            $column = 'name';
        }
        if (! in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }
        $query->orderBy($column, $order);

        $teachers = $query->get();

        return view('teachers.index', ['teachers' => $teachers]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.add');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'education' => 'required',
            'phone' => ['required', 'regex:/^\+?[0-9]{1,11}$/', 'max:14'],
            'email' => 'required|email',
            'picture' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:400',
        ]);

        /* 'storage/app/public' directory */
        $path = $request->file('picture')->store('teachers', 'public');

        Teacher::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'education' => $request->education,
            'phone' => $request->phone,
            'email' => $request->email,
            'picture' => $path,
        ]);

        return back()->with('status', 'teacher-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        $courses = $teacher->courses()->withCount('users')->get();
        return view('teachers.teacher-landing-page', ['teacher' => $teacher, 'courses' => $courses]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', ['teacher' => $teacher]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'education' => 'required',
            'phone' => ['required', 'regex:/^\+?[0-9]{1,11}$/', 'max:14'],
            'email' => 'required|email',
            'picture' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->hasFile('picture')) {

            $oldImagePath = $teacher->picture;

            $path = $request->file('picture')->store('teachers', 'public');

            if (file_exists(storage_path('app/public/') . $oldImagePath)) {
                unlink(storage_path('app/public/') . $oldImagePath);
            }

            $teacher->picture = $path;
        }

        $teacher->name = $request->name;
        $teacher->surname = $request->surname;
        $teacher->education = $request->education;
        $teacher->phone = $request->phone;
        $teacher->email = $request->email;

        $teacher->save();

        return back()->with('status', 'teacher-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return view('teachers.partials.teacher-deletion-successful-message');
    }

}
