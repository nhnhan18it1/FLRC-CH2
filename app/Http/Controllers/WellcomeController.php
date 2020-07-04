<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WellcomeController extends Controller
{
    public function StartLRV()
    {
        return view('Intro.intro');
    }
    public function xx($ab="")
    {
        dd($ab);
    }
    public function FunctionName($thamso,Request $request)
    {
        # code...
    }
}
