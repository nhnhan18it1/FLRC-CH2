<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class advise_friend extends Model
{
    protected $table="advise_friend";
    public function accountN()
    {
        return $this->belongsTo('App\account', 'IDNN', 'ID');
    }
    public function accountG()
    {
        return $this->belongsTo('App\account', 'IDNG', 'ID');
    }
}
