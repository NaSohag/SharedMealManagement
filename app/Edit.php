<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Edit extends Model
{
    public function editable()
    {
    	return $this->morphTo();
    }
}
