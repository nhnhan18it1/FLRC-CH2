<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\account;
use App\comments;
use App\newsmodel;
use App\likelist;
use App\list_friend;
use App\chats;
use App\advise_friend;
use App\notification;
use App\ur_notification;
use App\story;
use GuzzleHttp\Client;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
class testController extends Controller
{

    public function Login(Request $request)
    {
        $email=$request->username;
        $password=$request->password;
        $remember=$request->_token;
        if (Auth::attempt(['Username' => trim($email), 'password' => trim($password)])) {
            $rs=account::where('Username',$email)->get();
            echo json_encode($rs);
        }
        else {
            echo "fail";
        }
    }

    public function loadInforUser_full(Request $request)
    {
        $rs=account::where('ID',$request->ID)->get();
        echo json_encode($rs);
    }

    public function PostImg(Request $request)
    {
        $co = newsmodel::count();
        $file = $request->file('fileimg');
        $t=time();
        if (!empty($file)) {
            $file = $request->fileimg;
            $news = new newsmodel;;
            $news->IDND = $request->IDND;
            $news->Content = $request->Content;
            $news->Img = '/public/assets/img/newi/news_' . $t . '.png';
            $news->type_content = 'img';
            $news->CLike = 0;
            $news->save();
            testController::uploadfile($file,$t);
            echo $t;
        }

        else{
            echo "fail";
        }
    }



    function createImageFromBase64($base64String,$name)
    {
       $file_data = $base64String;
       $file_name = 'news_'.$name.'.png'; //generating unique file name;

       if ($file_data != "") { // storing image in storage/app/public Folder
           Storage::disk('public/assets/img/newi')->put($file_name, base64_decode($file_data));
       }
    }

    public function uploadfile($file,$name)
    {

            $file->move(
                'public/assets/img/newi', //nơi cần lưu
                'news_'.$name.'.png' //tên file
            );
    }

    public function postNews(Request $request)
    {
        $news=newsmodel::join('account', 'news.IDND', '=', 'account.ID')
        ->select('news.*', 'account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->offset($request->offset)
        ->limit(10)
        ->get();
        echo json_encode($news);
    }
    public function GetComments(Request $request)
    {
        $cmt=comments::join('account','account.ID','=','comments.IDNBL')->where('IDBV',$request->IDBV)
        ->select('comments.*','account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->get();
        echo json_encode($cmt);
    }
    public function PutComment(Request $request)
    {
        if ($request->Content!="") {
            $newcmt=new comments;
            $newcmt->IDBV=$request->IDBV;
            $newcmt->IDNBL=$request->IDNBL;
            $newcmt->Content=$request->Content;
            $newcmt->save();
            echo "success";
        }
        else{
            echo "emptycmt";
        }
    }
    public function postlike(Request $request)
    {
        $check=likelist::where([['IDBV',$request->IDBV],['IDNL',$request->IDND]])->get();
        $clike=newsmodel::where('IDBV',$request->IDBV)->get();
        //dd($check);
        if ($check->count()==0) {
            $addlike=new likelist;
            $addlike->IDBV=$request->IDBV;
            $addlike->IDNL=$request->IDND;
            $addlike->save();
            newsmodel::where('IDBV',$request->IDBV)->update(['CLike'=>($clike[0]->CLike+1)]);
            echo "true";
        }
        else{
            likelist::where([['IDBV',$request->IDBV],['IDNL',$request->IDND]])->delete();
            newsmodel::where('IDBV',$request->IDBV)->update(['CLike'=>($clike[0]->CLike-1)]);
            echo "false";
        }
    }

    public function loadlike(Request $request)
    {
        $clike=newsmodel::where('IDBV',$request->IDBV)->get();
        if ($clike->count()==0) {
            echo "0";
        }
        else
        {
            echo $clike[0]->CLike;
        }

    }
    public function loadlistfr(Request $request)
    {
        $listfr=list_friend::where('ID1',$request->ID)->orWhere("ID2",$request->ID)->get();
        foreach ($listfr as $value) {
            if ($value->ID1==$request->ID) {
                $value->accountx=$value->account2()->get();
            }
            else{
                $value->accountx=$value->account1()->get();
            }
        }
        echo json_encode($listfr);
    }

    public function loadinforuser(Request $request)
    {
        $infor=account::where('ID',$request->ID)->select('Avt','name')->get();
        echo json_encode($infor);
    }
    public function loadinforuser1(Request $request)
    {
        $infor=account::where('ID',$request->ID)->select('ID','Avt','name')->get();
        echo json_encode($infor);
    }
    public function autoSendMess(Request $request)
    {
        $cookie = '
        sb=k2J3XemMeJP3gXuW7-gLD_-7;
         datr=k2J3XYzKENBCIDXTEANcNXdD;
          c_user=100006409898902;
           xs=3%3APPD_LNIAJ5WJ6w%3A2%3A1573292929%3A10379%3A6241;
            m_pixel_ratio=1;
             wd=1920x935;
             spin=r.1002078803_b.trunk_t.1588588894_s.1_v.2_;
             act=1588675549273%2F2;
             fr=3BMCJmzO40dHZRZ0F.AWWxlwU6bVO055IZ7VUJvZxr-1Y.BejEOv.VC.F6n.0.0.BesUdn.AWWQUMeY;
             presence=EDvF3EtimeF1588676793EuserFA21B06409898902A2EstateFDsb2F1588519451142EatF1588519802590Et3F_5b_5dEutc3F1588675549296G588675549306CEchF_7bCC;';
        $user_agent = 'Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) coc_coc_browser/86.0.170 Chrome/80.0.3987.170 Safari/537.36';
        // end
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $h = $request->h;
        $m = $request->m;
        if((int)$h != (int)date('H') || (int)$m != (int)date('i')){
            echo json_encode([
                "type" => "error",
                "msg" => "Chưa tới giờ gửi tin"
            ]);
        }
        else{

            $id = $request->id;
            $body = $request->body;
            $fb_dtsg = $request->fb_dtsg;
            $h = $request->h;
            $m = $request->m;

            $param = array(
                "ids[$id]" => "$id",
                "body" => "$body",
                "fb_dtsg" => "$fb_dtsg",
            );

            $ch = curl_init();

                    CURL_SETOPT_ARRAY($ch,[
                        CURLOPT_URL => 'https://m.facebook.com/messages/send/?icm=1&refid=12&ref=dbl',
                        CURLOPT_USERAGENT => $user_agent,
                        CURLOPT_ENCODING => '',
                        CURLOPT_COOKIE => $cookie,
                        CURLOPT_HTTPHEADER => [
                            'Connection: keep-alive',
                            'Keep-Alive: 300',
                            'Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7',
                            'Accept-Language: en-us,en;q=0.5'
                        ],
                        CURLOPT_RETURNTRANSFER => 1,
                        CURLOPT_SSL_VERIFYHOST => FALSE,
                        CURLOPT_SSL_VERIFYPEER => FALSE,
                        CURLOPT_TIMEOUT => 60,
                        CURLOPT_CONNECTTIMEOUT => 60,
                        CURLOPT_FOLLOWLOCATION => TRUE,
                        CURLOPT_HTTPHEADER => [
                            'Expect:',
                        ],
                        CURLOPT_POST => count($param),

                    ]);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $param);
                    $excec = curl_exec($ch);
                    curl_close($ch);
                    echo json_encode([
                        'type' => 'success',
                        'msg' => "Đã gửi thành công tin nhắn: $body, tới ID: $id"
                    ]);
        }
    }
    public function LoadContentMess(Request $request)
    {
        $messes=chats::where([['IDsend',$request->ID1],['IDreceive',$request->ID2]])->orWhere([['IDsend',$request->ID2],['IDreceive',$request->ID1]])->get();
        //dd($messes);
        echo json_encode($messes);
    }
    public function SendMess(Request $request)
    {
        //dd($request);
        if ($request->IDsend!=""&&$request->IDreceive!=""&&$request->Content!="") {
            $sendm=new chats;
            $sendm->IDsend=$request->IDsend;
            $sendm->IDreceive=$request->IDreceive;
            $sendm->content=$request->Content;
            $sendm->status=0;
            $sendm->save();
            echo "success!";
        }
        else{
            echo "exit";
        }
    }
    public function LoadAdvise(Request $request)
    {
        $advises=advise_friend::where('IDNN',$request->ID)->get();
        echo "[";
        foreach($advises as $advise){
            $rs=account::where('ID',$advise->IDNG)->select('ID','Avt','name')->get();
            echo "{";
            echo '"IDNN":"'.$advise->IDNN.'",';
            echo '"IDNG":"'.$advise->IDNG.'",';
            echo '"created_at":"'.$advise->created_at.'",';
            echo '"updated_at":"'.$advise->updated_at.'",';
            echo '"accountx":'.json_encode($rs[0]);
            echo "}";
        }
        echo "]";
        //echo json_encode($advise);
    }
    public function LoadNoti(Request $request)
    {
        // $cmt=comments::join('account','account.ID','=','comments.IDNBL')->where('IDBV',$request->IDBV)
        // ->select('comments.*','account.name','account.Avt')
        // ->orderByRaw('created_at DESC')
        // ->get();
        // $notis=notification::join('news','news.IDBV','=','notification.IDBV')->where('notification.IDBV',31)
        // ->select('notification.IDBV','notification.IDNG','notification.Type','notification.created_at','notification.updated_at')
        // ->orderByRaw('created_at DESC')
        // ->get();


         //echo $request->ID;
        $ur_n=ur_notification::join('notification','ur_notification.IDBV','=','notification.IDBV')
            ->where('ur_notification.USR','like',"%".$request->ID."%")
            ->orderByRaw('created_at DESC')
            ->select('notification.ID','notification.IDBV','notification.IDNG','notification.Type','notification.created_at','notification.updated_at')
            ->get();
        //echo json_encode($ur_n);
        //echo '[';
        foreach ($ur_n as $noti) {
            $rs=account::where('ID',$noti->IDNG)->select('ID','Avt','name')->get();
            $noti->accountx=$rs[0];
            // echo '{';
            // echo '"ID":"'.$noti->ID.'",';
            // echo '"IDBV":"'.$noti->IDBV.'",';
            // echo '"IDNG":"'.$noti->IDNG.'",';
            // echo '"Type":"'.$noti->Type.'",';
            // echo '"isRead":false,';
            // echo '"created_at":"'.$noti->created_at.'",';
            // echo '"updated_at":"'.$noti->updated_at.'",';
            // echo '"accountx":'.json_encode($rs[0]);
            // echo '},';
        }
        echo json_encode($ur_n);
        //echo ']';
    }
    public function loadNews2(Request $request)
    {
        $news=newsmodel::join('account', 'news.IDND', '=', 'account.ID')
        ->where("type_content","img")
        ->select('news.*', 'account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->offset($request->offset)
        ->limit(10)
        ->get();
        $cs=array();
        foreach ($news as $key => $value) {
            $cs[]=$value->IDBV;
        }
        $cmts=comments::whereIn("IDBV",$cs)
        ->join("account","account.ID","=","comments.IDNBL")
        ->select("comments.*","account.name","account.Avt")
        ->get();
        foreach ($news as $key => $value) {
            $sm=array();
            foreach ($cmts as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $sm[]=$va;
                    unset($cmts[$k]);
                }
            }
           $value->comments=$sm;
        }
        $like=likelist::whereIN("IDBV",$cs)->where("IDNL",$request->IDND)->get();
        foreach ($news as $key => $value) {
            $islike=false;
            foreach ($like as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $islike=true;
                    unset($like[$k]);
                    break;
                }
            }
            $value->islike=$islike;
        }

        echo json_encode($news);


    }
    public function loadStory(Request $request)
    {
        $result=story::all();
        foreach ($result as $value) {
            $value->Avt=$value->account()->get()[0]->Avt;
            $value->Name=$value->account()->get()[0]->name;
        }
        echo json_encode($result);
    }

    public function Client_Send_Comment(Request $request)
    {
        $addCmt=new comments;
        $addCmt->IDBV=$request->IDBV;
        $addCmt->IDNBL=$request->ID;
        $addCmt->Content=$request->CmtContent;
        $addCmt->save();


        $rs=ur_notification::where("IDBV",$request->IDBV)->get();
        $arr;
        //echo $rs[0]->USR;
        if (count($rs)==0) {
            $addUR=new ur_notification;
            $addUR->IDBV = $request->IDBV;
            $addUR->USR = '['.$request->ID.']';
            $addUR->status = "true";
            $addUR->save();

            $arr=[$request->ID];
        }
        else{
            $exist=false;

            $arr = json_decode($rs[0]->USR);
            foreach ($arr as  $value) {
                if ($value==$request->ID) {
                    $exist=true;
                }
            }
            if (!$exist) {
                array_push($arr,(int)$request->ID);
                ur_notification::where("IDBV",$request->IDBV)->update(["USR"=>json_encode($arr)]);
            }


        }
        $addNoti=new notification;
        $addNoti->IDBV=$request->IDBV;
        $addNoti->IDNG=$request->ID;
        $addNoti->Type=$request->Content;
        $addNoti->Status=0;
        $addNoti->save();
        //print_r($arr);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'https://nhandz.herokuapp.com',
            // You can set any number of default request options.
            'timeout'  => 10.0,
        ]);
        $url = "/notify";
        //$request = $client->post($url,$body);
        $res = $client->request('POST', '/notify', [
            'form_params' => [
                'muser'=>json_encode($arr),
                'data'=>'{"ID":'.$request->ID.',"Content":"'.$request->Content.'","IDBV":"'.$request->IDBV.'","Name":"'.$request->Name.'"}',

        ],
        ]);

        print_r($res->getBody()->getContents());


    }
    public function GetGalary(Request $request)
    {
        $ss=newsmodel::orderByRaw('Clike DESC')->Limit(20)->get();
        foreach ($ss as $va) {
            $va->Avt=$va->account()->get()[0]->Avt;
            $va->name=$va->account()->get()[0]->name;
        }
        echo json_encode($ss);
    }

    public function loadNews3(Request $request)
    {
        $news=newsmodel::join('account', 'news.IDND', '=', 'account.ID')
        ->where("type_content","video")
        ->select('news.*', 'account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->offset($request->offset)
        ->limit(10)
        ->get();
        $cs=array();
        foreach ($news as $key => $value) {
            $cs[]=$value->IDBV;
        }
        $cmts=comments::whereIn("IDBV",$cs)
        ->join("account","account.ID","=","comments.IDNBL")
        ->select("comments.*","account.name","account.Avt")
        ->get();
        foreach ($news as $key => $value) {
            $sm=array();
            foreach ($cmts as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $sm[]=$va;
                    unset($cmts[$k]);
                }
            }
           $value->comments=$sm;
        }
        $like=likelist::whereIN("IDBV",$cs)->where("IDNL",$request->ID)->get();
        foreach ($news as $key => $value) {
            $islike=false;
            foreach ($like as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $islike=true;
                    unset($like[$k]);
                    break;
                }
            }
            $value->islike=$islike;
        }
        echo json_encode($news);

    }
    public function loadNews4(Request $request)
    {
        $news=newsmodel::join('account', 'news.IDND', '=', 'account.ID')
        ->where([["type_content","img"],["IDND",$request->IDND]])
        ->select('news.*', 'account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->offset($request->offset)
        ->limit(10)
        ->get();
        $cs=array();
        foreach ($news as $key => $value) {
            $cs[]=$value->IDBV;
        }
        $cmts=comments::whereIn("IDBV",$cs)
        ->join("account","account.ID","=","comments.IDNBL")
        ->select("comments.*","account.name","account.Avt")
        ->get();
        foreach ($news as $key => $value) {
            $sm=array();
            foreach ($cmts as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $sm[]=$va;
                    unset($cmts[$k]);
                }
            }
           $value->comments=$sm;
        }
        $like=likelist::whereIN("IDBV",$cs)->where("IDNL",$request->IDND)->get();
        foreach ($news as $key => $value) {
            $islike=false;
            foreach ($like as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $islike=true;
                    unset($like[$k]);
                    break;
                }
            }
            $value->islike=$islike;
        }

        echo json_encode($news);
    }
    public function Search(Request $request)
    {
        $acc=account::where('name','like','%'.$request->name.'%')
        ->select('name','ID','Avt')
        ->get();
        echo json_encode($acc);
    }
    public function GetANews(Request $request)
    {
        $news=newsmodel::join('account', 'news.IDND', '=', 'account.ID')
        ->where([["type_content","img"],["IDBV",$request->IDBV]])
        ->select('news.*', 'account.name','account.Avt')
        ->orderByRaw('created_at DESC')
        ->offset($request->offset)
        ->limit(10)
        ->get();
        $cs=array();
        foreach ($news as $key => $value) {
            $cs[]=$value->IDBV;
        }
        $cmts=comments::whereIn("IDBV",$cs)
        ->join("account","account.ID","=","comments.IDNBL")
        ->select("comments.*","account.name","account.Avt")
        ->get();
        foreach ($news as $key => $value) {
            $sm=array();
            foreach ($cmts as $k => $va) {
                if ($va->IDBV==$value->IDBV) {
                    $sm[]=$va;
                    unset($cmts[$k]);
                }
            }
           $value->comments=$sm;
        }
        $islike=likelist::where([["IDBV",$request->IDBV],["IDNL",$request->IDND]])->count();
        if ($islike>0) {
            $news[0]->islike=true;
        }
        else{
            $news[0]->islike=false;
        }


        echo json_encode($news);
    }
}
