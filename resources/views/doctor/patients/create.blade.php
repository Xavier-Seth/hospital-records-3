@extends('layouts.app')

@section('content')
<div class="container" style="max-height: 90vh; overflow-y: auto; padding-right: 10px;">
    <h2>Add New Patient</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('doctor.patients.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- PERSONAL INFORMATION -->
        <div class="card shadow-sm p-4 mb-4">
            <h4 class="mb-3">Personal Information</h4>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="photo">Photo (optional)</label>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="first_name">First Name</label>
                    <input type="text" name="first_name" class="form-control" value="{{ old('first_name') }}" required>
                </div>
                <div class="col-md-4">
                    <label for="middle_name">Middle Name</label>
                    <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name') }}">
                </div>
                <div class="col-md-4">
                    <label for="last_name">Last Name</label>
                    <input type="text" name="last_name" class="form-control" value="{{ old('last_name') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="gender">Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="date_of_birth">Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                </div>

                <div class="col-md-4">
                    <label for="phone">Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
                <div class="col-md-6">
                    <label for="address">Address</label>
                    <input type="text" name="address" class="form-control" value="{{ old('address') }}">
                </div>
            </div>
        </div>

        <!-- EMERGENCY CONTACT INFORMATION -->
        <div class="card shadow-sm p-4 mb-4">
            <h4 class="mb-3">Emergency Contact Information</h4>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="emergency_contact_name">Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name') }}">
                </div>
                <div class="col-md-4">
                    <label for="emergency_contact_relationship">Relationship</label>
                    <input type="text" name="emergency_contact_relationship" class="form-control" value="{{ old('emergency_contact_relationship') }}">
                </div>
                <div class="col-md-4">
                    <label for="emergency_contact_phone">Contact Phone</label>
                    <input type="text" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone') }}">
                </div>
            </div>

            <div class="mb-3">
                <label for="emergency_contact_address">Contact Address</label>
                <input type="text" name="emergency_contact_address" class="form-control" value="{{ old('emergency_contact_address') }}">
            </div>
        </div>

        <!-- MEDICAL INFORMATION -->
        <div class="card shadow-sm p-4 mb-4">
            <h4 class="mb-3">Medical Information</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="primary_condition">Primary Condition</label>
                    <input type="text" name="primary_condition" class="form-control" value="{{ old('primary_condition') }}">
                </div>

                <div class="col-md-6">
                    <label for="allergies">Allergies</label>
                    <input type="text" name="allergies" class="form-control" value="{{ old('allergies') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="medications">Medications</label>
                    <input type="text" name="medications" class="form-control" value="{{ old('medications') }}">
                </div>

                <div class="col-md-6">
                    <label for="medical_history">Medical History</label>
                    <input type="text" name="medical_history" class="form-control" value="{{ old('medical_history') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="past_surgeries">Past Surgeries</label>
                    <input type="text" name="past_surgeries" class="form-control" value="{{ old('past_surgeries') }}">
                </div>

                <div class="col-md-6">
                    <label for="blood_type">Blood Type</label>
                    <input type="text" name="blood_type" class="form-control" value="{{ old('blood_type') }}">
                </div>
            </div>
        </div>

        <!-- HOSPITAL INFORMATION -->
        <div class="card shadow-sm p-4 mb-4">
            <h4 class="mb-3">Hospital Information</h4>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="admission_date">Admission Date</label>
                    <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="discharge_date">Discharge Date</label>
                    <input type="date" name="discharge_date" class="form-control" value="{{ old('discharge_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="room_number">Room Number</label>
                    <input type="text" name="room_number" class="form-control" value="{{ old('room_number') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="hospital_status">Hospital Status</label>
                    <select name="hospital_status" class="form-control">
                        <option value="">Select Status</option>
                        <option value="Admitted" {{ old('hospital_status') == 'Admitted' ? 'selected' : '' }}>Admitted</option>
                        <option value="Discharged" {{ old('hospital_status') == 'Discharged' ? 'selected' : '' }}>Discharged</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- LOGIN INFORMATION -->
        <div class="card shadow-sm p-4 mb-4">
            <h4 class="mb-3">Login Information</h4>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-success mb-4">Add Patient</button>
    </form>
</div>
@endsection
