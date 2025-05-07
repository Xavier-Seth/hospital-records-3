@extends('layouts.app')

@section('title', 'My Appointments')

@section('content')
<div class="container">
    <h1>My Appointments</h1>

    @if($appointments->isEmpty())
        <p>No appointments found.</p>
    @else
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Doctor</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Reason</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->doctor ? $appointment->doctor->name : 'N/A' }}</td>
                    <td>{{ $appointment->date }}</td>
                    <td>{{ $appointment->time }}</td>
                    <td>{{ $appointment->reason }}</td>
                    <td>
                        <span class="badge 
                            @if($appointment->status == 'Pending') bg-warning
                            @elseif($appointment->status == 'Approved') bg-success
                            @elseif($appointment->status == 'Declined') bg-danger
                            @else bg-secondary
                            @endif">
                            {{ $appointment->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
