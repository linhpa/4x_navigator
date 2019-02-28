<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
    	'user_id', 'ip', 'user_agent', 'is_verified', 'attempts', 'platform', 'device_name', 'browser'
    ];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
