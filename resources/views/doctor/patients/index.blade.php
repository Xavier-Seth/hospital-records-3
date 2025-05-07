@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Patients</h2>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('doctor.patients.create') }}" class="btn btn-primary mb-3">Add Patient</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Patient ID</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($patients as $patient)
                <tr>
                    <td>{{ $patient->patient_id }}</td>
                    <td>{{ $patient->first_name }} {{ $patient->middle_name }} {{ $patient->last_name }}</td>
                    <td>{{ $patient->gender }}</td>
                    <td>{{ $patient->date_of_birth }}</td>
                    <td>{{ $patient->phone }}</td>
                    <td>{{ $patient->email }}</td>
                    <td>
                        @if($patient->status == 'Active')
                            <span class="badge bg-success">Active</span>
                        @elseif($patient->status == 'Inactive')
                            <span class="badge bg-secondary">Inactive</span>
                        @elseif($patient->status == 'Archived')
                            <span class="badge bg-dark">Archived</span>
                        @elseif($patient->status == 'Deceased')
                            <span class="badge bg-danger">Deceased</span>
                        @else
                            <span class="badge bg-warning">Unknown</span>
                        @endif
                    </td>
                    <td>
                        <div class="btn-group" role="group" aria-label="Actions">
                            <a href="{{ route('doctor.patients.show', $patient->id) }}" class="btn btn-info btn-sm me-1">View</a>
                            <a href="{{ route('doctor.patients.edit', $patient->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                            <form action="{{ route('doctor.patients.destroy', $patient->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure?')" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center">No patients found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
