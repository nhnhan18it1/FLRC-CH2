<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chatController extends Controller
{
    public function LoadP()
    {

        return view("chats.page_chat");
    }
    public function saveIDNN(Request $request)
    {
        session(['IDNN'=>$request->IDNN]);
    }
}
