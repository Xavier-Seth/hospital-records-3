<div class="sidebar d-flex flex-column">
    <img src="{{ asset('img/profile.png') }}" alt="Profile">
    <h5>{{ auth()->user()->name }}</h5>

    <nav class="nav flex-column w-75">

        <!-- Dashboard (Dynamic per Role) -->
        <a class="nav-link {{ request()->routeIs('admin.dashboard') || request()->routeIs('doctor.dashboard') || request()->routeIs('patient.dashboard') ? 'active' : '' }}" 
           href="@if(auth()->user()->role === 'admin')
                    {{ route('admin.dashboard') }}
                @elseif(auth()->user()->role === 'doctor')
                    {{ route('doctor.dashboard') }}
                @elseif(auth()->user()->role === 'patient')
                    {{ route('patient.dashboard') }}
                @endif">
            <i class="bi bi-grid"></i> Dashboard
        </a>

        <!-- Manage Doctors (Admin only) -->
        @if(auth()->user()->role === 'admin')
        <a class="nav-link {{ request()->routeIs('admin.manage_doctors.index') ? 'active' : '' }}" href="{{ route('admin.manage_doctors.index') }}">
            <i class="bi bi-person-vcard"></i> Manage Doctors
        </a>
        @endif

        <!-- Manage Patients (Admin and Doctor) -->
        @if(auth()->user()->role === 'admin' || auth()->user()->role === 'doctor')
        <a class="nav-link 
            @if(auth()->user()->role === 'admin' && request()->routeIs('admin.manage_patients.index')) active 
            @elseif(auth()->user()->role === 'doctor' && request()->routeIs('doctor.patients.index')) active 
            @endif" 
           href="@if(auth()->user()->role === 'admin')
                    {{ route('admin.manage_patients.index') }}
                @elseif(auth()->user()->role === 'doctor')
                    {{ route('doctor.patients.index') }}
                @endif">
            <i class="bi bi-person-lines-fill"></i> Manage Patients
        </a>
        @endif

        <!-- Appointments (Admin, Doctor, Patient) -->
        @if(in_array(auth()->user()->role, ['admin', 'doctor', 'patient']))
        <a class="nav-link 
            @if(auth()->user()->role === 'admin' && request()->routeIs('admin.manage_appointments.index')) active 
            @elseif(auth()->user()->role === 'doctor' && request()->routeIs('doctor.appointments.index')) active 
            @elseif(auth()->user()->role === 'patient' && request()->routeIs('patient.appointments')) active 
            @endif" 
           href="@if(auth()->user()->role === 'admin')
                    {{ route('admin.manage_appointments.index') }}
                @elseif(auth()->user()->role === 'doctor')
                    {{ route('doctor.appointments.index') }}
                @elseif(auth()->user()->role === 'patient')
                    {{ route('patient.appointments.index') }}
                @endif">
            <i class="bi bi-calendar-event"></i> Appointments
        </a>
        @endif

        <!-- User Management (Admin only) -->
        {{-- 
        @if(auth()->user()->role === 'admin')
        <a class="nav-link {{ request()->routeIs('admin.user_management.index') ? 'active' : '' }}" href="{{ route('admin.user_management.index') }}">
            <i class="bi bi-people"></i> User Management
        </a>
        @endif 
        --}}

    </nav>

    <div class="w-75 mt-auto mb-3 px-3">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-link nav-link d-flex align-items-center w-100 text-white">
                <i class="bi bi-power"></i> <span>Logout</span>
            </button>
        </form>
    </div>
</div>
