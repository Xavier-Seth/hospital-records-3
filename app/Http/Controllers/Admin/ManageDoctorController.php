<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ManageDoctorController extends Controller
{
    public function index()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('admin.manage_doctors.index', compact('doctors'));
    }

    public function create()
    {
        return view('admin.manage_doctors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email',
            'doctor_id' => 'required|unique:users,doctor_id',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('doctors', 'public');
            $data['photo'] = $path;
        }

        $data['specialties'] = $request->specialties ? json_encode($request->specialties) : null;
        $data['subspecialties'] = $request->subspecialties ? json_encode($request->subspecialties) : null;
        $data['days_available'] = $request->days_available ? json_encode($request->days_available) : null;
        $data['time_slots'] = $request->time_slots ? json_encode($request->time_slots) : null;

        $data['password'] = Hash::make($request->password);
        $data['role'] = 'doctor';
        $data['name'] = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);

        User::create($data);

        return redirect()->route('admin.manage_doctors.index')->with('success', 'Doctor added successfully!');
    }

    public function edit($id)
    {
        $doctor = User::findOrFail($id);
        return view('admin.manage_doctors.edit', compact('doctor'));
    }

    public function show($id)
    {
        $doctor = User::findOrFail($id);
        return view('admin.manage_doctors.show', compact('doctor'));
    }

    public function update(Request $request, $id)
    {
        $doctor = User::findOrFail($id);

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $doctor->id,
            'doctor_id' => 'required|unique:users,doctor_id,' . $doctor->id,
        ]);

        $data = $request->all();

        if ($request->hasFile('photo')) {
            if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
                Storage::disk('public')->delete($doctor->photo);
            }

            $path = $request->file('photo')->store('doctors', 'public');
            $data['photo'] = $path;
        } else {
            unset($data['photo']);
        }

        $data['specialties'] = $request->specialties ? json_encode($request->specialties) : null;
        $data['subspecialties'] = $request->subspecialties ? json_encode($request->subspecialties) : null;
        $data['days_available'] = $request->days_available ? json_encode($request->days_available) : null;
        $data['time_slots'] = $request->time_slots ? json_encode($request->time_slots) : null;
        $data['name'] = trim($request->first_name . ' ' . $request->middle_name . ' ' . $request->last_name);

        $doctor->update($data);

        return redirect()->route('admin.manage_doctors.index')->with('success', 'Doctor updated successfully!');
    }

    public function destroy($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        // Restrict deletion if doctor has appointments
        if ($doctor->appointments()->exists()) {
            return redirect()->route('admin.manage_doctors.index')
                ->with('error', 'Cannot delete doctor with existing appointments. Please reassign or delete the appointments first.');
        }

        // Delete photo if exists
        if ($doctor->photo && Storage::disk('public')->exists($doctor->photo)) {
            Storage::disk('public')->delete($doctor->photo);
        }

        $doctor->delete();

        return redirect()->route('admin.manage_doctors.index')->with('success', 'Doctor deleted successfully!');
    }
}
