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
        Schema::table('clients', function (Blueprint $table) {
            $table->dropColumn('wilaya');
            $table->foreignId('wilaya_id')->after('user_id')->nullable()->constrained('wilayas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('clients', function (Blueprint $table) {
            $table->string('wilaya')->after('user_id')->nullable();
            $table->dropForeign(['wilaya_id']);
            $table->dropColumn('wilaya_id');
        });
    }
};
