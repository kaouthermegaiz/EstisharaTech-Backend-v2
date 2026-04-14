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
        Schema::create('lawyer_tasks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lawyer_id');
            $table->unsignedBigInteger('case_id');
            $table->string('title');
            $table->text('description')->nullable();

            $table->dateTime('start_at');
            $table->dateTime('end_at');

            $table->string('task_type');
            $table->string('priority');
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
        Schema::dropIfExists('lawyer_tasks');
    }
};
