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
        Schema::create('lawyers', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();

            $table->string('license_number')->unique();
            $table->foreignId('wilaya_id')->constrained('wilayas');
            $table->string('grade');
            $table->string('law_firm')->nullable();
            $table->string('contact');
            $table->boolean('is_professionally_verified')->default(false);

            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lawyers');
    }
};
