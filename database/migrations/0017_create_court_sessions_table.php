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
        Schema::create('court_sessions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('case_id');
            $table->unsignedBigInteger('courtroom_id')->nullable();
            $table->dateTime('session_date');
            $table->boolean('is_delayed')->default(false);
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('case_id')
              ->references('id')
              ->on('casefiles')
              ->onDelete('cascade');
            $table->foreign('courtroom_id')
              ->references('id')
              ->on('courtrooms')
              ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('court_sessions');
    }
};
