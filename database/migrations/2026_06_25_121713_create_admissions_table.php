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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();
            $table->string('registration_number')->unique();
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('high_school');
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->string('path'); // prestasi, nilai, test, beasiswa
            $table->json('documents')->nullable(); // menyimpan skin, rapot (minecraft_stats), certificate, achievement_proof, dan ordal_code
            $table->integer('test_score')->nullable();
            $table->string('status')->default('pending'); // pending, accepted, rejected
            $table->text('status_notes')->nullable();
            $table->foreignId('academic_year_id')->nullable()->constrained()->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
