<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class newsmodel extends Model
{
    protected $table="news";
    public $timestamps=true;

    public function account()
    {
        return $this->belongsTo('App\account', 'IDND', 'ID');
    }

    public function likelist()
    {
        return $this->hasMany('App\likelist', 'IDBV', 'IDBV');
    }
    public function comments()
    {
        return $this->hasMany('App\comments', 'IDBV', 'IDBV');
    }

}
