<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{

	protected $fillable = [
		'filename'
	];

	public function imageable(){
		return $this->morphTo();
	}
}
