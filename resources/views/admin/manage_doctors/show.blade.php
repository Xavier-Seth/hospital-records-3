@extends('layouts.app')

@section('title', 'View Doctor')

@section('content')
<h1 class="text-center mb-4">Doctor Profile</h1>

<div class="card mx-auto shadow-lg border-0" style="max-width: 950px; max-height: 650px; overflow-y: auto;">
    <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">{{ $doctor->name }}</h3>
        <small>{{ $doctor->position ?? 'Doctor' }} | {{ $doctor->department ?? 'N/A' }}</small>
    </div>

    <div class="card-body p-4 bg-light">

        <div class="row">

            <!-- LEFT SIDE: Profile Info -->
            <div class="col-md-4 text-center border-end">
                <div class="mb-3">
                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('images/boy.png') }}" 
                         alt="Photo" 
                         width="150" 
                         class="rounded-circle shadow border border-3 border-primary">
                </div>
                
                <h5>Status</h5>
                <span class="badge 
                    @if($doctor->status == 'Active') bg-success 
                    @elseif($doctor->status == 'Inactive') bg-secondary 
                    @else bg-warning 
                    @endif">
                    {{ $doctor->status }}
                </span>

                <h5 class="mt-4">Doctor ID</h5>
                <p>{{ $doctor->doctor_id ?? 'N/A' }}</p>

                <h5>On Call</h5>
                <p>{{ $doctor->on_call ? 'Yes' : 'No' }}</p>

                <h5>Patients Handled</h5>
                <p>{{ $doctor->patients_handled ?? 'N/A' }}</p>
            </div>

            <!-- RIGHT SIDE: Details -->
            <div class="col-md-8">
                <h5 class="text-primary">Personal Information</h5>
                <p><strong>Email:</strong> {{ $doctor->email }}</p>
                <p><strong>Gender:</strong> {{ $doctor->gender }}</p>
                <p><strong>Date of Birth:</strong> {{ $doctor->date_of_birth }}</p>
                <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
                <p><strong>Address:</strong> {{ $doctor->address }}</p>

                <hr>

                <h5 class="text-primary">Professional Information</h5>
                <p><strong>License Number:</strong> {{ $doctor->license_number ?? 'N/A' }}</p>
                <p><strong>PRC Number:</strong> {{ $doctor->prc_number ?? 'N/A' }}</p>
                <p><strong>License Expiry:</strong> {{ $doctor->license_expiry ?? 'N/A' }}</p>
                <p><strong>Years of Experience:</strong> {{ $doctor->years_experience ?? 'N/A' }}</p>

                <p><strong>Specialties:</strong> 
                    @if($doctor->specialties)
                        @foreach(json_decode($doctor->specialties) as $specialty)
                            <span class="badge bg-info text-dark">{{ $specialty }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <p><strong>Subspecialties:</strong> 
                    @if($doctor->subspecialties)
                        @foreach(json_decode($doctor->subspecialties) as $subspecialty)
                            <span class="badge bg-secondary">{{ $subspecialty }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <hr>

                <h5 class="text-primary">Availability</h5>
                <p><strong>Days Available:</strong> 
                    @if($doctor->days_available)
                        @foreach(json_decode($doctor->days_available) as $day)
                            <span class="badge bg-success">{{ $day }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <p><strong>Time Slots:</strong> 
                    @if($doctor->time_slots)
                        @foreach(json_decode($doctor->time_slots) as $slot)
                            <span class="badge bg-warning text-dark">{{ $slot }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>
            </div>

        </div>

        <div class="text-center mt-4">
            <a href="{{ route('admin.manage_doctors.index') }}" class="btn btn-secondary">Back to List</a>
            <a href="{{ route('admin.manage_doctors.edit', $doctor->id) }}" class="btn btn-primary">Edit Doctor</a>
        </div>
    </div>
</div>

<!-- Scroll to Top Button -->
<button onclick="topFunction()" id="backToTopBtn" title="Go to top" 
    style="position: fixed; bottom: 40px; right: 40px; display:none; background-color:#0d6efd; color:white; border:none; padding:10px 15px; border-radius:50%; font-size:16px; cursor:pointer;">
    ↑
</button>

<script>
// Scroll show/hide button
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
