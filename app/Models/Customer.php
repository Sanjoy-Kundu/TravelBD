<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Authenticatable
{
   use HasFactory, SoftDeletes,HasApiTokens;

protected $fillable = [
    'admin_id', 'agent_id', 'staff_id',
    'package_id', 'package_category_id',
    'name', 'email', 'image', 'phone', 'passport_no', 'age', 'gender', 'date_of_birth', 'nid_number',
    'price', 'duration', 'inclusions', 'exclusions','customer_slot',
    'visa_processing_time', 'documents_required', 'seat_availability',
    'coupon_code', 'coupon_discount', 'coupon_use_discounted_price',
    'package_discount', 'package_discounted_price',
    'country', 'company_name', 'pic',
    'sales_commission','sales_commission_discount','mrp',
    'agent_name', 'agent_code', 'agent_price', 'passenger_price',
    'staff_name', 'staff_code', 'staff_price',
    'medical_date', 'medical_center', 'medical_result',
    'visa_online', 'calling', 'training', 'e_vissa', 'bmet', 'fly', 'payment',
    'payment_method', 'account_number',
    'approval', 'created_by_ip'
];


    // 👉 Relationships
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'package_category_id');
    }

       public function paymentData()
    {
        return $this->hasMany(Payment::class,'customer_id');
    }
}
