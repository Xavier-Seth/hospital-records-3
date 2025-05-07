<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    // Allow mass assignment for these fields
    protected $fillable = [
        'doctor_id',
        'patient_id',
        'date',
        'time',
        'status',
    ];

    // Doctor (User)
    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

    // Patient (User)
    public function patient()
    {
        return $this->belongsTo(User::class, 'patient_id');
    }
}
