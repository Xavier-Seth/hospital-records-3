@extends('layouts.app')

@section('title', 'Patients List')

@section('content')
<h1>Patients List</h1>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="mb-3 text-end">
    <a href="{{ route('admin.manage_patients.create') }}" class="btn btn-success">+ Add Patient</a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Patient ID</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td>{{ $patient->patient_id }}</td>
                        <td>{{ $patient->full_name }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>{{ $patient->status }}</td>
                        <td>
                            <a href="{{ route('admin.manage_patients.show', $patient->id) }}" class="btn btn-info btn-sm">View</a>
                            <a href="{{ route('admin.manage_patients.edit', $patient->id) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('admin.manage_patients.destroy', $patient->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center">No patients found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
