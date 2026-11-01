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
        Schema::create('study_programs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            // Menggunakan nullable() dan onDelete('set null') agar jika kepala jurusan dihapus, data jurusan tidak ikut terhapus.
            $table->foreignId('head_staff_id')->nullable()->constrained('staffs')->onDelete('set null');
            $table->string('image_path')->nullable();
            $table->string('image_alt')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('study_programs');
    }
};
