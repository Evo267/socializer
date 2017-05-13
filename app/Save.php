<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Save extends Model
{
    protected $fillable = [
    	'user_id', 'post_id'
    ];

    public function post(){
    	return $this->belongsTo('App\Post');
    }
}
