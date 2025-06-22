<?php

namespace App\Models;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable; 

class Admin extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, SoftDeletes;
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
