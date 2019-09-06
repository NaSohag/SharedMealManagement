<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function takajoma()
    {
    	return $this->hasMany('App\Takajoma');
    }

    public function meals()
    {
    	return $this->hasMany('App\Meal')->orderBy('manual_date');
    }

    public function bazarexps()
    {
    	return $this->hasMany('App\Bazarexp');
    }
}
