<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'first_name',
        'middle_name',
        'last_name',
        'date_of_birth',
        'gender',
        'age',
        'blood_type',
        'civil_status',
        'nationality',
        'religion',
        'phone',
        'email',
        'address',
        'emergency_contact_name',
        'emergency_contact_relationship',
        'emergency_contact_phone',
        'emergency_contact_address',
        'primary_condition',
        'allergies',
        'medications',
        'medical_history',
        'past_surgeries',
        'admission_date',
        'discharge_date',
        'room_number',
        'attending_physician_id',
        'hospital_status',
        'date_registered',
        'status',
        'photo',
        'notes',
    ];

    public function physician()
    {
        return $this->belongsTo(User::class, 'attending_physician_id');
    }
}
