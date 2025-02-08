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
        Schema::create('job_information', function (Blueprint $table) {
            $table->integer('recnum');
            $table->integer('jobId');
            $table->string('jobType')->nullable();
            $table->string('descript')->nullable();
            $table->string('phase')->nullable();
            $table->integer('units')->nullable();
            $table->string('material')->nullable();
            $table->string('sys')->nullable();
            $table->string('bldFloor')->nullable();
            $table->string('zoneUnit')->nullable();
            $table->string('dx')->nullable();
            $table->string('roughSuper')->nullable();
            $table->string('finishSuper')->nullable();
            $table->string('engineer')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_information');
    }
};
