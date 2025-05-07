@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Appointment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route(request()->routeIs('admin.*') ? 'admin.manage_appointments.store' : 'doctor.appointments.store') }}" method="POST">
        @csrf

        {{-- Doctor --}}
        <div class="mb-3">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Patient --}}
        <div class="mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" class="form-control" required>
                @forelse($patients as $patient)
                    <option value="{{ $patient->id }}">
                        @if(!empty($patient->full_name))
                            {{ $patient->full_name }}
                        @elseif(!empty($patient->first_name) || !empty($patient->last_name))
                            {{ $patient->first_name }} {{ $patient->last_name }}
                        @elseif(!empty($patient->name))
                            {{ $patient->name }}
                        @else
                            Unnamed Patient
                        @endif
                    </option>
                @empty
                    <option disabled>No patients found</option>
                @endforelse
            </select>
        </div>

        {{-- Date --}}
        <div class="mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" required>
        </div>

        {{-- Time --}}
        <div class="mb-3">
            <label for="time">Time</label>
            <input type="time" name="time" class="form-control" required>
        </div>

        {{-- Status --}}
        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending">Pending</option>
                <option value="approved">Approved</option>
                <option value="completed">Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Save Appointment</button>
    </form>
</div>
@endsection
