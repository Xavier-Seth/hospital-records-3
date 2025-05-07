@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<div class="container">
    <h1>Welcome to Admin Dashboard</h1>
    <p>You are logged in as Admin.</p>

    <!-- Total Widgets -->
    <div class="row pb-4 mt-5">

        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Doctors</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalDoctors }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Patients</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalPatients }}</h5>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-header">Total Appointments</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $totalAppointments }}</h5>
                </div>
            </div>
        </div>

    </div>

    <!-- Recent Doctors and Patients Tables -->
    <div class="row  mt-1">

        <!-- Recent Doctors Table -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-primary text-white">
                    Recent Doctors
                </div>
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto; scrollbar-gutter: stable;">
                    <table class="table mb-0">
                        <thead style="position: sticky; top: 0; background-color: #f8f9fa;">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentDoctors as $doctor)
                            <tr>
                                <td>{{ $doctor->name }}</td>
                                <td>{{ $doctor->email }}</td>
                                <td>{{ $doctor->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No doctors found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Recent Patients Table -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header bg-success text-white">
                    Recent Patients
                </div>
                <div class="card-body p-0" style="max-height: 400px; overflow-y: auto; scrollbar-gutter: stable;">

                    <table class="table mb-0">
                        <thead style="position: sticky; top: 0; background-color: #f8f9fa;">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Joined</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentPatients as $patient)
                            <tr>
                                <td>{{ $patient->name }}</td>
                                <td>{{ $patient->email }}</td>
                                <td>{{ $patient->created_at->format('Y-m-d') }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center">No patients found.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
