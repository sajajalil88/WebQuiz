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
        Schema::create('doctor_schedules', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('doctor_id');
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('message')->nullable();
            $table->string('day')->nullable();
            $table->boolean('is_active')->nullable();
            $table->foreign('doctor_id')->references('id')
                ->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctor_schedules');
    }
};
