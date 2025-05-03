<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;


Route::get('/', function () {
    return view('auth.login');
});

// Login Form
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

// Login Submit
Route::post('/login', [LoginController::class, 'login']);

// Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// Login Routes
// Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
//     return view('dashboard.admin');
// })->name('admin.dashboard');

// Route::middleware(['auth', 'role:doctor'])->get('/doctor/dashboard', function () {
//     return view('dashboard.doctor');
// })->name('doctor.dashboard');

// Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', function () {
//     return view('dashboard.patient');
// })->name('patient.dashboard');


// Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');


Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
Route::middleware(['auth', 'role:doctor'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');


// Route::middleware(['auth', 'role:admin'])->group(function () {
//     Route::get('/admin/dashboard', 'AdminController@dashboard');
// });


//Admin Page Routes
// Route::get('/admin/dashboard', function () {
//     return view('admin.dashboard');
// })->name('admin.dashboard');
// Dummy Admin Management Routes

Route::middleware(['auth', 'role:admin'])->get('/admin/manage-doctors', function () {
    return view('admin.doctors_page');
})->name('admin.manage_doctors.index');

Route::middleware(['auth', 'role:admin'])->get('/admin/manage-patients', function () {
    return view('admin.patients_page');
})->name('admin.manage_patients.index');

Route::middleware(['auth', 'role:admin'])->get('/admin/manage-appointments', function () {
    return view('admin.appointments');
})->name('admin.manage_appointments.index');

Route::middleware(['auth', 'role:admin'])->get('/admin/user-management', function () {
    return view('admin.user_page');
})->name('admin.user_management.index');


//////////////////////////////////////////////////////////
// Route::get('/admin/doctors_page', function () {
//     return view('admin.doctors_page');
// })->name('admin.doctors_page');

// Route::get('/admin/patients_page', function () {
//     return view('admin.patients_page');
// })->name('admin.patients_page');

// Route::get('/admin/appointments', function () {
//     return view('admin.appointments');
// })->name('admin.appointments');

// Route::get('/admin/user_page', function () {
//     return view('admin.user_page');
// })->name('admin.user_page');



// DOCTOR ROUTES
Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

    // Manage Patients
    Route::get('/patients', function () {
        return view('doctor/patients_page');
    })->name('doctor.patients');

    // Appointments
    Route::get('/appointments', function () {
        return view('doctor.appointments');
    })->name('doctor.appointments');
});

// PATIENT ROUTES
Route::middleware(['auth', 'role:patient'])->prefix('patient')->group(function () {

    // Dashboard
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

    // Appointments
    Route::get('/appointments', function () {
        return view('patient.appointments');
    })->name('patient.appointments');

});

