<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOfficerRequest;
use App\Http\Requests\UpdateOfficerRequest;
use App\Models\Officer;
use Illuminate\Http\Request;
use Inertia\Inertia;

class OfficerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $officers = Officer::orderBy('created_at', 'desc')
            ->paginate(10);
        return Inertia::render('Admin/Officer/Index', compact('officers'));
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
    public function store(StoreOfficerRequest $request)
    {
        Officer::create($request->validated());
        return back()->with('message', 'success|New Officer has been created.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Officer $officer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Officer $officer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOfficerRequest $request, Officer $officer)
    {
        $officer->update($request->validated());
        return redirect()->route('admin.officers.index')->with('message', 'success|Announcement has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Officer $officer)
    {
        $officer->delete();
        return back()->with('message', 'success|Officer has been deleted.');
    }
}
