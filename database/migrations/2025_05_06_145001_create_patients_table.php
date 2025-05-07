<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            // Primary Fields
            $table->string('patient_id')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->date('date_of_birth');
            $table->string('gender');
            $table->integer('age')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();

            // Secondary Fields
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();

            // Emergency Contact
            $table->string('emergency_contact_name');
            $table->string('emergency_contact_relationship');
            $table->string('emergency_contact_phone');
            $table->text('emergency_contact_address')->nullable();

            // Medical Information
            $table->string('primary_condition')->nullable();
            $table->text('allergies')->nullable();
            $table->text('medications')->nullable();
            $table->text('medical_history')->nullable();
            $table->text('past_surgeries')->nullable();

            // Hospitalization Records
            $table->date('admission_date')->nullable();
            $table->date('discharge_date')->nullable();
            $table->string('room_number')->nullable();
            $table->unsignedBigInteger('attending_physician_id')->nullable(); // foreign key to users (doctors)
            $table->string('hospital_status')->default('Active'); // Active / Discharged / Transferred / Deceased

            // System / Administrative
            $table->timestamp('date_registered')->nullable();
            $table->string('status')->default('Active'); // Active / Archived / Deceased

            // Optional Extras
            $table->string('photo')->nullable();
            $table->text('notes')->nullable();

            $table->timestamps();

            // Foreign key (optional if Doctor exists)
            $table->foreign('attending_physician_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
