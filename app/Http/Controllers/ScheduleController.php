<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Facility;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'time' => ['required'],
            'duration' => ['required', 'integer'],
            'days_of_week' => ['required', 'array'],
            'days_of_week.*' => ['required', Rule::in(['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'])],
            'facility_id' => ['required', 'exists:facilities,id'],
        ]);

        $schedule = new Schedule($validatedData);
        $course->schedule()->save($schedule);

        return back()->with('status', 'schedule-updated');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        $course->load('schedule.facility');
        $facilities = Facility::all();

        return view('schedules.edit', compact('course', 'facilities'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        $validatedData = $request->validate([
            'start_date' => ['required', 'date', 'before_or_equal:end_date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'time' => ['required'],
            'duration' => ['required', 'integer'],
            'days_of_week' => ['required', 'array'],
            'days_of_week.*' => ['required', Rule::in(['mon', 'tue', 'wed', 'thu', 'fri', 'sat', 'sun'])],
            'facility_id' => ['required', 'exists:facilities,id'],
        ]);

        $validatedData['days_of_week'] = '{'.implode(',', $validatedData['days_of_week']).'}';

        $course->schedule()->update($validatedData);

        return back()->with('status', 'schedule-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
