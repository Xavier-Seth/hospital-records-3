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

<!-- Scrollable container -->
<div class="card" style="max-height: 600px; overflow-y: auto;">
    <div class="card-body">

        <form action="{{ route('admin.manage_doctors.update', $doctor->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h5>Personal Information</h5>

            <div class="mb-3">
                <label>Current Photo</label><br>
                @if($doctor->photo)
                    <img src="{{ asset('storage/' . $doctor->photo) }}" alt="Photo" width="100">
                @else
                    No photo uploaded.
                @endif
            </div>

            <div class="mb-3">
                <label>Change Photo</label>
                <div class="col-md-4">
                    <input type="file" name="photo" class="form-control">
                </div>
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

            <div class="mb-3">
                <label>Address</label>
                <input type="text" name="address" class="form-control" value="{{ old('address', $doctor->address) }}">
            </div>

            <h5 class="mt-5">Professional Information</h5>

            <div class="row mb-3">
                <div class="col-md-3">
                    <label>Specialties</label>
                    @php $selectedSpecialties = old('specialties') ?? json_decode($doctor->specialties, true) ?? []; @endphp
                    <select name="specialties[]" class="form-control" multiple>
                        <option {{ in_array('Pediatrics', $selectedSpecialties) ? 'selected' : '' }}>Pediatrics</option>
                        <option {{ in_array('Cardiology', $selectedSpecialties) ? 'selected' : '' }}>Cardiology</option>
                        <option {{ in_array('Neurology', $selectedSpecialties) ? 'selected' : '' }}>Neurology</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label>Subspecialties</label>
                    @php $selectedSub = old('subspecialties') ?? json_decode($doctor->subspecialties, true) ?? []; @endphp
                    <select name="subspecialties[]" class="form-control" multiple>
                        <option {{ in_array('Pediatric Neurology', $selectedSub) ? 'selected' : '' }}>Pediatric Neurology</option>
                        <option {{ in_array('Cardiac Surgery', $selectedSub) ? 'selected' : '' }}>Cardiac Surgery</option>
                    </select>
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
                    <label>License Expiry Date</label>
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
                    <label>Department Assigned</label>
                    <select name="department" class="form-control">
                        <option {{ old('department', $doctor->department) == 'Surgery' ? 'selected' : '' }}>Surgery</option>
                        <option {{ old('department', $doctor->department) == 'Pediatrics' ? 'selected' : '' }}>Pediatrics</option>
                        <option {{ old('department', $doctor->department) == 'Emergency' ? 'selected' : '' }}>Emergency</option>
                    </select>
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
                    <label>Days Available</label>
                    @php $daysAvailable = old('days_available') ?? json_decode($doctor->days_available, true) ?? []; @endphp
                    <select name="days_available[]" class="form-control" multiple>
                        @foreach(['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $day)
                            <option {{ in_array($day, $daysAvailable) ? 'selected' : '' }}>{{ $day }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>Time Slots</label>
                    @php $timeSlots = old('time_slots') ?? json_decode($doctor->time_slots, true) ?? []; @endphp
                    <select name="time_slots[]" class="form-control" multiple>
                        @foreach(['Morning','Afternoon','Night'] as $slot)
                            <option {{ in_array($slot, $timeSlots) ? 'selected' : '' }}>{{ $slot }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label>On Call Availability</label>
                    <select name="on_call" class="form-control">
                        <option value="0" {{ old('on_call', $doctor->on_call) == 0 ? 'selected' : '' }}>No</option>
                        <option value="1" {{ old('on_call', $doctor->on_call) == 1 ? 'selected' : '' }}>Yes</option>
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

            <button type="submit" class="btn btn-primary">Update Doctor</button>
        </form>

    </div>
</div>
@endsection
