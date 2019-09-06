<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Extraexp extends Model
{
    public function edits()
	{
		return $this->morphMany('App\Edit','editable');
	}
}
