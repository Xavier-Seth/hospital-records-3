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

{{-- FIXED scrollable container with pinned submit button --}}
<div class="card" style="height: 85vh; display: flex; flex-direction: column;">
    <form action="{{ route('admin.manage_doctors.store') }}" method="POST" enctype="multipart/form-data" style="display: contents;">
        @csrf

        <div class="card-body overflow-auto px-4">
            {{-- Personal Info --}}
            <h5 class="mb-3">Personal Information</h5>

            <div class="mb-3">
                <label>Photo</label>
                <input type="file" name="photo" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>First Name</label>
                    <input type="text" name="first_name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <label>Middle Name</label>
                    <input type="text" name="middle_name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Last Name</label>
                    <input type="text" name="last_name" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
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

            {{-- Professional Info --}}
            <h5 class="mt-4 mb-3">Professional Information</h5>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Specialties (comma separated)</label>
                    <input type="text" name="specialties" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Subspecialties (comma separated)</label>
                    <input type="text" name="subspecialties" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>License Number</label>
                    <input type="text" name="license_number" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>PRC Number</label>
                    <input type="text" name="prc_number" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>License Expiry</label>
                    <input type="date" name="license_expiry" class="form-control">
                </div>
                <div class="col-md-6">
                    <label>Years of Experience</label>
                    <input type="number" name="years_experience" class="form-control">
                </div>
            </div>

            {{-- Hospital Info --}}
            <h5 class="mt-4 mb-3">Hospital Information</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Department</label>
                    <input type="text" name="department" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Position / Title</label>
                    <input type="text" name="position" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Doctor ID</label>
                    <input type="text" name="doctor_id" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Days Available (comma separated)</label>
                    <input type="text" name="days_available" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Time Slots (comma separated)</label>
                    <input type="text" name="time_slots" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>On Call Availability</label>
                    <select name="on_call" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Yes</option>
                    </select>
                </div>
            </div>

            {{-- System Info --}}
            <h5 class="mt-4 mb-3">System / Administrative</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Patients Handled</label>
                    <input type="number" name="patients_handled" class="form-control">
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

            {{-- Address --}}
            <h5>Address</h5>
            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>
        </div>

        {{-- Submit Button (Always Visible) --}}
        <div class="card-footer text-end py-3 px-4 bg-white border-top">
            <button type="submit" class="btn btn-primary">Save Doctor</button>
        </div>
    </form>
</div>
@endsection
