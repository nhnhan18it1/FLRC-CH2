<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table="notification";

    public function accountSent()
    {
        return $this->belongsTo('App\account', 'IDNG', 'ID');
    }
    public function accountReceive()
    {
        return $this->belongsTo('App\account', 'IDNN', 'ID');
    }

    public function news()
    {
        return $this->belongsTo('App\newsmodel', 'IDBV', 'IDBV');
    }


}
