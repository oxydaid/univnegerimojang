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
        Schema::table('app_settings', function (Blueprint $table) {
            $table->boolean('show_announcement')->default(true);
            $table->string('announcement_bg_color')->default('#1e3a8a');
            $table->string('announcement_text_color')->default('#ffffff');
            $table->text('announcement_text')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_settings', function (Blueprint $table) {
            $table->dropColumn(['show_announcement', 'announcement_bg_color', 'announcement_text_color', 'announcement_text']);
        });
    }
};
