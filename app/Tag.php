<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
    	'name', 'post_id'
    ];

    public function posts(){
    	return $this->belongsTo('App\Post');
    }
}
