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
        Schema::create('staffs', function (Blueprint $table) {
            $table->id();
            $table->string('identity_number', 50)->unique()->nullable();
            $table->string('name');
            $table->string('position', 100);
            $table->enum('type', ['teacher', 'staff'])->default('teacher')->index();
            $table->enum('employment_status', ['pns', 'pppk', 'tetap_yayasan', 'honorer'])->index();
            $table->text('biography')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_alt')->nullable();
            $table->string('email')->unique()->nullable();
            $table->unsignedSmallInteger('display_order')->default(99);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staffs');
    }
};
