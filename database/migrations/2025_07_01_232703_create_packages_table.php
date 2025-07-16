<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')->constrained('package_categories')->onDelete('cascade'); 
            $table->string('title'); 
            $table->string('slug')->unique(); 
            $table->string('short_description')->nullable(); 
            $table->text('long_description')->nullable();

            $table->decimal('price', 10, 2)->nullable(); 
            $table->string('currency')->default('BDT'); 
            $table->string('duration')->nullable(); 

            $table->text('inclusions')->nullable(); 
            $table->text('exclusions')->nullable(); 

            $table->string('visa_processing_time')->nullable(); 
            $table->text('documents_required')->nullable(); 
            $table->integer('seat_availability')->nullable(); 
            $table->string('image')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            $table->timestamps();
            $table->softDeletes(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
