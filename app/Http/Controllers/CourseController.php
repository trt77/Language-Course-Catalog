<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Facility;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class CourseController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Course::withCount('users')->with('schedule.facility');

        $column = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        $allowed = ['name', 'level', 'language'];

        if (! in_array($column, $allowed)) {
            $column = 'name';
        }
        if (! in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }
        $query->orderBy($column, $order);

        if($request->has('teacher') && $request->input('teacher') != '') {
            $query->where('teacher_id', $request->input('teacher'));
        }

        if($request->has('facility') && $request->input('facility') != '') {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->where('facility_id', $request->input('facility'));
            });
        }

        if($request->has('level') && $request->input('level') != '') {
            $query->where('level', 'ILIKE', '%' . $request->input('level') . '%');
        }

        if($request->has('language') && $request->input('language') != '') {
            $query->where('language', 'ILIKE', '%' . $request->input('language') . '%');
        }

        if($request->has('name') && $request->input('name') != '') {
            $query->where('name', 'ILIKE', '%' . $request->input('name') . '%');
        }

        if($request->has('start_date') && $request->input('start_date') != '') {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->whereDate('start_date', '>=', $request->input('start_date'));
            });
        }

        if($request->has('end_date') && $request->input('end_date') != '') {
            $query->whereHas('schedule', function ($q) use ($request) {
                $q->whereDate('end_date', '<=', $request->input('end_date'));
            });
        }

        if ($request->has('days_of_week') && !empty($request->input('days_of_week'))) {
            $days = $request->input('days_of_week');
            $query->whereHas('schedule', function ($query) use ($days, $request) {
                $query->whereRaw("'{" . implode(",", $days) . "}'::text[] <@ days_of_week");
                if($request->has('exclusively') && $request->input('exclusively') === 'on') {
                    $query->whereRaw("cardinality(days_of_week) = " . count($days));
                }
            });
        }

        $courses = $query->get();

        $teachers = Teacher::all();
        $facilities = Facility::all();

        return view('dashboard', ['courses' => $courses, 'teachers' => $teachers, 'facilities' => $facilities]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $teachers = Teacher::all();
        return view('courses.add', ['teachers' => $teachers]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->teacher_id == 'null') {
            $request->merge(['teacher_id' => null]);
        }

        $validated = $request->validate([
            'name' => 'required|max:255',
            'level' => 'required|max:50',
            'language' => 'required|max:50',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $course = new Course();
        $course->name = $validated['name'];
        $course->level = $validated['level'];
        $course->language = $validated['language'];
        $course->teacher_id = $validated['teacher_id'];

        $course->save();

        return redirect()->back()->with('status', 'course-created');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $course = Course::with('schedule.facility')->find($id);
        $course->load('teacher');

        return view('courses.course-landing-page', ['course' => $course]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $teachers = Teacher::all();
        return view('courses.edit', ['course' => $course, 'teachers' => $teachers]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        if ($request->teacher_id == 'null') {
            $request->merge(['teacher_id' => null]);
        }

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'level' => 'required|max:255',
            'language' => 'required|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $course->update($validatedData);

        return back()->with('status', 'course-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        $course->delete();
        return view('courses.partials.course-deletion-successful-message');
    }

    public function myCourses()
    {
        $courses = auth()->user()->courses;
        return view('courses.my', compact('courses'));
    }

    public function myCourseSort(Request $request)
    {
        $query = auth()->user()->courses()->withCount('users')->with('schedule.facility');

        $column = $request->input('sort', 'name');
        $order = $request->input('order', 'asc');

        $allowed = ['name', 'level', 'language'];
        if (! in_array($column, $allowed)) {
            $column = 'name';
        }
        if (! in_array($order, ['asc', 'desc'])) {
            $order = 'asc';
        }

        $query->orderBy($column, $order);

        $courses = $query->get();

        $teachers = Teacher::all();
        $facilities = Facility::all();

        return view('courses.my', ['courses' => $courses, 'teachers' => $teachers, 'facilities' => $facilities, 'order' => $order]);
    }

    public function welcome($field = 'name', $order = 'asc')
    {
        $courses = Course::withCount('users')->orderBy($field, $order)->get();
        return view('welcome', ['courses' => $courses]);
    }

    public function attendedByUser(User $user)
    {
        $courses = $user->courses;

        if (!$courses) {
            $courses = [];
        }

        return view('users.attended-by-user', ['courses' => $courses]);
    }

    public function favouritedByUser(User $user)
    {
        $courses = $user->favourites; // Adjust this to use your actual relationship method

        if (!$courses) {
            $courses = [];
        }
        return view('users.favourited-by-user', ['courses' => $courses]);
    }
}
