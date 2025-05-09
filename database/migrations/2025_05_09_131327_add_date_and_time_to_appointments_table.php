<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            // Add date and time columns if not exist
            if (!Schema::hasColumn('appointments', 'date')) {
                $table->date('date')->nullable()->after('patient_id');
            }

            if (!Schema::hasColumn('appointments', 'time')) {
                $table->time('time')->nullable()->after('date');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('appointments', function (Blueprint $table) {
            if (Schema::hasColumn('appointments', 'date')) {
                $table->dropColumn('date');
            }

            if (Schema::hasColumn('appointments', 'time')) {
                $table->dropColumn('time');
            }
        });
    }
};
