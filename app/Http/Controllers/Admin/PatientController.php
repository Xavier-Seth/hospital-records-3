<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class PatientController extends Controller
{
    public function index()
    {
        $patients = Patient::orderBy('created_at', 'desc')->get();
        return view('admin.manage_patients.index', compact('patients'));
    }

    public function create()
    {
        $doctors = User::where('role', 'doctor')->orderBy('name')->get();

        return view('admin.manage_patients.create', compact('doctors'));
    }

    public function store(Request $request)
{
    $request->validate([
        'first_name' => 'required',
        'last_name' => 'required',
        'email' => 'required|email|unique:users,email',
        'date_of_birth' => 'required|date',
        'gender' => 'required',
        'phone' => 'required',
        'password' => 'required|confirmed|min:6',
    ]);

    // Create User account
    $user = User::create([
        'name' => $request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name,
        'email' => $request->email,
        'password' => Hash::make($request->password), // User's password
        'role' => 'patient',
    ]);

    // 📌 Handle Photo Upload
    if ($request->hasFile('photo')) {
        $photoPath = $request->file('photo')->store('patients', 'public');
    } else {
        $photoPath = null;
    }

    // Create Patient Record
    $patient = Patient::create([
        'user_id' => $user->id,
        'patient_id' => 'P-' . strtoupper(uniqid()),
        'first_name' => $request->first_name,
        'middle_name' => $request->middle_name,
        'last_name' => $request->last_name,
        'date_of_birth' => $request->date_of_birth,
        'gender' => $request->gender,
        'age' => $request->age,
        'blood_type' => $request->blood_type,
        'civil_status' => $request->civil_status,
        'nationality' => $request->nationality,
        'religion' => $request->religion,
        'phone' => $request->phone,
        'email' => $request->email,
        'address' => $request->address,
        'emergency_contact_name' => $request->emergency_contact_name,
        'emergency_contact_relationship' => $request->emergency_contact_relationship,
        'emergency_contact_phone' => $request->emergency_contact_phone,
        'emergency_contact_address' => $request->emergency_contact_address,
        'primary_condition' => $request->primary_condition,
        'allergies' => $request->allergies,
        'medications' => $request->medications,
        'medical_history' => $request->medical_history,
        'past_surgeries' => $request->past_surgeries,
        'admission_date' => $request->admission_date,
        'discharge_date' => $request->discharge_date,
        'room_number' => $request->room_number,
        'attending_physician_id' => $request->attending_physician_id,
        'hospital_status' => $request->hospital_status,
        'date_registered' => now(),
        'status' => 'Active',
        'photo' => $photoPath, // ✅ SAVE THE PHOTO PATH HERE
        'notes' => $request->notes,
    ]);

    return redirect()->route('admin.manage_patients.index')->with('success', 'Patient added successfully and user account created!');
}


    public function show($id)
    {
        $patient = Patient::findOrFail($id);
        return view('admin.manage_patients.show', compact('patient'));
    }

    public function edit($id)
{
    $patient = Patient::findOrFail($id);
    $doctors = User::where('role', 'doctor')->orderBy('name')->get(); // Add this line

    return view('admin.manage_patients.edit', compact('patient', 'doctors')); // include doctors
}


    public function update(Request $request, $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
        ]);

        $patient->update($request->all());

        return redirect()->route('admin.manage_patients.index')->with('success', 'Patient updated successfully!');
    }

    public function destroy($id)
    {
        $patient = Patient::findOrFail($id);

        // Delete linked user account
        $user = User::where('email', $patient->email)->first();
        if ($user) {
            $user->delete();
        }

        $patient->delete();

        return redirect()->route('admin.manage_patients.index')->with('success', 'Patient deleted successfully!');
    }
}
