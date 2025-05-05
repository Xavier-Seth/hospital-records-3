<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Appointment;

class AdminDashboardController extends Controller
{
    public function index()
    {
         // Count users
    $totalDoctors = User::where('role', 'doctor')->count();
    $totalPatients = User::where('role', 'patient')->count();
    $totalAppointments = Appointment::count();

    // Fetch recent doctors and patients (latest 5)
    $recentDoctors = User::where('role', 'doctor')->latest()->take(5)->get();
    $recentPatients = User::where('role', 'patient')->latest()->take(5)->get();

        // Pass to view
        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalPatients',
            'totalAppointments',
            'recentDoctors',
            'recentPatients'
        ));
    }
}
