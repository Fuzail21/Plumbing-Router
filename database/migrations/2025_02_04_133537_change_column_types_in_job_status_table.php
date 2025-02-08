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
            // Convert 'workDays' to a string type first (to avoid type conflict)
            $table->string('workDays')->nullable()->change();
            $table->string('dateNeeded')->nullable()->change();
            $table->string('lastDate')->nullable()->change();
            $table->string('originalDate')->nullable()->change();
            $table->string('engComplete')->nullable()->change();
            $table->string('prwr')->nullable()->change();
            $table->string('fabwr')->nullable()->change();
            $table->string('shipComplete')->nullable()->change();
            $table->string('engNeeded')->nullable()->change();
            $table->string('wrhs2_feb')->nullable()->change();
            $table->string('fabmisc')->nullable()->change();
        });

        // After all columns have been converted to strings, now change them to dates
        Schema::table('job_status', function (Blueprint $table) {
            $table->date('workDays')->nullable()->change();
            $table->date('dateNeeded')->nullable()->change();
            $table->date('lastDate')->nullable()->change();
            $table->date('originalDate')->nullable()->change();
            $table->date('engComplete')->nullable()->change();
            $table->date('prwr')->nullable()->change();
            $table->date('fabwr')->nullable()->change();
            $table->date('shipComplete')->nullable()->change();
            $table->date('engNeeded')->nullable()->change();
            $table->date('wrhs2_feb')->nullable()->change();
            $table->date('fabmisc')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_status', function (Blueprint $table) {
            $table->string('workDays')->nullable()->change();
            $table->string('dateNeeded')->nullable()->change();
            $table->string('lastDate')->nullable()->change();
            $table->string('originalDate')->nullable()->change();
            $table->string('engComplete')->nullable()->change();
            $table->string('prwr')->nullable()->change();
            $table->string('fabwr')->nullable()->change();
            $table->string('shipComplete')->nullable()->change();
            $table->string('engNeeded')->nullable()->change();
            $table->string('wrhs2_feb')->nullable()->change();
            $table->string('fabmisc')->nullable()->change();
        });
    }
};
