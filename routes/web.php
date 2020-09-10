<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

// use Symfony\Component\Routing\Annotation\Route;
use Illuminate\Database\Schema\Blueprint;


//use Illuminate\Support\Facades\App;

Route::get('', 'WellcomeController@StartLRV');
Route::get('xx/{ab?}', 'WellcomeController@xx');
Route::group(['prefix' => 'account'], function () {
    Route::get('login', 'AccountController@login');
    Route::get('/', 'AccountController@M1login');
    Route::get('signup', 'AccountController@signup');
    Route::post('postsignup', 'AccountController@postsignup');
    Route::get('master', 'AccountController@master');
    Route::post('login', 'AccountController@Getlogin')->name("login");
    Route::get('logout', 'AccountController@GetLogout');
    Route::post('LoginWithGoogle', 'AccountController@LoginWithGoogle');

    Route::post('changepass', 'AccountController@ChangePass');

    Route::post('checkIF', 'AccountController@checkIF');

});

Route::group(['prefix' => 'cs'], function () {
    Route::get('/', 'CSController@GetHome');
    Route::get('home', 'CSController@GetHome');
    Route::get('DOM', 'CSController@GetDom');
    Route::get('logout', 'AccountController@GetLogout');
    Route::post('postlike', 'CSController@postlike');
    Route::get('news/{id?}', 'CSController@postNews');
    Route::post('newbv', 'CSController@newbv');
    Route::post('postCMT', 'CSController@postCMT');
    Route::post('loadCMT', 'CSController@loadCMT');
    Route::post('postMess', "CSController@postMess");
    Route::post('saveMess', "CSController@saveMess");
    Route::post('saveToken', "CSController@saveToken");
    Route::post('getToken', "CSController@getToken");
    Route::post('Sendreport', "CSController@Sendreport");
    Route::get('newdetail/{id?}', 'CSController@newdetail');
    Route::post('AsRqF', 'CSController@AsRqF');
    Route::post('search', 'CSController@search');
    Route::get('advise', 'CSController@adviseFriends');
    Route::post('LoadFriend', 'CSController@LoadFriend');

    Route::get('TPapi', function() {
        return view("CS.tapi");
    });

});
// Route::group(['prefix' => 'android'], function () {
//     Route::get('', "RestController@GetImg");
// });

Route::group(['prefix' => 'api'], function () {
    Route::post('login', 'API\testController@Login');
    Route::get('base64', function () {
        $data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
            . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
            . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
            . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';
        $data = base64_decode($data);

        $im = imagecreatefromstring($data);
        if ($im !== false) {
            header('Content-Type: image/png');
            imagepng($im);
            imagedestroy($im);
        } else {
            echo 'An error occurred.';
        }
    });

    Route::post('postfile', 'API\testController@PostImg')->name("postf");
    Route::post('getnews', 'API\testController@postNews');
    Route::post('getcmt', 'API\testController@GetComments');
    Route::post('putcomment','API\testController@PutComment');
    Route::post('postlike', 'API\testController@postlike');
    Route::post('loadclike', 'API\testController@loadlike');
    Route::post('loadlistfr', 'API\testController@loadlistfr');
    Route::post('loadinforuser', 'API\testController@loadinforuser');
    Route::get('loadinforuser1', 'API\testController@loadinforuser1');
    Route::post('loadinforuser1', 'API\testController@loadinforuser1');
    Route::get('autosendmess','API\testController@autoSendMess');
    Route::post('loadMess','API\testController@LoadContentMess');
    Route::post('SendMess', 'API\testController@SendMess');
    Route::post('loadInforUser_full', 'API\testController@loadInforUser_full');
    Route::get('loadAdvise', 'API\testController@LoadAdvise');
    Route::post('loadAdvise', 'API\testController@LoadAdvise');
    Route::post('loadnoti', 'API\testController@LoadNoti');
    Route::post('getnews2','API\testController@loadNews2');
    Route::get('getnews2','API\testController@loadNews2');
    Route::get('getStory', 'API\testController@loadStory');
    Route::post('getStory', 'API\testController@loadStory');
    Route::get('scmt', 'API\testController@Client_Send_Comment');
    Route::post('scmt', 'API\testController@Client_Send_Comment');
    Route::get("getGalary",'API\testController@GetGalary');
    Route::get('getvideo', 'API\testController@loadNews3');
    Route::get('getnews4','API\testController@loadNews4' );
    Route::get('search', 'API\testController@search');
    Route::get('GetANews', 'API\testController@GetANews');
    Route::get('getInforS', 'API\testController@loadnewsSearch');
    Route::get('addFriend', 'API\testController@addFriend');
    Route::delete('deleteAdvise', 'API\testController@cancelAdvise');
    Route::post('acceptAdvise', 'API\testController@acceptAdise');
});

Route::group(['prefix' => 'pChat'], function () {
    Route::get('/', "chatController@LoadP");
    Route::get('videochat', function () {
        return view("chats.videoChat");
    });
    Route::post('saveIDNN', "chatController@saveIDNN");

});
Route::group(['prefix' => 'gallary'], function () {
    Route::get('/', "gallaryController@index");
    Route::post('loadImg', 'gallaryController@loadImg');
});
Route::group(['prefix' => 'profile'], function () {
    Route::get('changeInfor', 'profileController@changeInfor');
    Route::get('/{id}', 'profileController@get_profile');
    Route::post('changeAvt', 'profileController@changeAvt');

    Route::post('addfriend', 'profileController@addfriend');

});

Route::group(['prefix' => 'chat'], function () {
    Route::get('', 'RedisController@index');
    Route::post('postmess', 'RedisController@postmess');

});
Route::group(['prefix' => 'query'], function () {
    date_default_timezone_set("Asia/Ho_Chi_Minh");
    Route::get('insertAcc', function () {
        // $datet=new DateTime();
        DB::table('account')->insert([
            'Username'   => 'nhavbnm',
            'Password'   => '123456789',
            'name'       => 'Nguyen Hai Nhan',
            'SDT'        => 339898292,
            'Dob'        => '2000-06-03',
            'Avt'        => '.',
            'created_at' => date('Y-m-d h:i:s')]);
    });
    Route::get('1-na', function () {
        $rs = App\newsmodel::all();
        foreach ($rs as $gt) {
            echo $gt->IDBV . "-" . $gt->account->name . "<br>";

        }
    });
    Route::get('createcomments', function () {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('IDBV');
            $table->integer('IDNBL');
            $table->string('Content');
            $table->timestamps();
        });
    });
    Route::get('news', function () {
        Schema::create('news', function (Blueprint $table) {
            $table->bigIncrements('IDBV', 255)->autoIncrement();
            $table->bigInteger('IDND');
            $table->longText('Content');
            $table->string('Img');
            $table->integer('CLike');
            $table->timestamps();
        });
    });
    Route::get('chats', function () {
        Schema::create('chats', function (Blueprint $table) {
            $table->bigIncrements('ID');
            $table->bigInteger('IDsend');
            $table->bigInteger('IDreceive');
            $table->string('content');
            $table->timestamps();
        });
    });
});
Route::group(['prefix' => 'tmd'], function () {
    Route::get('all', function () {
        $user = App\account::find(1)->toArray();
        dd($user);
    });
});
Route::get('convert', function () {
    $us = App\account::where('ID', 1)->update(['Password' => bcrypt("123456")]);
    // $us->name='abc';
    // $us->save();
    dd($us);
});
