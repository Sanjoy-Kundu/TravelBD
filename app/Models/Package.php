<?php

namespace App\Models;

use App\Models\PackageCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Package extends Model
{
    use HasFactory, SoftDeletes;
       protected $fillable = [
        'category_id',
        'title',
        'slug',
        'short_description',
        'long_description',
        'price',
        'currency',
        'duration',
        'inclusions',
        'exclusions',
        'visa_processing_time',
        'documents_required',
        'seat_availability',
        'image',
        'status',
    ];

    // ক্যাটাগরি রিলেশন (একটি প্যাকেজ একটি ক্যাটাগরির সাথে সম্পর্কিত)
    public function packageCategory()
    {
        return $this->belongsTo(PackageCategory::class, 'category_id');
    }
}
