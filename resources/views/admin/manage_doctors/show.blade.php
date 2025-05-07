@extends('layouts.app')

@section('title', 'View Doctor')

@section('content')
<h1 class="text-center mb-4">Doctor Profile</h1>

<div class="card mx-auto shadow-lg border-0" style="max-width: 950px; max-height: 650px; overflow-y: auto;">
    <div class="card-header bg-primary text-white text-center">
        <h3 class="mb-0">{{ $doctor->name }}</h3>
        <small>Doctor ID: {{ $doctor->doctor_id }}</small>
    </div>

    <div class="card-body p-4 bg-light">

        <div class="row">

            <!-- LEFT SIDE: Profile Info -->
            <div class="col-md-4 text-center border-end">
                <div class="mb-3">
                    <img src="{{ $doctor->photo ? asset('storage/' . $doctor->photo) : asset('images/default.png') }}" 
                         alt="Photo" 
                         width="150" 
                         class="rounded-circle shadow border border-3 border-primary">
                </div>

                <h5>Status</h5>
                <span class="badge 
                    @if($doctor->status == 'Active') bg-success 
                    @elseif($doctor->status == 'Inactive') bg-secondary 
                    @elseif($doctor->status == 'Retired') bg-warning 
                    @elseif($doctor->status == 'Resigned') bg-danger 
                    @endif">
                    {{ $doctor->status }}
                </span>

                <h5 class="mt-4">On Call</h5>
                <p>{{ $doctor->on_call ? 'Yes' : 'No' }}</p>

                <h5>Patients Handled</h5>
                <p>{{ $doctor->patients_handled ?? 'N/A' }}</p>

                <h5>Department</h5>
                <p>{{ $doctor->department ?? 'N/A' }}</p>

                <h5>Position</h5>
                <p>{{ $doctor->position ?? 'N/A' }}</p>
            </div>

            <!-- RIGHT SIDE: Details -->
            <div class="col-md-8">
                <h5 class="text-primary">Personal Information</h5>
                <p><strong>Gender:</strong> {{ $doctor->gender }}</p>
                <p><strong>Date of Birth:</strong> {{ $doctor->date_of_birth }}</p>
                <p><strong>Phone:</strong> {{ $doctor->phone }}</p>
                <p><strong>Email:</strong> {{ $doctor->email }}</p>
                <p><strong>Address:</strong> {{ $doctor->address }}</p>

                <hr>

                @php
                    $specialties = is_array(json_decode($doctor->specialties, true)) ? json_decode($doctor->specialties, true) : ( $doctor->specialties ? [$doctor->specialties] : [] );
                    $subspecialties = is_array(json_decode($doctor->subspecialties, true)) ? json_decode($doctor->subspecialties, true) : ( $doctor->subspecialties ? [$doctor->subspecialties] : [] );
                    $daysAvailable = is_array(json_decode($doctor->days_available, true)) ? json_decode($doctor->days_available, true) : ( $doctor->days_available ? [$doctor->days_available] : [] );
                    $timeSlots = is_array(json_decode($doctor->time_slots, true)) ? json_decode($doctor->time_slots, true) : ( $doctor->time_slots ? [$doctor->time_slots] : [] );
                @endphp

                <h5 class="text-primary">Professional Information</h5>
                <p><strong>Specialties:</strong> 
                    @if(count($specialties))
                        @foreach($specialties as $item)
                            <span class="badge bg-info text-dark">{{ trim($item) }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <p><strong>Subspecialties:</strong> 
                    @if(count($subspecialties))
                        @foreach($subspecialties as $item)
                            <span class="badge bg-info text-dark">{{ trim($item) }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <p><strong>License No.:</strong> {{ $doctor->license_number }}</p>
                <p><strong>PRC No.:</strong> {{ $doctor->prc_number }}</p>
                <p><strong>License Expiry:</strong> {{ $doctor->license_expiry }}</p>
                <p><strong>Years of Experience:</strong> {{ $doctor->years_experience }}</p>

                <hr>

                <h5 class="text-primary">Availability</h5>
                <p><strong>Days Available:</strong> 
                    @if(count($daysAvailable))
                        @foreach($daysAvailable as $day)
                            <span class="badge bg-success">{{ trim($day) }}</span>
                        @endforeach
                    @else
                        <span class="text-muted">N/A</span>
                    @endif
                </p>

                <p><strong>Time Slots:</strong> 
                    @if(count($timeSlots))
                        @foreach($timeSlots as $slot)
                            <span class="badge bg-warning text-dark">{{ trim($slot) }}</span>
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
