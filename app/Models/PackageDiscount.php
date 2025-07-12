<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageDiscount extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'package_id',
        'discount_mode',
        'coupon_code',
        'discount_value',
        'start_date',
        'end_date',
        'description',
        'status',
    ];

    // Relationship to Package
    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
