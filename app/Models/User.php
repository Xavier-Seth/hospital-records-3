<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',

        // Add all your doctor info fields here too ↓↓↓
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'date_of_birth',
        'phone',
        'address',
        'specialties',
        'subspecialties',
        'license_number',
        'prc_number',
        'license_expiry',
        'years_experience',
        'department',
        'position',
        'doctor_id',
        'days_available',
        'time_slots',
        'on_call',
        'patients_handled',
        'status',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',

        // THIS IS WHERE YOU PASTE IT
        'specialties' => 'array',
        'subspecialties' => 'array',
        'days_available' => 'array',
        'time_slots' => 'array',
    ];

    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }
}
