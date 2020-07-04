<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\newsmodel;
use App\comments;
use App\likelist;
use App\notification;
use App\report;
use App\advise_friend;
use App\list_friend;
use App\account;

class profileController extends Controller
{
    public function get_profile($id)
    {
        if (session()->exists('ID')) {
            $data['rs'] = newsmodel::where('IDND',$id)->orderByRaw('created_at DESC')->get();
            $data['hotNew']= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
            $data['noti']= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
            $data['adF']= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();
            $data['nb']=newsmodel::where('IDND',$id)->orderByRaw('created_at DESC')->limit(16)->get();
            $data['infor']=account::where('ID',$id)->get();
            $data['mess']=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
            //dd($noti);
            if ($id==session()->get('ID')) {
                return view("profile.profile_1",$data);
            }
            else {
                $data['idA']=$id;
                return view("profile.profile_2",$data);
            }
        }
        else {
            return redirect('/account');
        }

    }
    public function changeAvt(Request $request)
    {
        $co=newsmodel::count();
        if ($request->hasFile('file')) {
            account::where('ID',session()->get('ID'))->update(['Avt'=>'/FLRV-CH/local/public/assets/img/avatar/avt_' .session()->get('Name'). '_'.$co.'.png']);
            profileController::addFile($request->file,session()->get('Name'). '_'.$co);
            profileController::newbv('/FLRV-CH/local/public/assets/img/avatar/avt_' .session()->get('Name'). '_'.$co.'.png');
            session(['Avt'=>'/FLRV-CH/local/public/assets/img/avatar/avt_' .session()->get('Name'). '_'.$co.'.png']);
            return redirect()->back();
        }
        else {
            return redirect()->back();
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
    public function newbv($img)
    {
        $news = new newsmodel;;
        $news->IDND = session()->get('ID');
        $news->Content = session()->get('Name').' đã thay đổi ảnh đại diện';
        $news->Img = $img;
        $news->type_content = 'img';
        $news->CLike = 0;
        $news->save();
    }
    public function changeInfor()
    {
        if (session()->exists('ID')) {
            // $data['rs'] = newsmodel::where('IDND',session()->get('ID'))->orderByRaw('created_at DESC')->get();
            $data['hotNew']= newsmodel::orderByRaw('CLike DESC')->limit(5)->get();
            $data['noti']= notification::Join('news','notification.IDBV','=','news.IDBV')->where('news.IDND',session()->get('ID'))->get();
            $data['adF']= advise_friend::Where('IDNN',session()->get('ID'))->orderbyraw('created_at DESC')->get();
            $data['nb']=newsmodel::where('IDND',session()->get('ID'))->orderByRaw('created_at DESC')->limit(16)->get();
            $data['infor']=account::where('ID',session()->get('ID'))->get();
            $data['mess']=list_friend::where('ID1',session()->get('ID'))->orwhere('ID2',session()->get('ID'))->get();
            //dd($noti);

            return view("profile.changeinfor",$data);
        }
        else {
            return redirect('/account');
        }
    }
    public function addfriend(Request $request)
    {

        if (list_friend::where([['ID1',session()->get('ID')],['ID2',$request->ID]])->orWhere([['ID1',$request->ID],['ID2',session()->get('ID')]])->count()==0) {
            if (advise_friend::where([['IDNN',session()->get('ID')],['IDNG',$request->ID]])->count()==0&&advise_friend::where([['IDNG',session()->get('ID')],['IDNN',$request->ID]])->count()==0) {
                $addrq=new advise_friend;
                $addrq->IDNG=session()->get('ID');
                $addrq->IDNN=$request->ID;
                $addrq->save();
                echo('Đã yêu cầu thêm bạn bè...');
            }
            elseif(advise_friend::where([['IDNG',session()->get('ID')],['IDNN',$request->ID]])->count()==1){
                echo('Vui lòng đợi đối phương chấp nhận kết bạn');
            }
            elseif (advise_friend::where([['IDNN',session()->get('ID')],['IDNG',$request->ID]])->count()==1) {
                advise_friend::where([['IDNN',session()->get('ID')],['IDNG',$request->ID]])->delete();
                $listF=new list_friend;
                $listF->ID1=session()->get('ID');
                $listF->ID2=$request->ID;
                $listF->save();
                echo('Hai bạn đã là bạn bè của nhau...');
            }

        }
        else{
            # code...
        }
    }
}
