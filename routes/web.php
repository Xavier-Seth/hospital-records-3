<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\Admin\ManageDoctorController;
use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Doctor\PatientController as DoctorPatientController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\Patient\AppointmentController as PatientAppointmentController;

// ==================================
// AUTH ROUTES
// ==================================

// Login and Home Redirect
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ==================================
// DASHBOARDS
// ==================================

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Doctor Dashboard
Route::middleware(['auth', 'role:doctor'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

// Patient Dashboard
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

// ==================================
// ADMIN ROUTES
// ==================================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Manage Doctors
    Route::prefix('manage-doctors')->name('manage_doctors.')->group(function () {
        Route::get('/', [ManageDoctorController::class, 'index'])->name('index');
        Route::get('/create', [ManageDoctorController::class, 'create'])->name('create');
        Route::post('/', [ManageDoctorController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ManageDoctorController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ManageDoctorController::class, 'update'])->name('update');
        Route::delete('/{id}', [ManageDoctorController::class, 'destroy'])->name('destroy');
        Route::get('/{id}', [ManageDoctorController::class, 'show'])->name('show');
    });

    // Manage Patients (CRUD)
    Route::resource('manage_patients', PatientController::class);

    // Manage Appointments (CRUD)
    Route::resource('manage_appointments', AppointmentController::class)->parameters([
        'manage_appointments' => 'appointment',
    ]);

    // User Management (for example)
    Route::get('/user-management', function () {
        return view('admin.manage_users.user_page');
    })->name('user_management.index');
});

// ==================================
// DOCTOR ROUTES
// ==================================

Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {

    // Doctor Dashboard
    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

    // Manage Patients (CRUD)
    Route::resource('patients', DoctorPatientController::class);

    // Manage Appointments (CRUD)
    Route::resource('appointments', AppointmentController::class)->parameters([
        'appointments' => 'appointment',
    ]);
});

// ==================================
// PATIENT ROUTES
// ==================================

Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {

    // Patient Dashboard
    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');

    // Patient Appointments (View + Cancel)
    Route::get('/appointments', [PatientAppointmentController::class, 'index'])->name('appointments.index');
    Route::get('/appointments/{appointment}', [PatientAppointmentController::class, 'show'])->name('appointments.show');
    Route::post('/appointments/{appointment}/cancel', [PatientAppointmentController::class, 'cancel'])->name('appointments.cancel');
});
