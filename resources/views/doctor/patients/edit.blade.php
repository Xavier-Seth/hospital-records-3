@extends('layouts.app')

@section('content')
<h1 class="text-center mb-4">Edit Patient</h1>

<div class="card mx-auto shadow-lg border-0" style="max-width: 950px; max-height: 650px; overflow-y: auto;">
    <div class="card-body p-4 bg-light">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('doctor.patients.update', $patient->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- PERSONAL INFORMATION -->
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="mb-3">Personal Information</h4>

                <div class="row mb-3">
                    {{-- Photo --}}
                    <div class="col-md-4 text-center">
                        <img src="{{ $patient->photo ? asset('storage/' . $patient->photo) : asset('images/default.png') }}" 
                             alt="Photo" 
                             width="150" 
                             class="rounded-circle shadow border border-3 border-primary mb-3">
                        <input type="file" name="photo" class="form-control">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>First Name</label>
                        <input type="text" name="first_name" class="form-control" value="{{ old('first_name', $patient->first_name) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label>Middle Name</label>
                        <input type="text" name="middle_name" class="form-control" value="{{ old('middle_name', $patient->middle_name) }}">
                    </div>

                    <div class="col-md-4">
                        <label>Last Name</label>
                        <input type="text" name="last_name" class="form-control" value="{{ old('last_name', $patient->last_name) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                            <option value="">Select Gender</option>
                            <option value="Male" {{ old('gender', $patient->gender) == 'Male' ? 'selected' : '' }}>Male</option>
                            <option value="Female" {{ old('gender', $patient->gender) == 'Female' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <div class="col-md-4">
                        <label>Date of Birth</label>
                        <input type="date" name="date_of_birth" class="form-control" value="{{ old('date_of_birth', $patient->date_of_birth) }}" required>
                    </div>

                    <div class="col-md-4">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone', $patient->phone) }}" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" value="{{ old('email', $patient->email) }}" required>
                    </div>

                    <div class="col-md-6">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control" value="{{ old('address', $patient->address) }}">
                    </div>
                </div>
            </div>

            <!-- MEDICAL INFORMATION -->
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="mb-3">Medical Information</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Primary Condition</label>
                        <input type="text" name="primary_condition" class="form-control" value="{{ old('primary_condition', $patient->primary_condition) }}">
                    </div>

                    <div class="col-md-6">
                        <label>Allergies (Comma separated)</label>
                        <input type="text" name="allergies" class="form-control" value="{{ old('allergies', $patient->allergies) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Medications</label>
                        <input type="text" name="medications" class="form-control" value="{{ old('medications', $patient->medications) }}">
                    </div>

                    <div class="col-md-6">
                        <label>Medical History</label>
                        <input type="text" name="medical_history" class="form-control" value="{{ old('medical_history', $patient->medical_history) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Past Surgeries</label>
                        <input type="text" name="past_surgeries" class="form-control" value="{{ old('past_surgeries', $patient->past_surgeries) }}">
                    </div>

                    <div class="col-md-6">
                        <label>Blood Type</label>
                        <select name="blood_type" class="form-control">
                            <option value="">Select Blood Type</option>
                            <option value="A+" {{ old('blood_type', $patient->blood_type) == 'A+' ? 'selected' : '' }}>A+</option>
                            <option value="A-" {{ old('blood_type', $patient->blood_type) == 'A-' ? 'selected' : '' }}>A-</option>
                            <option value="B+" {{ old('blood_type', $patient->blood_type) == 'B+' ? 'selected' : '' }}>B+</option>
                            <option value="B-" {{ old('blood_type', $patient->blood_type) == 'B-' ? 'selected' : '' }}>B-</option>
                            <option value="AB+" {{ old('blood_type', $patient->blood_type) == 'AB+' ? 'selected' : '' }}>AB+</option>
                            <option value="AB-" {{ old('blood_type', $patient->blood_type) == 'AB-' ? 'selected' : '' }}>AB-</option>
                            <option value="O+" {{ old('blood_type', $patient->blood_type) == 'O+' ? 'selected' : '' }}>O+</option>
                            <option value="O-" {{ old('blood_type', $patient->blood_type) == 'O-' ? 'selected' : '' }}>O-</option>
                        </select>
                    </div>
                    
                </div>
            </div>

            <!-- HOSPITALIZATION -->
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="mb-3">Hospitalization</h4>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Admission Date</label>
                        <input type="date" name="admission_date" class="form-control" value="{{ old('admission_date', $patient->admission_date) }}">
                    </div>
                    <div class="col-md-4">
                        <label>Discharge Date</label>
                        <input type="date" name="discharge_date" class="form-control" value="{{ old('discharge_date', $patient->discharge_date) }}">
                    </div>
                    <div class="col-md-4">
                        <label>Room Number</label>
                        <input type="text" name="room_number" class="form-control" value="{{ old('room_number', $patient->room_number) }}">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Hospital Status</label>
                        <select name="hospital_status" class="form-control" required>
                            <option value="">Select Status</option>
                            <option value="Admitted" {{ old('hospital_status', $patient->hospital_status) == 'Admitted' ? 'selected' : '' }}>Admitted</option>
                            <option value="Discharged" {{ old('hospital_status', $patient->hospital_status) == 'Discharged' ? 'selected' : '' }}>Discharged</option>
                        </select>
                    </div>
                    
                </div>
            </div>

            <!-- STATUS -->
            <div class="card shadow-sm p-4 mb-4">
                <h4 class="mb-3">Status</h4>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Status</label>
                        <select name="status" class="form-control" required>
                            <option value="Active" {{ old('status', $patient->status) == 'Active' ? 'selected' : '' }}>Active</option>
                            <option value="Archived" {{ old('status', $patient->status) == 'Archived' ? 'selected' : '' }}>Archived</option>
                            <option value="Deceased" {{ old('status', $patient->status) == 'Deceased' ? 'selected' : '' }}>Deceased</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-success">Update Patient</button>
                <a href="{{ route('doctor.patients.index') }}" class="btn btn-secondary">Back to Patients</a>
            </div>

        </form>
    </div>
</div>
@endsection
