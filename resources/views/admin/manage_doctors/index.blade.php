@extends('layouts.app')

@section('title', 'Doctors List')

@section('content')
<h1>Doctors List</h1>

{{-- Success Message --}}
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

{{-- Error Message --}}
@if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
@endif

{{-- Add Doctor Button --}}
<div class="mb-3 text-end">
    <a href="{{ route('admin.manage_doctors.create') }}" class="btn btn-success">+ Add Doctor</a>
</div>

{{-- Doctors Table --}}
<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Specialty</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($doctors as $doctor)
                    <tr>
                        <td>{{ $doctor->name }}</td>
                        <td>{{ $doctor->email }}</td>
                        <td>
                            @if($doctor->specialties)
                                @php
                                    $specialties = is_array($doctor->specialties)
                                        ? $doctor->specialties
                                        : (is_array(json_decode($doctor->specialties, true)) ? json_decode($doctor->specialties, true) : explode(',', $doctor->specialties));
                                @endphp
                                {{ implode(', ', array_map('trim', $specialties)) }}
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <span class="badge 
                                @if($doctor->status == 'Active') bg-success
                                @elseif($doctor->status == 'Inactive') bg-secondary
                                @elseif($doctor->status == 'Retired') bg-warning
                                @else bg-danger
                                @endif">
                                {{ $doctor->status ?? 'Unknown' }}
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('admin.manage_doctors.show', $doctor->id) }}" class="btn btn-sm btn-info">View</a>
                            <a href="{{ route('admin.manage_doctors.edit', $doctor->id) }}" class="btn btn-sm btn-primary">Edit</a>

                            <form action="{{ route('admin.manage_doctors.destroy', $doctor->id) }}"
                                  method="POST"
                                  style="display:inline-block;"
                                  onsubmit="return confirm('Are you sure you want to delete this doctor?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center">No doctors found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
