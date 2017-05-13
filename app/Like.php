<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
	protected $fillable = [
		'user_id', 'likeable_id', 'likeable_type'
	];

    public function likeable(){
    	return $this->morphTo();
    }

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function notifications(){
		return $this->morphMany('App\Notification', 'notification');
	}
}
