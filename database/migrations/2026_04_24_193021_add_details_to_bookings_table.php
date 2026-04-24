<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('meeting_type'); // 'in_person' or 'remote'
            $table->string('meeting_link')->nullable(); // للرابط (Zoom/Meet)
            $table->string('location')->nullable(); // عنوان المكتب
            $table->text('note')->nullable(); // ملاحظة الموكل
            $table->dateTime('proposed_date')->nullable(); // في حالة إعادة الجدولة
        });
    }

    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['meeting_type', 'meeting_link', 'location', 'note', 'proposed_date']);
        });
    }
};