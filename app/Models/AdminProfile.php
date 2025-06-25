<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdminProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'phone',
        'alternate_phone',
        'address',
        'city',
        'state',
        'country',
        'zip_code',
        'profile_image',
        'about',
        'designation',
        'facebook',
        'twitter',
        'linkedin',
        'website',
        'gender'
    ];

    public function admin(){
        return $this->belongsTo(Admin::class);
    }
}
