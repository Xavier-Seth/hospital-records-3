@extends('layouts.app')

@section('content')
<h1 class="text-center mb-4">Patient Profile</h1>

<div class="card mx-auto shadow-lg border-0" style="max-width: 950px; max-height: 650px; overflow-y: auto;">
    <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</h3>
        <small>Patient ID: {{ $patient->patient_id }}</small>
    </div>

    <div class="card-body p-4 bg-light">

        <div class="row">

            <!-- LEFT SIDE: Photo and Status -->
            <div class="col-md-4 text-center border-end">
                <div class="mb-3">
                    <img src="{{ $patient->photo ? asset('storage/' . $patient->photo) : asset('images/default.png') }}" 
                         alt="Photo" 
                         width="150" 
                         class="rounded-circle shadow border border-3 border-primary">
                </div>

                <h5>Status</h5>
                <span class="badge 
                    @if($patient->status == 'Active') bg-success 
                    @elseif($patient->status == 'Archived') bg-secondary 
                    @elseif($patient->status == 'Deceased') bg-danger 
                    @else bg-warning 
                    @endif">
                    {{ $patient->status }}
                </span>

                <h5 class="mt-4">Age</h5>
                <p>{{ $patient->age ?? 'N/A' }}</p>

                <h5>Blood Type</h5>
                <p>{{ $patient->blood_type ?? 'N/A' }}</p>

                <h5>Emergency Contact</h5>
                <p><strong>Name:</strong> {{ $patient->emergency_contact_name ?? 'N/A' }}</p>
                <p><strong>Relationship:</strong> {{ $patient->emergency_contact_relationship ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $patient->emergency_contact_phone ?? 'N/A' }}</p>
            </div>

            <!-- RIGHT SIDE: Details -->
            <div class="col-md-8">
                <h5 class="text-primary">Personal Information</h5>
                <p><strong>Gender:</strong> {{ $patient->gender }}</p>
                <p><strong>Date of Birth:</strong> {{ $patient->date_of_birth }}</p>
                <p><strong>Phone:</strong> {{ $patient->phone }}</p>
                <p><strong>Email:</strong> {{ $patient->email }}</p>
                <p><strong>Address:</strong> {{ $patient->address }}</p>
                <p><strong>Nationality:</strong> {{ $patient->nationality ?? 'N/A' }}</p>
                <p><strong>Religion:</strong> {{ $patient->religion ?? 'N/A' }}</p>

                <hr>

                <h5 class="text-primary">Medical Information</h5>
                <p><strong>Primary Condition:</strong> {{ $patient->primary_condition ?? 'N/A' }}</p>
                <p><strong>Allergies:</strong> 
                    @if($patient->allergies)
                        @foreach(explode(',', $patient->allergies) as $allergy)
                            <span class="badge bg-danger">{{ trim($allergy) }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>
                <p><strong>Medications:</strong> {{ $patient->medications ?? 'N/A' }}</p>
                <p><strong>Medical History:</strong> {{ $patient->medical_history ?? 'N/A' }}</p>
                <p><strong>Past Surgeries:</strong> {{ $patient->past_surgeries ?? 'N/A' }}</p>

                <hr>

                <h5 class="text-primary">Hospitalization</h5>
                <p><strong>Admission Date:</strong> {{ $patient->admission_date ?? 'N/A' }}</p>
                <p><strong>Discharge Date:</strong> {{ $patient->discharge_date ?? 'N/A' }}</p>
                <p><strong>Room Number:</strong> {{ $patient->room_number ?? 'N/A' }}</p>
                <p><strong>Attending Physician:</strong> {{ $patient->attending_physician_id ?? 'N/A' }}</p>
                <p><strong>Hospital Status:</strong> {{ $patient->hospital_status ?? 'N/A' }}</p>

                <hr>

                <h5 class="text-primary">Notes</h5>
                <p>{{ $patient->notes ?? 'N/A' }}</p>
            </div>

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('doctor.patients.index') }}" class="btn btn-secondary">Back to Patients</a>
        </div>

    </div>
</div>

<!-- Scroll to Top Button -->
<button onclick="topFunction()" id="backToTopBtn" title="Go to top" 
    style="position: fixed; bottom: 40px; right: 40px; display:none; background-color:#0d6efd; color:white; border:none; padding:10px 15px; border-radius:50%; font-size:16px; cursor:pointer;">
    ↑
</button>

<script>
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    const btn = document.getElementById("backToTopBtn");
    if (document.body.scrollTop > 150 || document.documentElement.scrollTop > 150) {
        btn.style.display = "block";
    } else {
        btn.style.display = "none";
    }
}

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}
</script>
@endsection
