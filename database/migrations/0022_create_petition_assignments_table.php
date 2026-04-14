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
        Schema::create('petition_assignments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('petition_id');
            $table->unsignedBigInteger('sender_id');   
            $table->unsignedBigInteger('receiver_id'); 
            $table->string('status');
            $table->timestamp('assignment_timestamp');
            $table->timestamps();
            $table->foreign('petition_id')
              ->references('id')
              ->on('petitions')
              ->onDelete('cascade');
            $table->foreign('sender_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
            $table->foreign('receiver_id')
              ->references('id')
              ->on('users')
              ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petition_assignments');
    }
};
