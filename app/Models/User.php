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

        // Doctor info fields
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

        // Cast arrays properly
        'specialties' => 'array',
        'subspecialties' => 'array',
        'days_available' => 'array',
        'time_slots' => 'array',
    ];

    /**
     * Check the user's role.
     */
    public function hasRole(string $role): bool
    {
        return $this->role === $role;
    }

    /**
     * Relationship: User has many appointments (if doctor)
     */
    public function appointments()
    {
        return $this->hasMany(\App\Models\Appointment::class, 'doctor_id');
    }
}
