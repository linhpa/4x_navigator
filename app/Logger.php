<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
	protected $table = 'logs';

    protected $fillable = [
    	'log_name', 'description', 'user_id', 'subject'
    ];
}
