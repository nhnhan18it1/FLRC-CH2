<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class chats extends Model
{
    protected $table="chats";
    public function accountS()
    {
        return $this->belongsTo('App\account', 'IDsend', 'ID');
    }
    public function accountR()
    {
        return $this->belongsTo('App\account', 'IDreceive', 'ID');
    }
}
