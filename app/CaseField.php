<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CaseField extends Model
{
    protected $fillable = [
    	'key', 'name', 'description', 'on_grid', 'editable', 'position'
    ];

    protected $nullable = [
    	'name', 'description'
    ];
}
