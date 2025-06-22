<?php

namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; 

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, SoftDeletes;
        protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'otp',
        'is_verified',
        'otp_expires_at'
    ];
}
