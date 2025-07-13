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

            $table->foreignId('category_id')->constrained('package_categories')->onDelete('cascade'); // ক্যাটাগরির সাথে সম্পর্ক
            $table->string('title'); // package title
            $table->string('slug')->unique(); // SEO friendly URL
            $table->string('short_description')->nullable(); //home description
            $table->text('long_description')->nullable(); // long description

            $table->decimal('price', 10, 2)->nullable(); // MRP
            $table->string('currency')->default('BDT'); // usd and BDT
            $table->string('duration')->nullable(); // 7 Days, 1 Month, 1 Year

            $table->text('inclusions')->nullable(); // (Visa, Flight, Hotel, others)
            $table->text('exclusions')->nullable(); // (Food, Personal Expense)

            $table->string('visa_processing_time')->nullable(); // 10 Days, 15 Days, 1months
            $table->text('documents_required')->nullable(); // passport, image, NID 
            $table->integer('seat_availability')->nullable(); // slot
            $table->string('image')->nullable(); // thumbnail image
            $table->enum('status', ['active', 'inactive'])->default('active'); // package active or inactive

            $table->timestamps(); // created_at, updated_at
            $table->softDeletes(); // trash system
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
