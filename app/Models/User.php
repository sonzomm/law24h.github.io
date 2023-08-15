<?php

namespace App\Models;

use App\Constants\Status;
use App\Traits\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Searchable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'ver_code',
        'password', 'remember_token', 'ver_code', 'balance', 'kyc_data'
    ];



    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'address'           => 'object',
        'kyc_data'          => 'object',
        'ver_code_send_at'  => 'datetime'
    ];

    public function loginLogs()
    {
        return $this->hasMany(UserLogin::class);
    }

    public function bookingRequest()
    {
        return $this->hasMany(BookingRequest::class)->where('status', Status::PAYMENT_INITIATE);
    }

    public function deposits()
    {
        return $this->hasMany(Deposit::class)->where('status', '!=', Status::PAYMENT_INITIATE);
    }

    public function booking()
    {
        return $this->hasMany(Booking::class);
    }

    public function bookingWithStatus($status)
    {
        return $this->hasMany(Booking::class)->where('status', $status);
    }

    public function bookedRoom()
    {
        return $this->hasManyThrough(BookedRoom::class, Booking::class);
    }

    public function fullname(): Attribute
    {
        return new Attribute(
            get: function () {
                return $this->firstname . ' ' . $this->lastname;
            }
        );
    }

    // SCOPES
    public function scopeActive($query)
    {
        return $query->where('status', Status::USER_ACTIVE)->where('ev', Status::VERIFIED)->where('sv', Status::VERIFIED);
    }
    public function scopeBanned($query)
    {
        return $query->where('status', Status::USER_BAN);
    }
    public function scopeEmailUnverified($query)
    {
        return $query->where('ev', Status::UNVERIFIED);
    }

    public function scopeEmailVerified($query)
    {
        return $query->where('ev', Status::VERIFIED);
    }
}
