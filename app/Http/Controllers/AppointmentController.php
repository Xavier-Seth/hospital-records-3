<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\User;
use App\Models\Patient;

class AppointmentController extends Controller
{
    // Display a listing of the appointments
    public function index()
    {
        $appointments = Appointment::with(['doctor', 'patient'])
            ->orderBy('date', 'desc')
            ->get();

        return view('appointments.index', compact('appointments'));
    }

    // Show the form for creating a new appointment
    public function create()
    {
        // Load doctors and patients
        $doctors = User::where('role', 'doctor')->orderBy('name')->get();
        $patients = Patient::orderBy('first_name')->get();

        return view('appointments.create', compact('doctors', 'patients'));
    }

    // Store a newly created appointment in storage
    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string',
        ]);

        // Create appointment
        Appointment::create([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        // Redirect based on role
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.manage_appointments.index' : 'doctor.appointments.index')
                         ->with('success', 'Appointment created successfully!');
    }

    // Show the form for editing the specified appointment
    public function edit($id)
    {
        $appointment = Appointment::findOrFail($id);
        $doctors = User::where('role', 'doctor')->orderBy('name')->get();
        $patients = Patient::orderBy('first_name')->get();

        return view('appointments.edit', compact('appointment', 'doctors', 'patients'));
    }

    // Update the specified appointment in storage
    public function update(Request $request, $id)
    {
        // Validate request
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'patient_id' => 'required|exists:patients,id',
            'date' => 'required|date',
            'time' => 'required',
            'status' => 'required|string',
        ]);

        // Update appointment
        $appointment = Appointment::findOrFail($id);
        $appointment->update([
            'doctor_id' => $request->doctor_id,
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'time' => $request->time,
            'status' => $request->status,
        ]);

        // Redirect based on role
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.manage_appointments.index' : 'doctor.appointments.index')
                         ->with('success', 'Appointment updated successfully!');
    }

    // Remove the specified appointment from storage
    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        // Redirect based on role
        return redirect()->route(auth()->user()->role === 'admin' ? 'admin.manage_appointments.index' : 'doctor.appointments.index')
                         ->with('success', 'Appointment deleted successfully!');
    }
}
