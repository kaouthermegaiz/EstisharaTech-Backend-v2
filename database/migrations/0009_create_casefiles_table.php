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
        Schema::create('casefiles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('courtroom_id')->nullable();
            $table->text('description')->nullable();
            $table->string('status');

            $table->timestamps();
            $table->foreign('client_id')->references('user_id')->on('clients')->onDelete('cascade');
            $table->foreign('lawyer_id')->references('user_id')->on('lawyers')->onDelete('cascade');
            $table->foreign('courtroom_id')->references('id')->on('courtrooms')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('casefiles');
    }
};
