<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    // Show all appointments of logged in patient
    public function index()
    {
        $appointments = Appointment::where('patient_id', Auth::id())
            ->orderBy('date', 'desc')
            ->orderBy('time', 'asc')
            ->get();

        return view('patient.appointments.index', compact('appointments'));
    }

    // Show single appointment
    public function show($id)
    {
        $appointment = Appointment::where('patient_id', Auth::id())->findOrFail($id);

        return view('patient.appointments.show', compact('appointment'));
    }

    // Cancel appointment
    public function cancel($id)
    {
        $appointment = Appointment::where('patient_id', Auth::id())->findOrFail($id);
        $appointment->status = 'Cancelled';
        $appointment->save();

        return redirect()->route('patient.appointments.index')->with('success', 'Appointment cancelled.');
    }
}
