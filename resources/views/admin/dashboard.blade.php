@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <h1>Welcome to Admin Dashboard</h1>
    <p>You are logged in as Admin.</p>

    <div class="row mt-5">

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
@endsection
