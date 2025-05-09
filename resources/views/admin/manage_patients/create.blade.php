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

<div class="card" style="height: 85vh; display: flex; flex-direction: column;">
    <form action="{{ route('admin.manage_patients.store') }}" method="POST" enctype="multipart/form-data" style="display: contents;">
        @csrf

        <div class="card-body overflow-auto px-4">
            {{-- Personal Information --}}
            <h5>Personal Information</h5>

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
                    <label>Date of Birth</label>
                    <input type="date" name="date_of_birth" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Gender</label>
                    <select name="gender" class="form-control" required>
                        <option value="">Select Gender</option>
                        <option>Male</option>
                        <option>Female</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Age</label>
                    <input type="number" name="age" class="form-control" required>
                </div>
                <div class="col-md-3">
                    <label>Blood Type</label>
                    <select name="blood_type" class="form-control">
                        <option value="">Select Blood Type</option>
                        @foreach(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'] as $bloodType)
                            <option value="{{ $bloodType }}">{{ $bloodType }}</option>
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
                            <option value="{{ $status }}">{{ $status }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Nationality</label>
                    <input type="text" name="nationality" class="form-control">
                </div>
                <div class="col-md-3">
                    <label>Religion</label>
                    <input type="text" name="religion" class="form-control">
                </div>
            </div>

            {{-- Contact & Emergency --}}
            <h5 class="mt-4">Contact & Emergency Info</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Emergency Contact Name</label>
                    <input type="text" name="emergency_contact_name" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Relationship</label>
                    <input type="text" name="emergency_contact_relationship" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Phone</label>
                    <input type="text" name="emergency_contact_phone" class="form-control">
                </div>
            </div>

            <div class="mb-3">
                <label>Emergency Contact Address</label>
                <input type="text" name="emergency_contact_address" class="form-control">
            </div>

            {{-- Medical Info --}}
            <h5 class="mt-4">Medical Information</h5>

            <div class="mb-3">
                <label>Primary Medical Condition</label>
                <input type="text" name="primary_condition" class="form-control">
            </div>

            <div class="mb-3">
                <label>Allergies</label>
                <input type="text" name="allergies" class="form-control">
            </div>

            <div class="mb-3">
                <label>Medications</label>
                <input type="text" name="medications" class="form-control">
            </div>

            <div class="mb-3">
                <label>Medical History</label>
                <textarea name="medical_history" class="form-control"></textarea>
            </div>

            <div class="mb-3">
                <label>Past Surgeries</label>
                <textarea name="past_surgeries" class="form-control"></textarea>
            </div>

            {{-- Hospitalization --}}
            <h5 class="mt-4">Hospitalization</h5>

            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Admission Date</label>
                    <input type="date" name="admission_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Discharge Date</label>
                    <input type="date" name="discharge_date" class="form-control">
                </div>
                <div class="col-md-4">
                    <label>Room/Ward/Bed</label>
                    <input type="text" name="room_number" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label>Attending Physician</label>
                    <select name="attending_physician_id" class="form-control">
                        <option value="">Select Doctor</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
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

            {{-- Account Info --}}
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

            {{-- Notes --}}
            <h5 class="mt-4">Notes</h5>

            <div class="mb-3">
                <label>Additional Notes</label>
                <textarea name="notes" class="form-control"></textarea>
            </div>
        </div>

        {{-- Submit Button Always Visible --}}
        <div class="card-footer text-end py-3 px-4 bg-white border-top">
            <button type="submit" class="btn btn-primary">Save Patient</button>
        </div>
    </form>
</div>
@endsection
