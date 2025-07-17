<?php

namespace App\Models;

use App\Models\Admin;
use App\Models\AgentProfile;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Agent extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, SoftDeletes;
    protected $fillable = ['admin_id', 'agent_code', 'name', 'email', 'password', 'role', 'otp', 'otp_expires_at', 'is_verified', 'email_verified_at'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function profile()
    {
        return $this->hasOne(AgentProfile::class);
    }


}
