@extends('layouts.app')

@section('title', 'Edit Doctor')

@section('content')
<h1>Edit Doctor</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{-- Scrollable layout with pinned submit button --}}
<div class="card" style="height: 85vh; display: flex; flex-direction: column;">
    <form action="{{ route('admin.manage_doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data" style="display: contents;">
        @csrf
        @method('PUT')

        <div class="card-body overflow-auto px-4">
            <h5>Personal Information</h5>

            <div class="mb-3">
                <label>Photo</label>
                @if ($doctor->photo)
                    <br><img src="{{ asset('storage/'.$doctor->photo) }}" width="100" class="rounded shadow mb-2">
                @endif
                <input type="file" name="photo" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $doctor->first_name) }}" required>
                </div>
                <div class="col-md-4">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $doctor->middle_name) }}">
                </div>
                <div class="col-md-4">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $doctor->last_name) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender', $doctor->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender', $doctor->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $doctor->date_of_birth) }}" required>
                </div>
                <div class="col-md-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone', $doctor->phone) }}">
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $doctor->email) }}" required>
                </div>
            </div>

            <h5 class="mt-5">Professional Information</h5>

            @php
                $specialties = old('specialties') ?? (is_array(json_decode($doctor->specialties, true)) ? implode(', ', json_decode($doctor->specialties, true)) : $doctor->specialties);
                $subspecialties = old('subspecialties') ?? (is_array(json_decode($doctor->subspecialties, true)) ? implode(', ', json_decode($doctor->subspecialties, true)) : $doctor->subspecialties);
                $daysAvailable = old('days_available') ?? (is_array(json_decode($doctor->days_available, true)) ? implode(', ', json_decode($doctor->days_available, true)) : $doctor->days_available);
                $timeSlots = old('time_slots') ?? (is_array(json_decode($doctor->time_slots, true)) ? implode(', ', json_decode($doctor->time_slots, true)) : $doctor->time_slots);
            @endphp

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Specialties (comma separated)</label>
                    <input type="text" name="specialties" class="form-control" value="{{ $specialties }}">
                </div>
                <div class="col-md-3">
                    <label>Subspecialties (comma separated)</label>
                    <input type="text" name="subspecialties" class="form-control" value="{{ $subspecialties }}">
                </div>
                <div class="col-md-3">
                    <label>License Number</label>
                    <input type="text" name="license_number" class="form-control" value="{{ old('license_number', $doctor->license_number) }}">
                </div>
                <div class="col-md-3">
                    <label>PRC Number</label>
                    <input type="text" name="prc_number" class="form-control" value="{{ old('prc_number', $doctor->prc_number) }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>License Expiry</label>
                    <input type="date" name="license_expiry" class="form-control" value="{{ old('license_expiry', $doctor->license_expiry) }}">
                </div>
                <div class="col-md-6">
                    <label>Years of Experience</label>
                    <input type="number" name="years_experience" class="form-control" value="{{ old('years_experience', $doctor->years_experience) }}">
                </div>
            </div>

            <h5 class="mt-5">Hospital Information</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control" value="{{ old('department', $doctor->department) }}">
                </div>
                <div class="col-md-4">
                    <label>Position / Title</label>
                    <input type="text" name="position" class="form-control" value="{{ old('position', $doctor->position) }}">
                </div>
                <div class="col-md-4">
                    <label>Doctor ID</label>
                    <input type="text" name="doctor_id" class="form-control" value="{{ old('doctor_id', $doctor->doctor_id) }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Days Available (comma separated)</label>
                    <input type="text" name="days_available" class="form-control" value="{{ $daysAvailable }}">
                </div>
                <div class="col-md-4">
                    <label>Time Slots (comma separated)</label>
                    <input type="text" name="time_slots" class="form-control" value="{{ $timeSlots }}">
                </div>
                <div class="col-md-4">
                    <label>On Call Availability</label>
                    <select name="on_call" class="form-control">
                        <option value="0" {{ old('on_call', $doctor->on_call) == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('on_call', $doctor->on_call) == '1' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>

            <h5 class="mt-5">System / Administrative</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Patients Handled</label>
                    <input type="number" name="patients_handled" class="form-control" value="{{ old('patients_handled', $doctor->patients_handled) }}">
                </div>
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option {{ old('status', $doctor->status) == 'Active' ? 'selected' : '' }}>Active</option>
                        <option {{ old('status', $doctor->status) == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                        <option {{ old('status', $doctor->status) == 'Retired' ? 'selected' : '' }}>Retired</option>
                        <option {{ old('status', $doctor->status) == 'Resigned' ? 'selected' : '' }}>Resigned</option>
                    </select>
                </div>
            </div>

            <h5>Address</h5>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}">
            </div>
        </div>

        {{-- Fixed footer with submit button --}}
        <div class="card-footer text-end py-3 px-4 bg-white border-top">
            <button type="submit" class="btn btn-primary">Update Doctor</button>
        </div>
    </form>
</div>
@endsection
