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
        Schema::create('customers', function (Blueprint $table) {
        $table->id();
        //$table->unsignedBigInteger('admin_id');  // Admin who created the customer
        $table->foreignId('admin_id')->nullable()->constrained('admins')->onDelete('cascade');
        $table->foreignId('agent_id')->nullable()->constrained('agents')->onDelete('cascade');
        $table->foreignId('staff_id')->nullable()->constrained('staffs')->onDelete('cascade');
        $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
        $table->foreignId('package_category_id')->constrained('package_categories')->onDelete('cascade');
        
        $table->string('name');
        $table->string('email')->unique();
        $table->string('image')->nullable();
        $table->string('phone', 20);
        $table->string('passport_no', 50);
        $table->unsignedInteger('age')->nullable();
        $table->enum('gender', ['male', 'female', 'other'])->nullable();
        $table->date('date_of_birth')->nullable();
        $table->string('nid_number')->nullable();


        
        $table->decimal('price', 18, 2)->nullable(); //selected package price
        $table->string('duration')->nullable(); //selected package duration

        $table->text('inclusions')->nullable(); //selected package inclusions
        $table->text('exclusions')->nullable(); //selected package exclusions

        $table->string('visa_processing_time')->nullable(); //selected package visa processing time
        $table->text('documents_required')->nullable(); //selected package documents required
        $table->string('seat_availability')->nullable(); //selected package seat availability
        $table->decimal('customer_slot');

        $table->string('coupon_code')->nullable();
        $table->decimal('coupon_discount',18,2)->nullable();
        $table->decimal('coupon_use_discounted_price',18,2)->nullable(); // if coupon use then discounted price
      

        $table->decimal('package_discount',17,2)->nullable()->comment('Package Discount Percentage'); //first time package when upload if discount
        $table->decimal('package_discounted_price',18,2)->nullable(); //pacage discounted price

        $table->string('country')->nullable();
        $table->string('company_name')->nullable();
        $table->string('pic')->nullable();

        $table->decimal('sales_commission', 18, 2)->nullable();
        $table->decimal('mrp', 18, 2)->nullable();

        $table->string('agent_name')->nullable();
        $table->string('agent_code')->nullable();
        $table->decimal('agent_price', 18, 2)->nullable();

        $table->decimal('passenger_price', 18, 2)->nullable(); //finally passenger or customer that account pay

        $table->string('staff_name')->nullable();
        $table->string('staff_code')->nullable();
        $table->decimal('staff_price', 18, 2)->nullable();
 

        $table->date('medical_date')->nullable();
        $table->string('medical_center')->nullable();
        $table->string('medical_result')->nullable();

        $table->enum('visa_online', ['Pending', 'Complete'])->default('Pending');
        $table->enum('calling', ['Pending', 'Complete'])->default('Pending');
        $table->enum('training', ['Pending', 'Complete'])->default('Pending');
        $table->enum('e_vissa', ['Pending', 'Complete'])->default('Pending');
        $table->enum('bmet', ['Pending', 'Complete'])->default('Pending');
        $table->enum('fly', ['Pending', 'Complete'])->default('Pending');
        $table->enum('payment', ['Pending', 'Complete'])->default('Pending');

        $table->enum('payment_method', ['cash', 'bank', 'wallet'])->nullable();
        $table->string('account_number')->nullable();

        $table->enum('approval', ['Pending', 'Complete'])->default('Pending');
        $table->ipAddress('created_by_ip')->nullable();

        $table->timestamps();

        $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
