<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

	protected $fillable = [
		'user_id', 'notification_type', 'notification_id', 'seen', 'from'
	];

    public function notification(){
    	return $this->morphTo();
    }

    public function userFrom(){
    	return $this->belongsTo('App\User', 'from');
    }
}
