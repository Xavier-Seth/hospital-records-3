<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DoctorDashboardController;
use App\Http\Controllers\PatientDashboardController;
use App\Http\Controllers\Admin\ManageDoctorController;
// use App\Http\Controllers\Admin\PatientController;
use App\Http\Controllers\Admin\PatientController;


// Login and Home Redirect
Route::get('/', function () {
    return view('auth.login');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// DASHBOARDS

// Admin Dashboard
Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

// Doctor Dashboard
Route::middleware(['auth', 'role:doctor'])->get('/doctor/dashboard', [DoctorDashboardController::class, 'index'])->name('doctor.dashboard');

// Patient Dashboard
Route::middleware(['auth', 'role:patient'])->get('/patient/dashboard', [PatientDashboardController::class, 'index'])->name('patient.dashboard');

// ================================
// ADMIN ROUTES
// ================================

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {

    // Manage Doctors
    Route::prefix('manage-doctors')->name('manage_doctors.')->group(function () {
        Route::get('/', [ManageDoctorController::class, 'index'])->name('index');
        Route::get('/create', [ManageDoctorController::class, 'create'])->name('create');
        Route::post('/', [ManageDoctorController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [ManageDoctorController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ManageDoctorController::class, 'update'])->name('update');
        Route::delete('/{id}', [ManageDoctorController::class, 'destroy'])->name('destroy');
    });

    // Manage Patients
    Route::get('/manage-patients', function () {
        return view('admin.manage_patients.patients_page');
    })->name('manage_patients.index');

    // Manage Appointments
    Route::get('/manage-appointments', function () {
        return view('admin.appointments');
    })->name('manage_appointments.index');

    // User Management
    Route::get('/user-management', function () {
        return view('admin.manage_users.user_page');
    })->name('user_management.index');
});

// ================================
// DOCTOR ROUTES
// ================================

Route::middleware(['auth', 'role:doctor'])->prefix('doctor')->name('doctor.')->group(function () {

    Route::get('/dashboard', [DoctorDashboardController::class, 'index'])->name('dashboard');

    Route::get('/patients', function () {
        return view('doctor.patients_page');
    })->name('patients');

    Route::get('/appointments', function () {
        return view('doctor.appointments');
    })->name('appointments');
});

// ================================
// PATIENT ROUTES
// ================================

Route::middleware(['auth', 'role:patient'])->prefix('patient')->name('patient.')->group(function () {

    Route::get('/dashboard', [PatientDashboardController::class, 'index'])->name('dashboard');

    Route::get('/appointments', function () {
        return view('patient.appointments');
    })->name('appointments');
});

// Route::get('/manage-doctors', [ManageDoctorController::class, 'index'])->name('admin.manage_doctors.index');
Route::get('/admin/manage-doctors/{id}', [ManageDoctorController::class, 'show'])->name('admin.manage_doctors.show');


//admin patient
Route::prefix('admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::resource('manage_patients', PatientController::class);
});
