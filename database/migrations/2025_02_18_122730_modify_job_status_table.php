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
            $table->string('prwr', 255)->nullable()->change();
            $table->string('wrhs2_feb', 255)->nullable()->change();
            $table->string('fabmisc', 255)->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('job_status', function (Blueprint $table) {
            $table->date('prwr')->nullable()->change(); 
            $table->date('wrhs2_feb')->nullable()->change(); 
            $table->date('fabmisc')->nullable()->change(); 
        });
    }
};
