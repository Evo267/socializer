<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

	protected $fillable = [
		'receiver', 'user_id', 'msg'
	];

    public function user(){
    	return $this->belongsTo('App\User');
    }

    public function receiver(){
    	return $this->belongsTo('App\User', 'receiver');
    }
}
