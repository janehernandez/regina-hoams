<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use Inertia\Inertia;

class CalendarController extends Controller
{
    public function index()
    {
        $data = Appointment::whereActive(1)->get();
        $appointments = AppointmentResource::collection($data);

        return Inertia::render('Calendar/Index', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAppointmentRequest $request)
    {
        $venueRef = ['BBC', 'MPH'];
        Appointment::create(array_replace($request->validated(), [
            'user_id' => auth()->user()->id,
            'booking_number' => $venueRef[$request->venue] . now()->timestamp
        ]));
        return redirect()->route('calendar.index')->with('message', 'success|New Appointment has been created');
    }
}
