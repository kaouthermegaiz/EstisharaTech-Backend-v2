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
       Schema::create('petitions', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('template_id');
        $table->unsignedBigInteger('case_id');
        $table->unsignedBigInteger('lawyer_id');
        
        
        $table->string('opponent_name')->nullable(); // اسم الخصم
        $table->string('status')->default('draft');  // حالة العريضة 
        $table->longText('generated_content')->nullable(); // المحتوى المولد (HTML)
        
        $table->longText('final_content')->nullable(); // المحتوى النهائي بعد التعديل
        
        $table->timestamps();

        // العلاقات
        $table->foreign('template_id')->references('id')->on('petition_templates')->onDelete('cascade');
        $table->foreign('case_id')->references('id')->on('casefiles')->onDelete('cascade');
        $table->foreign('lawyer_id')->references('user_id')->on('lawyers')->onDelete('cascade');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petitions');
    }
};
