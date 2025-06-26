<?php

namespace App\Models;

use App\Models\Admin;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Staff extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens,HasFactory, SoftDeletes;

     protected $table = 'staffs'; 
    /**
     * Mass assignable attributes (fillable)
     */
    protected $fillable = [
        'admin_id',
        'staff_code',
        'name',
        'email',
        'password',
        'role',
        'otp',
        'otp_expires_at',
        'is_verified',
        'email_verified_at',
    ];

    /**
     * Casts (dates & booleans)
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'otp_expires_at' => 'datetime',
        'is_verified' => 'boolean',
    ];

 
    protected $hidden = [
        'password',
        'otp',
    ];

    /**
     * Relation: Staff belongs to an Admin
     */
    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

  
    // protected static function booted()
    // {
    //     static::creating(function ($staff) {
    //         if (empty($staff->staff_code)) {
    //             $staff->staff_code = strtoupper(uniqid('STF'));
    //         }
    //     });
    // }
}
