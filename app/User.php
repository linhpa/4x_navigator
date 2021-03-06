<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Redis;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role', 'gdv_id', 'phone', 'token_2fa', 'token_2fa_expiry', 'last_activity'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at', 'last_activity'];

    public function cases() {
        return $this->hasMany('App\Case');
    }

    public function devices() {
        return $this->hasMany('App\Device');
    }

    public function getAvailability() {
        return Redis::get("users:" . $this->id);
    }
}
