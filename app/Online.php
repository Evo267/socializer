<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Online extends Model
{

	public $timestamps = false;

    protected $fillable = [
    	'last', 'user_id'
    ];
}
