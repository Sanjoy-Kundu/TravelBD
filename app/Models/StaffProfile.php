<?php

namespace App\Models;

use App\Models\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StaffProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'staff_id',
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
        'gender',
    ];

    // Relationship: profile belongs to one staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
