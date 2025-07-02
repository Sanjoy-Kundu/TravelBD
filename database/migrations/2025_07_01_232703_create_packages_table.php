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
        Schema::create('packages', function (Blueprint $table) {
  $table->id();

    $table->foreignId('category_id')->constrained('package_categories')->onDelete('cascade'); // ক্যাটাগরির সাথে সম্পর্ক
    $table->string('title');                     // প্যাকেজের নাম
    $table->string('slug')->unique();            // SEO friendly URL
    $table->string('short_description')->nullable(); // হোমপেজ বা লিস্টে ছোট ডিসক্রিপশন
    $table->text('long_description')->nullable();    // বিস্তারিত বর্ণনা (ফুল ডিটেইলস পেজে)
    
    $table->decimal('price', 10, 2)->nullable();  // প্যাকেজ প্রাইস (USD, BDT etc)
    $table->string('currency')->default('BDT');  // ডলার, টাকা ইত্যাদি
    $table->string('duration')->nullable();      // যেমন: 7 Days, 1 Month, 1 Year
    
    $table->text('inclusions')->nullable();      // কি কি সুবিধা অন্তর্ভুক্ত (Visa, Flight, Hotel)
    $table->text('exclusions')->nullable();      // কি কি বাদ (Food, Personal Expense)
    
    $table->string('visa_processing_time')->nullable(); // প্রসেসিং টাইম: 10 Days, 15 Days
    $table->text('documents_required')->nullable();     // পাসপোর্ট, ছবি, NID ইত্যাদি

    $table->integer('seat_availability')->nullable();   // কয়টা সিট বা স্লট ফ্রি আছে
    $table->string('image')->nullable();                // thumbnail image
    $table->enum('status', ['active', 'inactive'])->default('active'); // package চালু নাকি বন্ধ

    $table->timestamps();              // created_at, updated_at
    $table->softDeletes();             // trash system
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
