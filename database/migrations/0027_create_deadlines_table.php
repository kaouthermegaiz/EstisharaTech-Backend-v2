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
        Schema::create('deadlines', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('case_id');
    $table->string('type'); // جزائي، مدني، إداري، تقادم
    $table->string('title'); // مثلاً: أجل استئناف حكم جنحي
    $table->dateTime('start_date'); // تاريخ صدور الحكم أو التبليغ
    $table->dateTime('due_date'); // التاريخ النهائي (يُحسب تلقائياً)
    $table->integer('remaining_days')->virtualAs('DATEDIFF(due_date, NOW())'); 
    $table->enum('status', ['active', 'expired', 'completed'])->default('active');
    $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deadlines');
    }
};
