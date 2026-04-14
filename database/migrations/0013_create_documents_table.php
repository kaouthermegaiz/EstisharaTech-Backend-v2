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
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('consultation_id');
            $table->unsignedBigInteger('sender_id');
            $table->unsignedBigInteger('receiver_id');
            $table->string('file_path');
            $table->string('file_type')->nullable(); 
            $table->timestamp('uploaded_at');

            $table->timestamps();
            $table->foreign('consultation_id')
              ->references('id')
              ->on('consultations')
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
        Schema::dropIfExists('documents');
    }
};
