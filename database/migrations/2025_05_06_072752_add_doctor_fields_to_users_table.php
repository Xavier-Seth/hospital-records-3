<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->text('specialties')->nullable();
            $table->text('subspecialties')->nullable();
            $table->string('license_number')->nullable();
            $table->string('prc_number')->nullable();
            $table->date('license_expiry')->nullable();
            $table->integer('years_experience')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->string('doctor_id')->nullable();
            $table->text('days_available')->nullable();
            $table->text('time_slots')->nullable();
            $table->boolean('on_call')->default(0);
            $table->integer('patients_handled')->nullable();
            $table->string('status')->nullable();
            $table->string('photo')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
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
                'photo'
            ]);
        });
    }
};
