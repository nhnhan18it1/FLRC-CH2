@extends('CS.master') @section('title','home') @extends('CS.menu_left') @section('content') @section('ct_right')



<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
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
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/baiviet/he.css">

    <script>
        // function HienCMT($elm) {
        //     $elm.classList.add("hien");
        //     $elm.classList.remove("an");
        //   }

        $ccmt = 0;
        $(document).ready(function() {
            @if(session('thongbaopost'))
            alert('{{ session('
                thongbaopost ') }}');
            @endif
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

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

            // $.ajax({
            //     type: "get",
            //     url: "cs/news",
            //     data: "",
            //     dataType: "json",
            //     success: function(data) {
            //         console.log(data);
            //         $.each(data, function(key, value) {
            //             console.log(value.Img);
            //             $add = '<div class="card">' +
            //                 '<div class="card-header">' +
            //                 '<input type="hidden" name="IDBV" id="IDBV" value="' + value.IDBV + '">' +
            //                 '<a style="font-size: 25px;font-family: Verdana, Geneva, Tahoma, sans-serif;text-decoration: none;color: black;"' +
            //                 'href="#"><img style="width: 60px;height: 60px;;border-radius: 100%;"' +
            //                 'src="' + value.Img + '" alt="">' + value.name + '</a>' +
            //                 '</div>' +
            //                 '<div style="padding: 0 0 0 0;" class="card-body">' +

            //                 '<p class="card-text">' + value.Content + '</p>' +
            //                 ' <img data-toggle="modal" data-target="#modelId" src="' + value.Img + '" alt=""></div>' +
            //                 '<div class="card-footer text-muted">' +
            //                 '<div class="btn-group">' +
            //                 '<button style="position: relative;" type="button" class="btn btn-outline-danger btn-block"><i style="font-size: 30px;" class="far fa-thumbs-up"></i></button><span class="badge">' + value.CLike + '</span>' +
            //                 '<button id="cmt" type="button" class="btn btn-outline-primary boc"><i style="font-size: 30px;" class="far fa-comment-dots"></i></button></div></div>' +
            //                 '<div id="comment" class="card-footer text-muted comment an">' +
            //                 '<div class="container">' +
            //                 '<a href="#"><img src="/FLRV-CH/local/public/assets/img/intro/12.jpg" alt="Avatar"></a>' +
            //                 '<p>Hello. How are you today?</p>' +
            //                 '<span class="time-right">11:00</span></div></div>' +
            //                 '<div id="Put-comment" class="card-footer text-muted comment an">' +
            //                 '<div class="form-group">' +
            //                 '<input type="text" name="" id="CMTct" class="form-control ipCMT" placeholder="ý kiến của bạn...." aria-describedby="helpId">' +
            //                 '</div></div></div>';


            //             $('#cont').append($add);

            //         });
            //     }
            // });


            $(".boc").click(function() {
                $box = $(this).parents(".card").find('.comment');
                $CMTCT = $(this).parents(".card").find('.cmtCT');
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
                                    '<a href="/FLRV-CH/profile/'+data.IDNBL+'"><img src="'+value.Avt+'" alt="Avatar">'+value.NNBL+'</a>' +
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
                if(pos_body>200){
                    $("#myHeader").css("top", "10%");
                    if (pos_body > 1200) {
                        $('.back-to-top').addClass('hien-ra');

                    } else {
                        $('.back-to-top').removeClass('hien-ra');

                    }
                }
                else{
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
            socket.emit('client-like',{IDBV: $node.find('#IDBV').val(),IDNG:" {{ session()->get('ID') }} ",NameNG:"{{ session()->get('Name') }}",IDND: $node.find('#IDND').val()});

            //console.log($node.find('#IDBV').val())
        }
    </script>
</head>

<body>
    <div class="row">
        <div style="padding: 0 0 0 0;" class="col-md-2 column-1">

        </div>
        <div id="cont" style="padding: 0 0 0 0;" class="col-md-5 column-2">
            <br><br>
            <form action="cs/newbv" method="post" enctype="multipart/form-data">
                @csrf
                <div style="border: 2.5px solid gray;border-radius: 5px;padding-top: 0;background-color: white;" class="form-group">
                    <div class="form-group">

                        <label style="background: gray;display: block;" for=""> <strong><i class="far fa-newspaper"></i> Nội dung bài viết</strong></label>
                        <textarea style="border:none;border-bottom: 1px solid gray;" placeholder="{{ session()->get('Name') }} ơi? Bạn đang nghĩ gì vậy? Hãy chia sẻ cho bạn bè của mình biết đi." class="form-control" required name="content" id="" rows="3"></textarea> |
                        <div class="file-upload-content">
                            <img style="width: 100px; height: 100px; border: 1px solid gray;" class="file-upload-image" src="#" alt="your image" />
                            <div class="image-title-wrap"></div>
                        </div>

                        <div style="margin: 0 0 0 0;border-bottom: 1px solid gray;border-top: 1px solid gray;" class="row">
                            <!-- <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-1 column-3"></div> -->
                            <div style="padding-left: 5px;; margin: 0 0 0 0;padding-top: 8px;" class="col-md-3 column-1">
                                <label class="custom-file">
                                    <input style="display: none;"  type="file" accept="image/png, image/jpeg, image/jpg"  name="fileImg" id="file" placeholder="file cua ban" class="custom-file-input" aria-describedby="fileHelpId">
                                    <span style="border: 1.5px solid gray;padding: 1px 1px 1px 1px; display: inline-block" class="custom-file-control"><i class="far fa-file-image">| Chọn file</i></span>
                                </label>
                            </div>
                            <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-3 column-2"></div>

                            <div style="padding: 0 0 0 0;" class="col-md-3 column-3"></div>
                            <div style="padding: 0 0 0 0;padding-top: 8px;" class="col-md-3 column-4"><button style="float: left; display: inline-block;" type="submit" class="btn btn-outline-secondary btn-block"><i class="far fa-paper-plane">| Đăng bài</i></button></div>
                        </div>

                    </div>

                </div>
            </form>

            <br> @foreach ($rs as $item)
            <div class="card">
                <div class="card-header">
                    <a style="font-size: 25px;font-family: Verdana, Geneva, Tahoma, sans-serif;text-decoration: none;color: black;" href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 60px;height: 60px;;border-radius: 100%;" src='{{ $item->account->Avt }}' alt="">{{ $item->account->name }}</a>
                    <input type="hidden" name="IDBV" id="IDBV" value="{{ $item->IDBV }}">
                    <input type="hidden" name="IDND" id="IDND" value="{{ $item->IDND }}">
                </div>
                <div style="padding: 0 0 0 0;" class="card-body">
                    {{--  <h4 class="card-title">Title</h4>  --}}
                    <p class="card-text">{{ $item->Content }}</p>
                    <img data-toggle="modal" data-target="#modelId" src="{{ $item->Img }}" alt="">
                </div>
                <div class="card-footer text-muted">
                    <div class="btn-group">
                        @php
                        $ck=false;
                        @endphp
                        @foreach ($item->likelist as $item2)
                            @if ($item2->IDNL==session()->get('ID'))
                            @php
                                $ck=true;
                            @endphp

                            @endif
                        @endforeach
                        @if ($ck)
                        <button style="position: relative;" type="button" onclick="like($(this).parents('.card'))" class="btn btn-danger btn-block"><i style="font-size: 30px;" class="far fa-thumbs-up"></i></button><span class="badge clike"> {{ $item->CLike }}</span>
                        @php
                            $ck=false;
                        @endphp
                        @else
                        <button style="position: relative;" type="button" onclick="like($(this).parents('.card'))" class="btn btn-outline-danger btn-block"><i style="font-size: 30px;" class="far fa-thumbs-up"></i></button><span class="badge clike"> {{ $item->CLike }}</span>

                        @endif

                        <button id="cmt" type="button" class="btn btn-outline-primary boc"><i style="font-size: 30px;"
                                    class="far fa-comment-dots"></i></button>

                    </div>

                </div>
                <div id="comment" class="card-footer text-muted cmtCT comment an">
                    <div class="container">
                        <a href="#"><img src="/FLRV-CH/local/public/assets/img/intro/12.jpg" alt="Avatar"></a>
                        <p>Hello. How ay?</p>
                        <span class="time-right">11:00</span>
                    </div>
                </div>
                <div id="Put-comment" class="card-footer text-muted comment an">
                    <div class="form-group">
                        <input type="text" name="" id="CMTct" class="form-control ipCMT" placeholder="ý kiến của bạn...." aria-describedby="helpId"> {{-- <button type="button" class="btn btn-primary">Đăng</button> --}}
                    </div>

                </div>
            </div>
            @endforeach

        </div>
        <div id="new"  style=" margin-left: 5px;;padding: 0 0 0 0;text-align: center;padding-right: -15px;padding-left: 25px;padding-top: 55px; " class="col-md-3 column-3">
            <div id="ads" class="row">
                <div id="myHeader" class="col-md-12 column-1 header" >

                        <div>
                            {{--  <p style="position: absolute;left: 35%;top: 80%;background: rgba(128, 128, 128, 0.253);color: white;">update in the future...</p>  --}}
                            <img style="width: 100%;position: relative;border-radius: 5%;box-shadow: 12px 8px 10px grey ;border: 1px solid red;" src="/FLRV-CH/local/public/assets/img/intro/live.jpg" alt="">
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12 column-1">
                                <div style="max-height: 300px;;box-shadow: 12px 8px 10px grey;border-radius: 5px;border: 1px solid rgba(128, 128, 128, 0.153);background-color: rgba(128, 128, 128, 0.153);padding-top: 2px;">
                                    <div style="display: inline-block; ;width: 100% ;float: left;;display: block;" > <div style="float: left;"> <strong> Bài viết nổi bật...</strong></div>  <span style="float: right;"><a href="/FLRV-CH/gallary">xem tất cả</a> </span></div>
                                    <br>
                                    <div id="carouselId" class="carousel slide" data-ride="carousel">
                                        {{--  <ol class="carousel-indicators">
                                            <li data-target="#carouselId" data-slide-to="0" class="active"></li>
                                            <li data-target="#carouselId" data-slide-to="1"></li>
                                            <li data-target="#carouselId" data-slide-to="2"></li>
                                        </ol>  --}}
                                        <div class="carousel-inner" role="listbox">
                                            @php
                                                $i=0;
                                            @endphp
                                            @foreach ($hotNew as $item)
                                                @if ($i==0)
                                                <div class="carousel-item active">
                                                    <img id="imgBV" src="{{ $item->Img }}" alt="First slide">
                                                    <div class="carousel-captionx d-none d-md-block">
                                                        <h4><img src="{{ $item->account->Avt }}" alt="" >{{ $item->account->name }}</h4>
                                                        <p>{{ $item->Content }}</p>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                                @else
                                                <div class="carousel-item">
                                                        <img id="imgBV" src="{{ $item->Img }}" alt="First slide">
                                                        <div class="carousel-captionx d-none d-md-block">
                                                            <h4><img src="{{ $item->account->Avt }}" alt="" > {{ $item->account->name }}</h4>
                                                            <p>{{ $item->Content }}</p>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach

                                            {{--  <div class="carousel-item">
                                                <img id="imgBV" src="/FLRV-CH/local/public/assets/img/intro/1.jpg" alt="First slide">
                                                <div class="carousel-captionx d-none d-md-block">
                                                   <h4><img src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="" >  Title</h4>
                                                    <p>Description</p>
                                                </div>
                                            </div>
                                            <div class="carousel-item">
                                                <img id="imgBV" src="/FLRV-CH/local/public/assets/img/intro/1.jpg" alt="First slide">
                                                <div class="carousel-captionx d-none d-md-block">
                                                   <h4><img src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="" > Title</h4>
                                                    <p>Description</p>
                                                </div>
                                            </div>  --}}
                                        </div>
                                        <a id="carousel-control-prev" class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a id="carousel-control-next" class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>


                                    </div>
                                </div>

                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12" style="max-height: 250px;" >
                                    <div style="display: inline-block; ;width: 100% ;float: left;;display: block;" > <div style="float: left;"> <strong> Có thể bạn quen biết...</strong></div>  <span style="float: right;"><a href="/FLRV-CH/cs/advise">xem tất cả</a> </span></div>
                                <link rel="stylesheet" href="/FLRV-CH/local/public/assets/slider/css/slider.css">
                                <div class="slider-container">
                                    <div class="slider">
                                        <div class="slider__item">
                                            <img src="/FLRV-CH/local/public/assets/slider/images/1.jpg" alt="">
                                            <span class="slider__caption">Lorem ipsum dolor sit amet, consectetur adipisicing elit.<a href="">Далее >></a> </span>
                                        </div>
                                        <div class="slider__item">
                                            <img src="/FLRV-CH/local/public/assets/slider/images/2.jpg" alt="">
                                            <span class="slider__caption">2 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa, facilis.</span>
                                        </div>
                                        <div class="slider__item">
                                                <img src="/FLRV-CH/local/public/assets/slider/images/3.jpg" alt="">
                                                <span class="slider__caption">3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, culpa!</span>
                                        </div>
                                        <div class="slider__item">
                                            <img src="/FLRV-CH/local/public/assets/slider/images/3.jpg" alt="">
                                            <span class="slider__caption">3 Lorem ipsum dolor sit amet, consectetur adipisicing elit. Suscipit, culpa!</span>
                                        </div>

                                    </div>
                                    <div class="slider__switch slider__switch--prev" data-ikslider-dir="prev">
                                        <span><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20"><path d="M13.89 17.418c.27.272.27.71 0 .98s-.7.27-.968 0l-7.83-7.91c-.268-.27-.268-.706 0-.978l7.83-7.908c.268-.27.7-.27.97 0s.267.71 0 .98L6.75 10l7.14 7.418z"/></svg></span>
                                    </div>
                                    <div class="slider__switch slider__switch--next" data-ikslider-dir="next">
                                        <span><svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 20 20"><path d="M13.25 10L6.11 2.58c-.27-.27-.27-.707 0-.98.267-.27.7-.27.968 0l7.83 7.91c.268.27.268.708 0 .978l-7.83 7.908c-.268.27-.7.27-.97 0s-.267-.707 0-.98L13.25 10z"/></svg></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="alert alert-dark" role="alert" style="bottom: 0;">
                            <strong>Copyright &copy; 2019 By nhanhvh</strong>
                        </div>
                </div>
            </div>
            <br>


        </div>
        <style>
            #myHeader {
                position:fixed;
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

              .sticky + .content {
                padding-top: 102px;
              }
              #imgBV{
                height: 250px;
                  width: 100%;
              }
              .carousel-captionx{
                  color: white;
                  padding:0 0 0 0 ;
                  width: 100%;
                  height: 45%;
                  background-color: rgba(19, 18, 18, 0.573);
                  position: absolute;
                  left: 0;
                  bottom: 0;
                  right: 0%;
                  opacity: 0;
                  transition: all 0.8s;
              }
              .carousel-captionx img{
                  width: 45px;
                  height: 45px;
                  border-radius: 100%;
                  border: 1px solid white;
              }
              .carousel-captionx h4{
                padding-left: 5px;
                text-align: left;
                left: 0%;
                display: block;
              }
              .carousel-captionx p{
                width: 100%;
                padding-left: 5px;
                float: left;
                text-align: left;
              }
              #carouselId :hover .carousel-captionx{
                  opacity: 1;
              }
              #carousel-control-prev{
                width: 5%;
            }
              #carousel-control-next{
                  width: 5%;
              }

        </style>

        <script src="/FLRV-CH/local/public/assets/slider/src/slider.js"></script>
        <script>
                $(".slider-container").ikSlider({
                    speed: 500
                });
                $(".slider-container").on('changeSlide.ikSlider', function(evt) {
                    console.log(evt.currentSlide);
                });
            $(document).ready(function () {
            $(".slider-container").ikSlider({
                speed: 500
            });
            $(".slider-container").on('changeSlide.ikSlider', function(evt) {
                console.log(evt.currentSlide);
            });
            });

        </script>
        <script>
                window.onscroll = function() {myFunction()};

                var header = document.getElementById("myHeader");
                var sticky = header.offsetTop;

                function myFunction() {
                  if (window.pageYOffset > sticky) {
                    header.classList.add("sticky");
                  } else {
                    header.classList.remove("sticky");
                  }
                }
                </script>
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

    <!--End model img-->


    <div class="back-to-top">
        <i class="fas fa-chevron-circle-up"></i>
    </div>
</body>

</html>
@endsection @endsection
