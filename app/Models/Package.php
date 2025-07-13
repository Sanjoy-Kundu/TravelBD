<?php

namespace App\Models;

use App\Models\PackageCategory;
use App\Models\PackageDiscount;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Package extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['category_id', 'title', 'slug', 'short_description', 'long_description', 'price', 'currency', 'duration', 'inclusions', 'exclusions', 'visa_processing_time', 'documents_required', 'seat_availability', 'image', 'status','start_date','end_date','total_sold'];

    // relation betweent package and package category
    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }


 //package discount 
     public function discounts()
    {
        return $this->hasMany(PackageDiscount::class);
    }   

}
