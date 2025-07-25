<?php

namespace App\Models;

use App\Models\Package;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PackageCategory extends Model
{
    use HasFactory,SoftDeletes;
        protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'status',
    ];

    public function packages()
    {
        return $this->hasMany(Package::class, 'category_id');
    }
}
