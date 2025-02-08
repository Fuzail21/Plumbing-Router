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
        Schema::create('job_status', function (Blueprint $table) {
            $table->integer('recnum');
            $table->integer('workDays')->nullable();
            $table->date('dateNeeded')->nullable();
            $table->date('lastDate')->nullable();
            $table->date('originalDate')->nullable();
            $table->boolean('engComplete')->nullable();
            $table->string('prwr')->nullable();
            $table->string('fabwr')->nullable();
            $table->boolean('shipComplete')->nullable();
            $table->string('pActManager')->nullable();
            $table->integer('jobId')->nullable();
            $table->boolean('engNeeded')->nullable();
            $table->text('notes')->nullable();
            $table->string('wrhs2_feb')->nullable();
            $table->string('fabmisc')->nullable();
            });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_status');
    }
};
