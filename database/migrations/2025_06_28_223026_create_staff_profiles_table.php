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
        Schema::create('staff_profiles', function (Blueprint $table) {
        $table->id();
        $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade');
        $table->string('phone')->nullable();
        $table->string('alternate_phone')->nullable();
        $table->string('address')->nullable();
        $table->string('city')->nullable();
        $table->string('state')->nullable();
        $table->string('country')->nullable();
        $table->string('zip_code')->nullable();
        $table->string('profile_image')->nullable(); // image path
        $table->text('about')->nullable(); // short bio/about section
        $table->string('designation')->nullable(); // e.g. Travel agency CEO, Staff, Agent
        $table->string('facebook')->nullable();
        $table->string('twitter')->nullable();
        $table->string('linkedin')->nullable();
        $table->string('website')->nullable();
        $table->string('gender')->nullable();
        $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff_profiles');
    }
};
