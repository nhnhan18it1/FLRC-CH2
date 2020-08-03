<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\http\Requests\loginrequest;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\account;

class AccountController extends Controller
{
    public function login()
    {
        if (session()->exists('ID')) {
            return redirect('/cs');
        }
        else {
            return view('Account.login');
        }

    }
    public function M1login()
    {
        if (session()->exists('ID')) {
            return redirect('/cs');
        }
        else {
            return view('Account.M1login');
        }


    }
    public function signup()
    {
        if (session()->exists('ID')) {
            return redirect('/cs');
        }
        else return view('Account.signUp');

    }
    public function postsignup(Request $request)
    {
        $acc=new account;
        $acc->Username=$request->uname;
        $acc->password=bcrypt($request->pword);
        $acc->name=$request->fname;
        $acc->SDT=$request->phone;
        $acc->Email=$request->email;
        $acc->Dob=$request->dob;
        if ($request->hasFile('file')) {
            $co=account::count();
            $acc->Avt='/FLRV-CH/local/public/assets/img/avatar/avt_'.$co.'.png';

        }
        else {
            $acc->Avt='/FLRV-CH/local/public/assets/img/avatar/noAvt.png';
        }
        $acc->sex=$request->sex;
        $acc->save();
        if ($request->hasFile('file')) {
            AccountController::addFile($request->file,$co);
        }
        return redirect('/FLRV-CH/account');

    }

    public function checkIF(Request $request)
    {
        switch ($request->title) {
            case 'username':
                if (account::where('Username',$request->content)->count()==0) {
                    echo 'true';
                }else {
                    echo 'false';
                }
                break;
            case 'email':
                if (account::where('Email',$request->content)->count()==0) {
                    echo 'true';
                }else {
                    echo 'false';
                }
                break;
            case 'phone':
                if (account::where('SDT',$request->content)->count()==0) {
                    echo 'true';
                }else {
                    echo 'false';
                }
                break;
            default:
                # code...
                break;
        }
    }


    public function master()
    {
        return view('Account.master');
    }
    public function Getlogin(Request $request)
    {
        $email=$request->username;
        $password=$request->password;
        $remember=$request->_token;
        if (Auth::attempt(['Username' => $email, 'password' => $password],true)) {
            $rs=DB::table('account')->where('Username',$email)->get();

            foreach($rs as $gt){
                $ID=$gt->ID;
                $Name=$gt->name;
                $Avt=$gt->Avt;
            }
            // dd($rs);
            //session()->put('ID',$ID);
            session([
                'ID'=>$ID,
                'Name'=>$Name,
                'Avt'=>$Avt,
            ]);
            // echo(session()->get('ID'));
            // echo '<a href="logout">Logout '.session()->get('ID').' </a>';

            return redirect("cs/");
        }
        else {
            return redirect()->back()->with('thongbao','Tai khoan hoac mat khau khong chinh xac');
        }
        // $request->validate([
        //     'username'=>'required',
        //     'password'=>'required',
        // ]);
    }
    public function GetLogout()
    {
        Auth::logout();
        session()->forget('ID');
        return view('Account.M1login');
    }
    public function LoginWithGoogle(Request $request)
    {
        // dd($request->post('data1'));
        $data= $request->input('data1');

        $google=json_decode($data);
        $add= \App\account::where('Username',$google->ID);

        if ($add->count()==0) {
            $gacc=new \App\account;
            $gacc->Username=$google->ID;
            $gacc->password="";
            $gacc->Name=$google->Name;
            $gacc->Email=$google->Email;
            $gacc->Avt=$google->Img;
            $gacc->save();
            echo  "Add to system";

            // redirect()->route("index");
        }
        else {
            if ($google->DCL) {
                $tk=\App\account::where('Username',$google->ID)->get();
            foreach ($tk as $value) {
                session(['ID'=>$value->ID]);
                session(['Avt'=>$value->Avt]);
                session(['Name'=>$value->name]);
            }

            echo  "gotohome";
            }

            // redirect()->route("index");
        }


    }
    public function addFile($file, $fn)
    {
        // $co = newsmodel::count();
        $file->move(
            'local/public/assets/img/avatar', //nơi cần lưu
            'avt_' . ($fn) . '.png' //tên file
        );
        //dd($file);
    }
    public function ChangePass(Request $request)
    {
        $ac=account::where('ID',session()->get('ID'))->get();
        if (Auth::attempt(['Username' => $ac[0]->Username, 'password' => $request->oldpass])) {
            if (strlen($request->newpass)>=6&&strlen($request->newpass)<=12) {
                account::where('ID',session()->get('ID'))->update(['password'=>bcrypt($request->newpass)]);
                return redirect()->back()->with('thongbaoAS','Mật khẩu đã được thay đổi thành công!');
            }
            else{
                return redirect()->back()->with('thongbaoAF','Độ dài mật khẩu không phù hợp!');
            }

        }
        else{
            return redirect()->back()->with('thongbaoAF','Vui lòng nhập chính xác mặt khẩu!');
        }
    }
}
