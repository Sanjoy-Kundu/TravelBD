<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payment extends Model
{
    use HasFactory, SoftDeletes;
        protected $fillable = [
        'admin_id',
        'customer_id',
        'package_id',
        'transaction_id',
        'invoice_no',
        'total_price',
        'paid_amount',
        'due_amount',
        'payment_method',
        'currency',
        'payment_date',
        'received_by',
        'payment_note',
        'status',
    ];


        public function admin()
        {
            return $this->belongsTo(Admin::class, 'admin_id');
        }

        public function customer()
        {
            return $this->belongsTo(Customer::class, 'customer_id');
        }

        public function package()
        {
            return $this->belongsTo(Package::class, 'package_id');
        }

        public function receivedBy()
        {
            return $this->belongsTo(Admin::class, 'received_by');
        }
}
