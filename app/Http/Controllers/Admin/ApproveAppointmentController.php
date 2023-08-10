<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ApproveAppointmentRequest;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;

class ApproveAppointmentController extends Controller
{
    public function __invoke(ApproveAppointmentRequest $request, User $user)
    {
        $user->appointments()->whereId($request->id)->update(['active' => 1]);
        return redirect()->route('admin.appointments.index')->with('message', 'success|Reservation approved');
    }
}
