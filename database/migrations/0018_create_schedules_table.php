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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('case_id');
            $table->dateTime('schedule_at');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('lawyer_id')
              ->references('user_id')
              ->on('lawyers')
              ->onDelete('cascade');
            $table->foreign('case_id')
              ->references('id')
              ->on('casefiles')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
