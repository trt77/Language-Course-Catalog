<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use Illuminate\Http\Request;

class FacilityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $sort = $request->get('sort') ?? 'name';
        $order = $request->get('order') === 'desc' ? 'desc' : 'asc';

        $facilities = Facility::orderBy($sort, $order)->get();

        return view('facilities.add', ['facilities' => $facilities]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $facilities = Facility::all();

        return view('facilities.add', ['facilities' => $facilities]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required|max:255',
        ]);

        $facility = new Facility;
        $facility->name = $request->name;
        $facility->address = $request->address;
        $facility->save();

        return back()->with('status', 'facility-created');
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
    public function edit(Facility $facility)
    {
        return view('facilities.edit', ['facility' => $facility]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Facility $facility)
    {
        $request->validate([
            'name' => 'required|max:255',
            'address' => 'required',
        ]);

        $facility->name = $request->name;
        $facility->address = $request->address;
        $facility->save();

        return back()->with('status', 'facility-updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Facility $facility)
    {
        $facility->delete();
        $facilities = Facility::all();

        return view('facilities.partials.facility-deletion-successful-message', ['facilities' => $facilities]);
    }
}
