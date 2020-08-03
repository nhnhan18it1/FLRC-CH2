<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\account;

class RestController extends Controller
{
    public function GetImg()
    {
        $acc=account::all("ID","Avt");
        echo json_encode($acc);
    }
}
