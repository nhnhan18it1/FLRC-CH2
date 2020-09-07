<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class infor extends Model
{
    protected $table="infor";
    public function account()
    {
        return $this->belongsTo('App\account', 'IDND', 'ID');
    }
}
