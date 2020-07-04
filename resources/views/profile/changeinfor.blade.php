@extends('CS.master') @section('content')
<br>
<br>
<br>
<!doctype html>
<html lang="en">

<head>
    <title>CS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script>
        // function HienCMT($elm) {
        //     $elm.classList.add("hien");
        //     $elm.classList.remove("an");
        //   }

        $ccmt = 0;
        $(document).ready(function() {
            @if(session('thongbaopost'))
            alert("{{ session('thongbaopost') }}");
            @endif
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });

            $('.carousel-item').hover(function () {
                    // over
                    $('.carousel-captionx').css('opacity', 1);
                }, function () {
                    // out
                    $('.carousel-captionx').css('opacity', 0);
                }
            );

            $(".boc").click(function() {
                $box = $(this).parents(".card").find('.comment');
                $CMTCT = $(this).parents(".card").find('.cmtCT');
                //console.log('load cmt')
                if ($($box).css('display') == "none") {


                    $box.addClass('hien').removeClass('an');
                    //return;
                } else {
                    $box.addClass('an').removeClass('hien');
                    //return;
                }
                //alert($($box).css('display'));
                $.ajax({
                    type: "post",
                    url: "/FLRV-CH/cs/loadCMT",
                    data: {
                        IDBV: $(this).parents(".card").find('#IDBV').val(),
                    },
                    dataType: "json",
                    success: function(data) {
                        console.log(data)
                        if (data.length > 0) {
                            $add = "";
                            $.each(data, function(key, value) {
                                console.log(value.Content)
                                if (value.Content == null) {
                                    $($CMTCT).html("");
                                    return;
                                }
                                $add = $add + '<div class="container">' +
                                    '<a href="#"><img src="' + value.Avt + '" alt="Avatar">' + value.NNBL + '</a>' +
                                    '<p>' + value.Content + '<span class="time-right">' + value.created_at + '</p></span></div>';

                                // $($CMTCT).append(content);
                            });
                            $($CMTCT).html($add);
                        } else {
                            $($CMTCT).html("");
                        }

                    }
                });


            });
            $(".card-body img").click(function() {

                $("#model-img").attr('src', $(this).attr('src'));
            });
            $(window).scroll(function() {
                var oldva = 0;
                var pos_body = $("html,body").scrollTop();
                if (pos_body > 200) {
                    $("#myHeader").css("top", "10%");
                    if (pos_body > 1200) {
                        $('.back-to-top').addClass('hien-ra');

                    } else {
                        $('.back-to-top').removeClass('hien-ra');

                    }
                } else {
                    $("#myHeader").css("top", "15%");
                    if (pos_body > 1200) {
                        $('.back-to-top').addClass('hien-ra');

                    } else {
                        $('.back-to-top').removeClass('hien-ra');

                    }
                }


            });



            $('.back-to-top').click(function(event) {
                $('html,body').animate({
                    scrollTop: 0
                }, 1400);
            });
            $('.myPopover').popover({
                html: true,
                content: function() {
                    var elementId = $(this).attr("data-popover-content");
                    return $(elementId).html();
                }
            });

            $(document).ajaxComplete(function() {
                $CMTCT = $(this).parents(".card").find('.cmtCT');
                $(".boc").click(function() {
                    $box = $(this).parents(".card").find('.comment');
                    // $.ajax({
                    //     type: "post",
                    //     url: "cs/loadCMT",
                    //     data: {
                    //         IDBV: $(this).parents(".card").find('#IDBV').val(),
                    //     },
                    //     dataType: "json",
                    //     success: function(data) {
                    //         console.log(data)
                    //         $add = "";
                    //         $.each(data, function(key, value) {
                    //             $add = $add + '<div class="container">' +
                    //                 '<a href="#"><img src="/FLRV-CH/local/public/assets/img/intro/12.jpg" alt="Avatar"></a>' +
                    //                 '<p>' + value.Content + '</p>' +
                    //                 '<span class="time-right">' + value.created_at + '</span></div>';

                    //             // $($CMTCT).append(content);
                    //         });
                    //         $($CMTCT).html($add);
                    //     }
                    // });
                    if ($($box).css('display') == "none") {
                        $box.addClass('hien').removeClass('an');
                        return;
                    } else {
                        $box.addClass('an').removeClass('hien');
                        return;
                    }
                    //alert($($box).css('display'));

                });
                $(".card-body img").click(function() {

                    $("#model-img").attr('src', $(this).attr('src'));
                });
            });
        });
        $(document).ajaxComplete(function() {
            $(".boc").click(function() {
                $box = $(this).parents(".card").find('.comment');
                if ($($box).css('display') == "none") {
                    $box.addClass('hien').removeClass('an');
                    return;
                } else {
                    $box.addClass('an').removeClass('hien');
                    return;
                }
                alert($($box).css('display'));


            });
            $(".card-body img").click(function() {

                $("#model-img").attr('src', $(this).attr('src'));
            });
        });

        function like($node) {
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/postlike",
                data: {
                    IDBV: $node.find('#IDBV').val(),
                },
                dataType: "text",
                success: function(data) {
                    $node.find('.clike').text(data);
                }
            });
            socket.emit('client-like', {
                IDBV: $node.find('#IDBV').val(),
                IDNG: " {{ session()->get('ID') }} ",
                NameNG: "{{ session()->get('Name') }}",
                IDND: $node.find('#IDND').val()
            });

            //console.log($node.find('#IDBV').val())
        }
    </script>
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/baiviet/he.css">
    <style>
        #myHeader {
            position: fixed;
            top: 15%;
            /*padding: 10px 16px;*/
            padding-right: -20px;
            /*color: #f1f1f1;*/
            width: 100%;
            max-width: 480px;
            transition: all 1.2s;
        }

        .content {
            padding: 16px;
        }

        .sticky {
            position: fixed;
            top: 0;
            width: 100%;
        }

        .sticky+.content {
            padding-top: 102px;
        }

        #imgBV {
            height: 250px;
            width: 100%;
        }

        .carousel-captionx {
            color: white;
            padding: 0 0 0 0;
            width: 175px;
            height: 45%;
            background-color: rgba(19, 18, 18, 0.573);
            position: absolute;
            left: 0;
            bottom: 0;
            right: 0%;
            opacity: 0;
            transition: all 0.8s;
        }

        .carousel-captionx img {
            width: 45px;
            height: 45px;
            border-radius: 100%;
            border: 1px solid white;
        }

        .carousel-captionx h4 {
            padding-left: 5px;
            text-align: left;
            left: 0%;
            color: white;
            display: block;
        }

        .carousel-captionx p {
            width: 100%;
            padding-left: 5px;
            float: left;
            text-align: left;
        }

        #carouselId :hover .carousel-captionx {
            opacity: 1;
        }

        #carousel-control-prev {
            width: 5%;
        }

        #carousel-control-next {
            width: 5%;
        }
    </style>
</head>

<body>
    <div style="margin: 0 0 0 0;" class="row">
        <div style="position: relative;padding: 0 0 0 0;height: 400px;border: 1.2px solid white;background-image: url(/FLRV-CH/local/public/assets/img/newi/abc3.jpeg);background-position: center;
        background-size: cover;" class="col-md-10 column-1">
            <br>
            <div style="margin: 0 0 0 0;bottom: 0;position: absolute;height: 175px;" class="row">

                <div class="col-lg-5 column-1">
                    <div class="carousel-item" style="display: block">
                        <img id="avt" style="border: 2px solid white;border-radius: 100%;width: 175px;height: 175px;" src="{{ session()->get('Avt') }}" class="" alt="">
                        <div class="carousel-captionx d-md-block">
                            <h4> <button type="button" id="chanA" class="btn btn-infor"><i style="color: white;" class="fas fa-camera"></i></button></h4>

                        </div>
                    </div>
                </div>
                <div class="col-md-7 column-2">
                    <h3 style="color: white;bottom: 0;padding-top: 35%;padding-left: 55px;">{{ session()->get('Name') }}</h3>
                </div>

            </div>
            <div style="margin: 0 0 0 0;bottom: 0;position: absolute;right: 0;display: none;" class="row">
                <div class="col-md-12 column-1" style="">
                    <button type="button" onclick="window.location='/FLRV-CH/profile/changeInfor'" class="btn btn-secondary">Thay đổi thông tin cá nhân</button>
                </div>
            </div>

        </div>
    </div>
    <div style="margin: 0 0 0 0;" class="row">
        <div style="padding: 0 0 0 0;padding-right: 10px;padding-left: 2px;" class="col-md-2 column-1">
            <br>
            <div class="list-group">
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">Name: {{ $infor[0]->name }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">Date of birth: {{ $infor[0]->Dob }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">Sex: {{ $infor[0]->sex }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">phone: {{ $infor[0]->SDT }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">Email: {{ $infor[0]->Email }}</a>
                <a href="javascript:void(0)" class="list-group-item list-group-item-action list-group-item-primary">Date created: {{ $infor[0]->created_at }}</a>
            </div>
            <hr>
            <div style="margin: 0 0 0 0;border: 1px solid rgb(196, 195, 195);background-color: whitesmoke;border-radius: 5px;box-shadow: 2px 2px 2px gray;;" class="row">
                <div style="padding: 0 0 0 0;" class="col-md-3 column-1">
                    @if (count($nb)!=0)
                        @for ($i = 0; $i
                    < count($nb); $i++) @if ($i%4==0) <img style="width: 75px;height: 75px;" src="{{ $nb[$i]->Img }}" alt="">
                    @endif @endfor
                    @endif

                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-2">
                    @if (count($nb)!=0)
                        @for ($i = 0; $i
                    < count($nb); $i++) @if ($i%4==01) <img style="width: 75px;height: 75px;" src="{{ $nb[$i]->Img }}" alt="">
                        @endif @endfor
                    @endif

                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-3">
                    @if (count($nb)!=0)
                        @for ($i = 0; $i
                    < count($nb); $i++) @if ($i%4==02) <img style="width: 75px;height: 75px;" src="{{ $nb[$i]->Img }}" alt="">
                        @endif @endfor
                    @endif

                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-4">
                    @if (count($nb)!=0)
                        @for ($i = 0; $i
                    < count($nb); $i++) @if ($i%4==03 ) <img style="width: 75px;height: 75px;" src="{{ $nb[$i]->Img }}" alt="">
                        @endif @endfor
                    @endif

                </div>
            </div>
            <hr>

        </div>
        <div id="cont" style="padding: 0 0 0 0;" class="col-md-5 column-2">
        <br>
        <form action="" method="post">
            <div style="border: 1px solid gray;padding: 4px 4px 4px 4px;border-radius: 10px;" class="form-group">
                <br>
                <i style="font-size: 22px;margin-left: 17px;" class="fas fa-user-cog">Thay đổi thông tin cá nhân !</i>
                <br>
                <br>
                <label for=""> <strong>Name</strong> </label>
                <input type="text"
                    class="form-control form-control-sm" name="" id="" aria-describedby="helpId" placeholder="">
                {{--  <small id="helpId" class="form-text text-muted">Help text</small>  --}}
                <br>
                <label for=""> <strong>Phone</strong> </label>
                <input type="text"
                    class="form-control form-control-sm" name="" id="" aria-describedby="helpId" placeholder="">
                {{--  <small id="helpId" class="form-text text-muted">Help text</small>  --}}
                <br>
                <label for=""> <strong>Date of birth</strong> </label>
                <input type="date"
                    class="form-control form-control-sm" name="" id="" aria-describedby="helpId" placeholder="">
                {{--  <small id="helpId" class="form-text text-muted">Help text</small>  --}}
                <br>
                @if ($infor[0]->password!='')
                    <label for=""> <strong>Email</strong> </label>
                    <input type="email"
                        class="form-control form-control-sm" value="{{ $infor[0]->Email }}" name="" id="" aria-describedby="helpId" placeholder="">
                    {{--  <small id="helpId" class="form-text text-muted">Help text</small>  --}}
                    <br>
                @else
                    <label for=""> <strong>Email</strong> </label>
                    <input type="email"
                        class="form-control form-control-sm" name="" value="{{ $infor[0]->Email }}" id="" aria-describedby="helpId" disabled placeholder="">
                    {{--  <small id="helpId" class="form-text text-muted">Help text</small>  --}}

                    <br>
                @endif

                <div class="form-group">
                  <label for=""><strong>Sex</strong></label>
                  <select class="form-control" name="" id="">
                    <option>Male</option>
                    <option>Female</option>
                    <option>other</option>
                  </select>
                </div>
                <br>
                <button style="margin-left: 80%;width: 125px;" type="submit" class="btn btn-outline-primary">Submit</button>
              </div>
        </form>

        </div>
        <div id="cont"  class="col-md-3 column-2">
            <br>
            @if ($infor[0]->password!='')
                <form action="/FLRV-CH/account/changepass" method="post">
                    <div style="padding: 1px 5px 5px 5px;border: 1.2px solid gray;border-radius: 10px;" class="form-group">
                    @if (session('thongbaoAS'))
                    <div class="alert alert-success" role="alert">
                        <strong>{{ $thongbaoAS }}</strong>
                    </div>
                    @endif
                    @if (session('thongbaoAF'))
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ $thongbaoAF }}</strong>
                        </div>
                    @endif
                    <br>
                    <i style="font-size: 22px;margin-left: 17px;" class="fas fa-user-cog">Thay đổi thông tin tài khoản !</i>
                    <br>
                    <br>
                    <label for=""> <strong>Old password</strong> </label>
                    <input type="password" class="form-control" name="oldpass" id="" placeholder="">
                    <br>
                    <label for=""> <strong>New password</strong> </label>
                    <input type="password" class="form-control" name="newpass" id="" placeholder="">
                    <br>
                    <button style="margin-left: 65%;width: 125px;" type="submit" class="btn btn-outline-primary">Submit</button>
                </div>
                </form>
            @endif


        </div>


    </div>
    <div class="modal fade" id="modelId" tabindex="-1" role="dialog" style="width: 1300px;" aria-labelledby="modelTitleId" aria-hidden="true">
        <div style="max-width: 1000px;;" class="modal-dialog" role="document">
            <div class="modal-content">
                <div style="background-color: black; color: blanchedalmond;" class="modal-header">
                    <h5 class="modal-title">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span style="color: white;" aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div style="max-width: 1000px;padding:0 0 0 0;" class="modal-body">
                    <img id="model-img" style="width: 100%;height: 700px;" src="" alt="xx" srcset="">
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div> -->
            </div>
        </div>
    </div>
    <!--modelx-->
    <style>

        /* The Modal (background) */
        .modalChangeA {
          display: none; /* Hidden by default */
          position: fixed; /* Stay in place */
          z-index: 1; /* Sit on top */
          padding-top: 100px; /* Location of the box */
          left: 0;
          top: 0;
          width: 100%; /* Full width */
          height: 100%; /* Full height */
          overflow: auto; /* Enable scroll if needed */
          background-color: rgb(0,0,0); /* Fallback color */
          background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modalChangeA-content {
          background-color: #fefefe;
          margin: auto;
          padding: 20px;
          border: 1px solid #888;
          width: 40%;
        }

        /* The Close Button */
        .close {
          color: #aaaaaa;
          float: right;
          font-size: 28px;
          font-weight: bold;
        }

        .close:hover,
        .close:focus {
          color: #000;
          text-decoration: none;
          cursor: pointer;
        }
    </style>
    <div id="modalChangeA" class="modalChangeA">

        <!-- Modal content -->
        <div class="modalChangeA-content">
            <span id="CmodalChangeA" class="close">&times;</span>
            <h3>Thay đổi ảnh đại diện</h3>

            <p>Thay đổi ảnh đại diện</p>
            <form action="/FLRV-CH/profile/changeAvt" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" id="file" accept="image/png, image/jpeg, image/jpg">

                <br>
                <div class="file-upload-content">
                    <img style="width: 100px; height: 100px; border: 1px solid gray;" class="file-upload-image" src="#" alt="your image" />
                    <div class="image-title-wrap"></div>
                </div>
                <br><br>
                <div class="btn-group" role="group" aria-label="">
                    <button type="submit" id="save" class="btn btn-outline-primary">save</button>
                </div>
            </form>

        </div>

    </div>
    <script>

        $('#chanA').click(function (e) {
            e.preventDefault();
            $('#modalChangeA').css('display', 'block');
        });
        $('#CmodalChangeA').click(function (e) {
            e.preventDefault();
            $('#modalChangeA').css('display', 'none');
        });
        $('.file-upload-content').hide();

            var uploadField = document.getElementById("file");

            uploadField.onchange = function() {
                // alert('sdfs');
                if (this.files[0].size > 8388608) {
                    alert("File is too big!");
                    this.value = "";
                    $('.file-upload-content').hide();
                } else {
                    alert('allow')
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.image-upload-wrap').hide();

                        $('.file-upload-image').attr('src', e.target.result);
                        $('.file-upload-content').show();

                        $('.image-title').html(uploadField.files[0].name);
                    };

                    reader.readAsDataURL(uploadField.files[0]);
                }
            };


    </script>
</body>

</html>
@endsection
