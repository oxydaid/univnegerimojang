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
        Schema::create('app_settings', function (Blueprint $table) {
            $table->id();
            // SEO & Branding
            $table->string('app_name')->default('UNIMO');
            $table->text('app_description')->nullable();
            $table->string('meta_title_default')->nullable();
            $table->text('meta_description_default')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_title')->nullable();
            $table->text('og_description')->nullable();
            $table->string('favicon')->nullable();
            $table->string('logo')->nullable();
            $table->string('default_share_image')->nullable();
            $table->string('ga4_measurement_id')->nullable();

            // Theme Colors
            $table->string('primary_color')->default('#3b82f6'); // Diamond Blue
            $table->string('secondary_color')->default('#8b5a2b'); // Dirt Brown

            // Social Media
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('tiktok_url')->nullable();
            $table->string('whatsapp_number')->nullable();
            $table->string('discord_url')->nullable(); // Khusus UNIMO!
            $table->string('email')->nullable();

            // SPMB & CBT Settings
            $table->boolean('spmb_open')->default(true);
            $table->boolean('graduation_list_published')->default(true);
            $table->integer('max_test_questions')->default(10);

            // Announcement Settings
            $table->boolean('show_announcement')->default(true);
            $table->string('announcement_bg_color')->default('#1e3a8a');
            $table->string('announcement_text_color')->default('#ffffff');
            $table->text('announcement_text')->nullable();

            // QRIS Settings
            $table->string('qris_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('app_settings');
    }
};
