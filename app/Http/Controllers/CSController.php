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
use App\report;
use App\advise_friend;
use App\list_friend;
use App\account;


class CSController extends Controller
{
    //
    public function GetHome()
    {
        if (session()->exists('ID')) {
            $rs = newsmodel::orderByRaw('created_at DESC')->get();
            $hotNew= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
            $noti= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
            $adF= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();

            $mess=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
            // foreach ($mess as $key) {
            //     if ($key->ID1==session()->get('ID')) {
            //         echo("1 <br>");
            //         echo $key->chats1[count(($key->chats1))-1]."<br>";
            //         echo $key->account1[0]->name."<br>";

            //     }
            //     if ($key->ID2==session()->get('ID')) {
            //         echo("2 <br>");
            //         echo $key->chats2[count(($key->chats2))-1]."<br>";
            //         var_dump ($key->account2->name);

            //     }
            // }
            foreach ($rs as $gt) {
                $ne = new newsx($gt->IDBV, $gt->IDND, $gt->Content, $gt->Img, $gt->CLike, $gt->account->name, $gt->created_at, $gt->updated_at);
                $list_new[] = $ne;
            }
            // foreach ($rs as $value) {
            //     foreach ($value->likelist as $key) {
            //         echo $key->IDNL;
            //     }
            // }
            //dd($noti);
            return view("CS.home", compact('rs','hotNew','noti','adF','mess'));
        }
        else {
            return redirect('/account');
        }

    }
    public function GetDom()
    {
        return view("CS.Dom");
    }
    public function PostsNew($fname)
    {
        $news = new App\newsmodel;
        $news->IDND = session()->get('ID');
        $news->Content = "xznxbckashbakhsdghjasvdgjavfgamvdfgmasvdfga";
        $news->Img = '../FLRV-CH/local/public/assets/img/newi/' . $fname . '.jpeg';
        $news->save();
    }
    public function Getx()
    {
        return view("CS.master");
    }
    public function Logout()
    {
        return controller("AccountController@GetLogout");
    }
    public function postlike(Request $request)
    {

        $TLC = likelist::where([
            ['IDBV', $request->IDBV],
            ['IDNL', session()->get('ID')]
        ])->count();
        if ($TLC == 0) {
            $rs = DB::table('news')->select('CLike')->WHERE('IDBV', $request->IDBV)->get();
            foreach ($rs as $gt) {
                $clike = $gt->CLike;
            }
            $new = \App\newsmodel::WHERE('IDBV', $request->IDBV)->update(["CLike" => ($clike + 1)]);
            $newlike=new likelist;
            $newlike->IDBV=$request->IDBV;
            $newlike->IDNL=session()->get('ID');
            $newlike->save();
            $IDch=newsmodel::where('IDBV',$request->IDBV)->get();
            if (!$IDch[0]->IDND==session()->get('ID')) {
                $noti = new notification;
                $noti->IDNG=session()->get('ID');
                $noti->IDBV=$request->IDBV;
                $noti->Type="like bài viết của bạn";
                $noti->Status=0;
                $noti->save();
            }

            echo ($clike+1);
        }
        else {
            $rs = DB::table('news')->select('CLike')->WHERE('IDBV', $request->IDBV)->get();
            foreach ($rs as $gt) {
                $clike = $gt->CLike;
            }
            $new = \App\newsmodel::WHERE('IDBV', $request->IDBV)->update(["CLike" => ($clike - 1)]);
            likelist::where([
                ['IDBV', $request->IDBV],
                ['IDNL', session()->get('ID')]
            ])->delete();
            notification::where([
                ['IDBV', $request->IDBV],
                ['IDNG', session()->get('ID')]]
                )->delete();
            echo ($clike-1);
        }
    }
    public function postNews()
    {

        $rs = \App\newsmodel::all();
        foreach ($rs as $gt) {
            $ne = new news($gt->IDBV, $gt->IDND, $gt->Content, $gt->Img, $gt->CLike, $gt->account->name, $gt->created_at, $gt->updated_at);
            $list_new[] = $ne;
        }
        echo json_encode($list_new);
    }
    public function newbv(Request $request)
    {
        //echo session()->get('ID');
        $co = newsmodel::count();
        //dd($request->fileImg);
        // $filename="";
        if ($request->content !== "" || $request->hasFile('fileImg')) {
            $news = new newsmodel;;
            $news->IDND = session()->get('ID');
            $news->Content = $request->content;
            $news->Img = '/FLRV-CH/local/public/assets/img/newi/news_' . ($co + 1) . '.png';
            $news->type_content = 'img';
            $news->CLike = 0;
            $news->save();
            CSController::MakeNotification();
            if ($request->hasFile('fileImg')) {
                $file = $request->fileImg;
                // $filename=;
                // $typeF=$file->getMimeType();
                // $file->move(
                //     'local/public/assets/img/newi', //nơi cần lưu
                //     'news_' . ($co + 1) . '.png' //tên file
                // );
                CSController::addFile($file, $co+1);
                // echo $filename.'<br>'.$typeF;
            }

        }

        // $news->created_at=$request->;
        // $news->updated_at=$request->;
        return redirect()->back()->with('thongbaopost', 'Đăng tai thành công');
    }
    public function MakeNotification()
    {
        $hotNew= newsmodel::where('IDND',session()->get('ID'))->orderByRaw('created_at DESC')->limit(1)->get();
        $lfriend=list_friend::where('ID1',session()->get('ID'))->orWhere('ID2',session()->get('ID'))->get();
        foreach ($lfriend as $value) {
            $notif=new notification;
            $notif->IDNG=session()->get('ID');
            $notif->Type='Đã đăng bài viết mới';
            $notif->IDBV=$hotNew[0]->IDBV;
            //$noti->Status="";
            $notif->save();
        }
    }
    public function addFile($file, $fn)
    {
        // $co = newsmodel::count();
        $file->move(
            'local/public/assets/img/newi', //nơi cần lưu
            'news_' . ($fn) . '.png' //tên file
        );
        //dd($file);
    }
    public function postCMT(Request $request)
    {
        $gCMT = json_decode($request->get('data1'));
        $cmt = new comments;
        $cmt->IDBV = $gCMT->IDBV;
        $cmt->Content = $gCMT->Content;
        $cmt->IDNBL = session()->get('ID');
        $cmt->save();
        $data2=json_decode($request->get('data2'));
        $IDch=newsmodel::where('IDBV',$request->IDBV)->get();
        if (!$IDch[0]->IDND==session()->get('ID')) {
        $noti = new notification;
        $noti->IDNG=$data2->IDNG;
        $noti->IDBV=$data2->IDBV;
        $noti->Type="cmt";
        $noti->Status=0;
        $noti->save();}
        echo "success";
    }
    public function loadCMT(Request $request)
    {
        $IDBV = $request->get('IDBV');
        $CMTs = comments::where('IDBV', $IDBV)->get();
        if ($CMTs->count() != 0) {
            foreach ($CMTs as $value) {
                $list_cmt[] = new comment($value->IDBV, $value->IDNBL,$value->account->name,$value->account->Avt, $value->Content, $value->created_at, $value->update_at);
            }
            echo json_encode($list_cmt);
            //var_dump($CMTs);
        } else {
            echo "[{}]";
        }
    }
    public function postMess(Request $request)
    {
        $data=$request->get("data1");
        //$xd=json_decode($data);
        $mess=chats::where([
            ["IDreceive",session()->get('ID')],
            ["IDsend",$data]
        ])->orWhere([
            ["IDsend",session()->get('ID')],
            ["IDreceive",$data]
            ])->get();
        //dd($mess);
        echo(json_encode($mess));
    }
    public function saveMess(Request $request)
    {
        $data = json_decode($request->get("data1")) ;
        $mess= new chats;
        $mess->IDsend=$data->ID;
        $mess->IDreceive=$data->IDR;
        $mess->content=$data->Content;
        $mess->save();
    }
    public function saveToken(Request $request)
    {
        session(['IDNG'=>$request->IDNG]);
    }
    public function getToken(Request $request)
    {
        if (session()->exists('token')) {
            echo json_encode(session()->get('token'));
            session()->forget('token');
        }
        else {
            echo "[{}]";
        }


    }
    public function Sendreport(Request $request)
    {
        $rp=new report;
        $rp->Name=$request->Name;
        $rp->Email=$request->Email;
        $rp->Title=$request->Title;
        $rp->Content=$request->Content;
        $rp->save();
        return redirect()->back()->with('thongbao','Báo cáo của bản đá được gửi tới ban quan trị cảm ơn vì đánh giá của bạn');
    }
    public function newdetail($id)
    {
        if ($id) {
            $ndt=newsmodel::where('IDBV',$id)->get();
            $hotNew= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
            $noti= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
            $adF= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();
            $mess=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
            return view('CS.newdetail',compact('ndt','noti','hotNew','adF','mess'));
        }
        else {
            return redirect('/cs');
        }
    }
    public function AsRqF(Request $request)
    {
        if ($request->RQ==true) {
            $friend=new list_friend;
            $friend->ID1=$request->ID;
            $friend->ID2=session()->get('ID');
            $friend->save();
            advise_friend::where([
                ['IDNN',session()->get('ID')],
                ['IDNG',$request->ID]
            ])->delete();
        }
        else {
            advise_friend::where([
                ['IDNN',session()->get('ID')],
                ['IDNG',$request->ID]
            ])->delete();
        }
    }
    public function search(Request $request)
    {
        $rss=account::where('name','like','%'.$request->key.'%')->get();
        echo json_encode($rss);
    }
    public function adviseFriends()
    {
        if (session()->exists('ID')) {
            $data['rs'] = newsmodel::orderByRaw('created_at DESC')->get();
            $data['hotNew']= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
            $data['noti']= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
            $data['adF']= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();
            $data['bv']=newsmodel::limit(12)->get();
            $data['mess']=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
            $data['LAdvise']=account::whereNotIn('ID',list_friend::select('ID1')->where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('Id'))->get())->OrwhereNotIn('ID',list_friend::select('ID1')->where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('Id'))->get())->where('ID',session()->get('ID'))->limit(4)->get();
            //dd($data['LAdvise']);

            return view("CS.advise", $data);
        }
        else {
            return redirect('/account');
        }


    }
    public function LoadFriend(Request $request)
    {
        $data['LAdvise']=account::whereNotIn('ID',list_friend::select('ID1')->where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('Id'))->get())->OrwhereNotIn('ID',list_friend::select('ID1')->where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('Id'))->get())->where('ID',session()->get('ID'))->offset($request->offset*4)->limit(4)->get();
        echo json_encode($data['LAdvise']);
    }
}
class newsx
{
    public $IDBV;
    public $IDND;

    public $Content;
    public $Img;
    public $CLike;
    public $name;
    public $created_at;
    public $updated_at;
    public function __construct(
        $IDBV,
        $iDND,

        $content,
        $img,
        $cLike,
        $Name,
        $Created_at,
        $Updated_at
    ) {
        $this->IDBV = $IDBV;
        $this->IDND = $iDND;
        $this->Content = $content;
        $this->Img = $img;
        $this->CLike = $cLike;
        $this->name = $Name;
        $this->created_at = $Created_at;
        $this->updated_at = $Updated_at;
    }
}
class comment
{
    public $IDBV;
    public $IDNBL;
    public $NNBL;
    public $Avt;
    public $Content;
    public $created_at;
    public $updated_at;
    public function __construct(
        $IDBV,
        $IDNBL,
        $nNBL,
        $avt,
        $Content,
        $created_at,
        $updated_at
    ) {
        $this->IDBV = $IDBV;
        $this->IDNBL = $IDNBL;
        $this->NNBL = $nNBL;
        $this->Avt = $avt;
        $this->Content = $Content;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
