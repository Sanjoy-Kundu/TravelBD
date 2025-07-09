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


        
        $table->decimal('price', 12, 2)->nullable();
        $table->string('duration')->nullable();

        $table->text('inclusions')->nullable();
        $table->text('exclusions')->nullable();

        $table->string('visa_processing_time')->nullable();
        $table->text('documents_required')->nullable();
        $table->string('seat_availability')->nullable();
        $table->string('coupon_code')->nullable();
        $table->string('coupon_use_discounted_price')->nullable();
        $table->string('package_discount')->nullable();

        $table->string('package_only_discount')->nullable();
        $table->string('package_only_dicounted_price')->nullable();

        $table->string('country')->nullable();
        $table->string('company_name')->nullable();
        $table->string('pic')->nullable();

        $table->decimal('sales_commission', 12, 2)->nullable();
        $table->decimal('mrp', 12, 2)->nullable();

        $table->string('agent_name')->nullable();
        $table->string('agent_code')->nullable();
        $table->decimal('agent_price', 12, 2)->nullable();
        $table->decimal('passenger_price', 12, 2)->nullable();

        $table->string('staff_name')->nullable();
        $table->string('staff_code')->nullable();
        $table->decimal('staff_price', 12, 2)->nullable();
        //$table->decimal('passenger_price', 12, 2)->nullable();

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
