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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('admin_id')->constrained('admins')->onDelete('cascade');
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->string('transaction_id')->unique();
            $table->string('invoice_no')->nullable()->unique();
            $table->decimal('total_price', 10, 2);
            $table->decimal('paid_amount', 10, 2);
            $table->decimal('due_amount', 10, 2);
            $table->string('payment_method')->default('cash');
            $table->string('currency')->default('BDT');
            $table->date('payment_date')->nullable();
            $table->foreignId('received_by')->nullable()->constrained('admins')->onDelete('set null');
            $table->string('payment_note')->nullable();
            $table->enum('status', ['pending', 'paid', 'partial'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
