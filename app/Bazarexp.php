<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bazarexp extends Model
{
	public function member()
	{
		return $this->belongsTo('App\Member');
	}

	public function edits()
	{
		return $this->morphMany('App\Edit','editable');
	}
}
