<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class PaymentHistory extends Model
{
   use HasFactory,SoftDeletes;

    protected $fillable = [
        'payment_id',
        'customer_id',
        'package_id',
        'paid_amount',
        'payment_method',
        'payment_date',
        'note',
        'received_by',
    ];

    // Relation: PaymentHistory belongs to Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Relation: PaymentHistory belongs to Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    // Relation: PaymentHistory received by an Admin user
    public function receivedBy()
    {
        return $this->belongsTo(Admin::class, 'received_by');
    }
}
