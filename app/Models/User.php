<?php

namespace App\Models;

use App\Casts\Password;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'user_type',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => Password::class,
    ];


    public function userrights()
    {
        return $this->hasOne(UserRights::class);
    }

    public function patient()
    {
        return $this->hasMany(Patient::class);
    }

    public function staff()
    {
        return $this->hasOne(Staff::class);
    }

    public function reservation()
    {
        return $this->hasOne(Reservation::class);
    }

    public function bill()
    {
        return $this->hasOne(Bill::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }
}
