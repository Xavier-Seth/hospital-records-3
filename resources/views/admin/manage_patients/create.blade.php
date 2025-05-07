@extends('layouts.app')

@section('title', 'Add Patient')

@section('content')
<h1>Add New Patient</h1>

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

        <form action="{{ route('admin.manage_patients.store') }}" method="POST" enctype="multipart/form-data">
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
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth') }}" required>
                </div>
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" value="{{ old('age') }}" required>
                </div>
                <div class="col-md-3">
                    <label>Blood Type</label>
                    <select name="blood_type" class="form-control">
                        <option value="">Select Blood Type</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                            <option value="{{ $bloodType }}" {{ old('blood_type') == $bloodType ? 'selected' : '' }}>{{ $bloodType }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Civil Status</label>
                    <select name="civil_status" class="form-control">
                        <option value="">Select Civil Status</option>
                        @foreach(['Single', 'Married', 'Widowed', 'Separated', 'Divorced'] as $status)
                            <option value="{{ $status }}" {{ old('civil_status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}">
                </div>
                <div class="col-md-3">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control" value="{{ old('religion') }}">
                </div>
            </div>

            <h5 class="mt-4">Contact & Emergency Info</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address') }}">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="form-control" value="{{ old('emergency_contact_name') }}">
                </div>
                <div class="col-md-4">
                    <label>Relationship</label>
                    <input type="text" name="emergency_contact_relationship" class="form-control" value="{{ old('emergency_contact_relationship') }}">
                </div>
                <div class="col-md-4">
                    <label>Phone</label>
                    <input type="text" name="emergency_contact_phone" class="form-control" value="{{ old('emergency_contact_phone') }}">
                </div>
            </div>

            <div class="mb-3">
                <label>Emergency Contact Address</label>
                <input type="text" name="emergency_contact_address" class="form-control" value="{{ old('emergency_contact_address') }}">
            </div>

            <h5 class="mt-4">Medical Information</h5>

            <div class="mb-3">
                <label>Primary Medical Condition</label>
                <input type="text" name="primary_condition" class="form-control" value="{{ old('primary_condition') }}">
            </div>

            <div class="mb-3">
                <label>Allergies</label>
                <input type="text" name="allergies" class="form-control" value="{{ old('allergies') }}">
            </div>

            <div class="mb-3">
                <label>Medications</label>
                <input type="text" name="medications" class="form-control" value="{{ old('medications') }}">
            </div>

            <div class="mb-3">
                <label>Medical History</label>
                <textarea name="medical_history" class="form-control">{{ old('medical_history') }}</textarea>
            </div>

            <div class="mb-3">
                <label>Past Surgeries</label>
                <textarea name="past_surgeries" class="form-control">{{ old('past_surgeries') }}</textarea>
            </div>

            <h5 class="mt-4">Hospitalization</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Admission Date</label>
                    <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date') }}">
                </div>
                <div class="col-md-4">
                    <label>Discharge Date</label>
                    <input type="date" name="discharge_date" class="form-control" value="{{ old('discharge_date') }}">
                </div>
                <div class="col-md-4">
                    <label>Room/Ward/Bed</label>
                    <input type="text" name="room_number" class="form-control" value="{{ old('room_number') }}">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Attending Physician</label>
                    <select name="attending_physician_id" class="form-control">
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('attending_physician_id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Hospital Status</label>
                    <select name="hospital_status" class="form-control" required>
                        <option>Active</option>
                        <option>Discharged</option>
                        <option>Transferred</option>
                        <option>Deceased</option>
                    </select>
                </div>
            </div>

            <h5 class="mt-4">Account Information</h5>

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


            <h5 class="mt-4">Notes</h5>

            <div class="mb-3">
                <label>Additional Notes</label>
                <textarea name="notes" class="form-control">{{ old('notes') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">Save Patient</button>

        </form>

    </div>
</div>

@endsection
