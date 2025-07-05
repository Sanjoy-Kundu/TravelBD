<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
   use HasFactory, SoftDeletes;

    protected $fillable = [
        'admin_id', 'agent_id', 'staff_id',
        'package_id', 'package_category_id',
        'name', 'email', 'image', 'phone', 'passport_no', 'age',
        'purpose', 'price', 'duration', 'inclusions', 'exclusions',
        'visa_processing_time', 'documents_required', 'seat_availability',
        'country', 'company_name', 'pic',
        'sales_commission', 'mrp',
        'agent_name', 'agent_code', 'agent_price', 'passenger_price',
        'staff_name', 'staff_code', 'staff_price',
        'medical_date', 'medical_center', 'medical_result',
        'visa_online', 'calling', 'training', 'e_vissa', 'bmet', 'fly', 'payment',
        'payment_method', 'account_number',
        'approval',
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
}
