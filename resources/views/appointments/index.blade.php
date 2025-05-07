@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Appointments</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- Add button (Only for Admin and Doctor) --}}
    @if(auth()->user()->role === 'admin' || auth()->user()->role === 'doctor')
        <a href="{{ route(request()->routeIs('admin.*') ? 'admin.manage_appointments.create' : 'doctor.appointments.create') }}" class="btn btn-primary mb-3">Create Appointment</a>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Doctor</th>
                <th>Patient</th>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    {{-- Doctor --}}
                    <td>{{ $appointment->doctor->name ?? 'N/A' }}</td>

                    {{-- Patient --}}
                    <td>
                        @if($appointment->patient)
                            @if(!empty($appointment->patient->full_name))
                                {{ $appointment->patient->full_name }}
                            @elseif(!empty($appointment->patient->first_name) || !empty($appointment->patient->last_name))
                                {{ $appointment->patient->first_name }} {{ $appointment->patient->last_name }}
                            @elseif(!empty($appointment->patient->name))
                                {{ $appointment->patient->name }}
                            @else
                                Unnamed Patient
                            @endif
                        @else
                            N/A
                        @endif
                    </td>

                    {{-- Date --}}
                    <td>{{ $appointment->date }}</td>

                    {{-- Time --}}
                    <td>{{ \Carbon\Carbon::parse($appointment->time)->format('h:i A') }}</td>

                    {{-- Status --}}
                    <td>{{ ucfirst($appointment->status) }}</td>

                    {{-- Actions --}}
                    <td>
                        {{-- Edit Button --}}
                        <a href="{{ route(request()->routeIs('admin.*') ? 'admin.manage_appointments.edit' : 'doctor.appointments.edit', $appointment->id) }}" 
                           class="btn btn-warning btn-sm">Edit</a>

                        {{-- Delete Button --}}
                        <form action="{{ route(request()->routeIs('admin.*') ? 'admin.manage_appointments.destroy' : 'doctor.appointments.destroy', $appointment->id) }}" 
                              method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this appointment?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">No appointments found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
