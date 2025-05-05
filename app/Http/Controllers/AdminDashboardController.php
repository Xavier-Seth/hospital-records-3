<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Count doctors
        $totalDoctors = User::where('role', 'doctor')->count();

        // Count patients
        $totalPatients = User::where('role', 'patient')->count();

        // Count appointments
        $totalAppointments = Appointment::count();

        // Pass to view
        return view('admin.dashboard', compact('totalDoctors', 'totalPatients', 'totalAppointments'));
    }
}
