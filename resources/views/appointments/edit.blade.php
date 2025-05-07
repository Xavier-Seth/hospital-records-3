@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Appointment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route(request()->routeIs('admin.*') ? 'admin.manage_appointments.update' : 'doctor.appointments.update', $appointment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="doctor_id">Doctor</label>
            <select name="doctor_id" class="form-control" required>
                @foreach($doctors as $doctor)
                    <option value="{{ $doctor->id }}" {{ $appointment->doctor_id == $doctor->id ? 'selected' : '' }}>
                        {{ $doctor->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="patient_id">Patient</label>
            <select name="patient_id" class="form-control" required>
                @foreach($patients as $patient)
                    <option value="{{ $patient->id }}" {{ $appointment->patient_id == $patient->id ? 'selected' : '' }}>
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
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="date">Date</label>
            <input type="date" name="date" class="form-control" value="{{ $appointment->date }}" required>
        </div>

        <div class="mb-3">
            <label for="time">Time</label>
            <input type="time" name="time" class="form-control" value="{{ $appointment->time }}" required>
        </div>

        <div class="mb-3">
            <label for="status">Status</label>
            <select name="status" class="form-control" required>
                <option value="pending" {{ $appointment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $appointment->status == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="completed" {{ $appointment->status == 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Appointment</button>
    </form>
</div>
@endsection
