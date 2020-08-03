<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class list_friend extends Model
{
    protected $table="list_friend";
    public function account1()
    {
        return $this->belongsTo('App\account', 'ID1', 'ID');
    }
    public function account2()
    {
        return $this->belongsTo('App\account', 'ID2', 'ID');
    }

    public function chats1()
    {
        return $this->hasMany('App\chats', 'IDreceive', 'ID1');
    }
    public function chats2()
    {
        return $this->hasMany('App\chats', 'IDreceive', 'ID2');
    }

}
