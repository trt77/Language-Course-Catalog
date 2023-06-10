<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use App\Models\Favourite;

class FavouriteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        $favourite_courses = $user->favourite_courses;

        return view('favourites.favourites', ['favourite_courses' => $favourite_courses]);
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
        $user = $request->user();

        $favourite = $user->favourites()->where('course_id', $course->getQueueableId())->first();
        if ($favourite) {
            $user->favourites()->detach($course->getQueueableId());
            return redirect()->back()->with('status', 'course-removed-from-favourites');
        } else {
            $user->favourites()->attach($course->getQueueableId());
            return redirect()->back()->with('status', 'course-added-to-favourites');
        }
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Course $course)
    {
        $user = $request->user();
        $favourite = $user->favourites()->where('course_id', $course->getQueueableId())->first();

        if($favourite != null) {
            if ($user->favourites()->where('course_id', $course->getQueueableId())->exists()) {
                $user->favourites()->detach($course->getQueueableId());
            }
        }

        return redirect()->back()->with('status', 'Course successfully deleted!');
    }

}
