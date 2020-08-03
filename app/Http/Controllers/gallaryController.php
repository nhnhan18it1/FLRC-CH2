<?php

namespace App\Http\Controllers;

use App\chats;
use Illuminate\Http\Request;
use App\Http;
use Illuminate\Support\Facades\DB;
use App\newsmodel;
use App\comments;
use App\likelist;
use App\notification;
use App\advise_friend;
use App\list_friend;
class gallaryController extends Controller
{
    public function index()
    {
        $rs = newsmodel::orderByRaw('created_at DESC')->get();
        $hotNew= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
        $noti= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
        $adF= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();
        $bv=newsmodel::limit(12)->get();
        $mess=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
        return view("Gallary.gallary",compact("bv",'rs','hotNew','noti','adF','mess'));
    }
    public function loadImg(Request $request)
    {
        $rs = newsmodel::limit(12)->offset($request->offset*12)->get();
        foreach ($rs as $gt) {
            $ne = new news($gt->IDBV, $gt->IDND, $gt->Content, $gt->Img, $gt->CLike, $gt->account->name, $gt->account->Avt, $gt->created_at, $gt->updated_at);
            $list_new[] = $ne;
        }
        echo json_encode($list_new);
    }
}
class news
{
    public $IDBV;
    public $IDND;
    public $Content;
    public $Img;
    public $CLike;
    public $name;
    public $Avt;
    public $created_at;
    public $updated_at;
    public function __construct(
        $IDBV,
        $iDND,
        $content,
        $img,
        $cLike,
        $Name,
        $avt,
        $Created_at,
        $Updated_at
    ) {
        $this->IDBV = $IDBV;
        $this->IDND = $iDND;
        $this->Content = $content;
        $this->Img = $img;
        $this->CLike = $cLike;
        $this->name = $Name;
        $this->Avt=$avt;
        $this->created_at = $Created_at;
        $this->updated_at = $Updated_at;
    }
}
