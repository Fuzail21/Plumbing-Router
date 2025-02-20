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
        Schema::table('job_status', function (Blueprint $table) {
            $table->date('old_dateNeeded')->nullable()->after('engNeeded');
            $table->date('old_engNeeded')->nullable()->after('old_dateNeeded');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_status', function (Blueprint $table) {
            $table->dropColumn(['old_dateNeeded', 'old_engNeeded']);
        });
    }
};
