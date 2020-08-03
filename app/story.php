<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class story extends Model
{
    protected $table="story";

    public function account()
    {
        return $this->belongsTo('App\account', 'IDND', 'ID');
    }

}


