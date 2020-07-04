<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class comments extends Model
{
    protected $table="comments";
    public function account()
    {
        return $this->belongsTo('App\account', 'IDNBL', 'ID');
    }
}
