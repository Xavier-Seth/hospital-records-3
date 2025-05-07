@extends('layouts.app')

@section('title', 'Add Doctor')

@section('content')
<h1>Add New Doctor</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<!-- Scrollable container -->
<div class="card" style="max-height: 600px; overflow-y: auto;">
    <div class="card-body">

        <form action="{{ route('admin.manage_doctors.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <h5>Personal Information</h5>

            <div class="mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>
                <div class="col-md-4">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
                </div>
                <div class="col-md-4">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                </div>
                <div class="col-md-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>

            <h5 class="mt-5">Professional Information</h5>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Specialties (comma separated)</label>
                    <input type="text" name="specialties" class="form-control" value="{{ old('specialties') }}">
                </div>
                <div class="col-md-3">
                    <label>Subspecialties (comma separated)</label>
                    <input type="text" name="subspecialties" class="form-control" value="{{ old('subspecialties') }}">
                </div>
                <div class="col-md-3">
                    <label>License Number</label>
                    <input type="text" name="license_number" class="form-control" value="{{ old('license_number') }}">
                </div>
                <div class="col-md-3">
                    <label>PRC Number</label>
                    <input type="text" name="prc_number" class="form-control" value="{{ old('prc_number') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>License Expiry</label>
                    <input type="date" name="license_expiry" class="form-control" value="{{ old('license_expiry') }}">
                </div>
                <div class="col-md-6">
                    <label>Years of Experience</label>
                    <input type="number" name="years_experience" class="form-control" value="{{ old('years_experience') }}">
                </div>
            </div>

            <h5 class="mt-5">Hospital Information</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control" value="{{ old('department') }}">
                </div>
                <div class="col-md-4">
                    <label>Position / Title</label>
                    <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                </div>
                <div class="col-md-4">
                    <label>Doctor ID</label>
                    <input type="text" name="doctor_id" class="form-control" value="{{ old('doctor_id') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Days Available (comma separated)</label>
                    <input type="text" name="days_available" class="form-control" value="{{ old('days_available') }}">
                </div>
                <div class="col-md-4">
                    <label>Time Slots (comma separated)</label>
                    <input type="text" name="time_slots" class="form-control" value="{{ old('time_slots') }}">
                </div>
                <div class="col-md-4">
                    <label>On Call Availability</label>
                    <select name="on_call" class="form-control">
                        <option value="0" {{ old('on_call') == '0' ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('on_call') == '1' ? 'selected' : '' }}>Yes</option>
                    </select>
                </div>
            </div>

            <h5 class="mt-5">System / Administrative</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Patients Handled</label>
                    <input type="number" name="patients_handled" class="form-control" value="{{ old('patients_handled') }}">
                </div>
                <div class="col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option>Active</option>
                        <option>Inactive</option>
                        <option>Retired</option>
                        <option>Resigned</option>
                    </select>
                </div>
            </div>

            <h5>Address</h5>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            </div>

            <button type="submit" class="btn btn-primary">Save Doctor</button>

        </form>

    </div>
</div>

@endsection
