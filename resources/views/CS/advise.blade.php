@extends('CS.master') @section('content') @include('CS.menu_left')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
</head>

<body>

    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
    </script>
    <div class="row">
        <div class="col-md-2">

        </div>
        <div class="col-md-8" style="padding: 0 0 0 0;">
            <div id="adviseF" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#adviseF" data-slide-to="0" class="active"></li>
                    <li data-target="#adviseF" data-slide-to="1"></li>
                    <li data-target="#adviseF" data-slide-to="2"></li>
                </ol>
                <div id="dsFriend" class="carousel-inner" role="listbox">
                    <div class="carousel-item active">
                        <!-- <img src="holder.js/900x500/auto/#777:#555/text:First slide" alt="First slide"> -->
                        <div class="card-deck">
                            @foreach ($LAdvise as $item)
                            <div class="card">
                                <img style="height: 125px;" class="card-img-top" src="{{ $item->Avt }}" alt="">
                                <div class="card-body">
                                    <h4 style="text-align: center;" class="card-title"> <a  href="/FLRV-CH/profile/{{ $item->ID }}">{{ $item->name }}</a> </h4>
                                    <p style="text-align: center;" class="card-text"><button type="button" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i>Add friend</button></p>
                                </div>
                            </div>
                            @endforeach

                            {{--  <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>  --}}
                            {{--  <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>  --}}
                            {{--  <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>  --}}
                        </div>
                    </div>
                    {{--  <div class="carousel-item">
                        <div class="card-deck">
                            <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">2</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>
                            <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>
                            <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>
                            <div class="card">
                                <img class="card-img-top" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" alt="">
                                <div class="card-body">
                                    <h4 class="card-title">Title</h4>
                                    <p class="card-text">Text</p>
                                </div>
                            </div>
                        </div>
                    </div>  --}}

                </div>
                <a id="prev-b" class="carousel-control-prev" href="#adviseF" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a id="next-b" class="carousel-control-next" href="#adviseF" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
                <style>
                    #prev-b,#next-b{
                        width: 30px;
                        background-color: black;
                    }
                </style>
            </div>
        </div>
    </div>
    <hr>
    <div class="row ">
        <div style="padding: 0 0 0 0; " class="col-md-2 ">

        </div>
        <div class="col-md-8 " style="padding: 0 0 0 0; ">
            <div class="row ">
                <div style="padding: 0 0 0 0; " class="col-md-3 column-1 ">
                    @foreach ($bv as $item) @if ($item->IDBV%4==0)
                    <div id="box ">
                        <img src="{{ $item->Img }}" alt="">
                        <div class="carousel-captionx d-none d-md-block">
                            <h4> <a href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 45px;" src="{{ $item->account->Avt }}" alt=""> {{ $item->account->name }}</a> </h4>
                            <p>{{ $item->Content }}</p>
                        </div>
                    </div>
                    @endif @endforeach

                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-2">
                    @foreach ($bv as $item) @if ($item->IDBV%4==1)
                    <div id="box">
                        <img src="{{ $item->Img }}" alt="">
                        <div class="carousel-captionx d-none d-md-block">
                            <h4> <a href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 45px;" src="{{ $item->account->Avt }}" alt=""> {{ $item->account->name }}</a> </h4>
                            <p>{{ $item->Content }}</p>
                        </div>
                    </div> @endif @endforeach
                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-3">
                    @foreach ($bv as $item) @if ($item->IDBV%4==2)
                    <div id="box">
                        <img src="{{ $item->Img }}" alt="">
                        <div class="carousel-captionx d-none d-md-block">
                            <h4> <a href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 45px;" src="{{ $item->account->Avt }}" alt=""> {{ $item->account->name }}</a> </h4>
                            <p>{{ $item->Content }}</p>
                        </div>
                    </div> @endif @endforeach
                </div>
                <div style="padding: 0 0 0 0;" class="col-md-3 column-4">
                    @foreach ($bv as $item) @if ($item->IDBV%4==3)
                    <div id="box">
                        <img src="{{ $item->Img }}" alt="">
                        <div class="carousel-captionx d-none d-md-block">
                            <h4 > <a href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 45px;" src="{{ $item->account->Avt }}" alt=""> {{ $item->account->name }}</a> </h4>
                            <p>{{ $item->Content }}</p>
                        </div>
                    </div> @endif @endforeach
                </div>
            </div>
        </div>
    </div>
    <style>
        .carousel-captionx {
            width: 100%;
            height: 35%;
            bottom: 0;
            left: 0;
            padding-left: 10px;
            background-color: rgba(0, 0, 0, 0.26);
            color: white;
            position: absolute;
            transition: all-in-ease 1.5s;
            opacity: 0;
        }

        #box:hover .carousel-captionx {
            opacity: 1;
        }

        .row {
            margin: 0 0 0 0;
        }

        #box {
            position: relative;
        }

        .carousel-captionx img {
            width: 45px;
            height: 45px;
            border-radius: 100%;
        }

        .column-1 img,
        .column-2 img,
        .column-3 img,
        .column-4 img {
            width: 100%;
            padding-top: 1px;
            padding-left: 1px;
            transition: all-in-ease 0.8s;
            position: relative;
        }

        .column-1 span,
        .column-2 span,
        .column-3 span,
        .column-4 span {
            color: white;
            background-color: black;
            position: absolute;
            left: 0;
            bottom: 0;
        }

        .column-1,
        .column-2,
        .column-3,
        .column-4 {
            padding-left: 1px;
            ;
        }
        .card-deck a{
            text-align: center;
            color: black;
            text-decoration: none;
        }
        .card-deck a:hover{
            color: black;
            text-decoration: none;
        }
    </style>
    <script>
        $(document).ready(function() {
            $offs = 1;
            $offsFr=1;
            $(window).scroll(function() {
                if ($(window).scrollTop() % 100 == 0) {
                    //$(window).unbind('scroll');
                    //alert($(window).height()); //> $(document).height() - 100
                    $.ajax({
                        type: "post",
                        url: "/FLRV-CH/gallary/loadImg",
                        data: {
                            offset: $offs,
                        },
                        dataType: "json",
                        success: function(data) {
                            $offs++;
                            console.log(data)
                            $.each(data, function(index, value) {
                                if (index % 4 == 0) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/' + value.IDND + '"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-1").append($add);
                                } else if (index % 4 == 1) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/' + value.IDND + '"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-2").append($add);
                                } else if (index % 4 == 2) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/' + value.IDND + '"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-3").append($add);
                                } else if (index % 4 == 3) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/' + value.IDND + '"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-4").append($add);
                                }
                            });

                        }
                    });
                }
            });
            $('#next-b').click(function (e) {
                $.ajax({
                    type: "post",
                    url: "/FLRV-CH/cs/LoadFriend",
                    data: {
                        offset: $offsFr,
                    },
                    dataType: "json",
                    success: function (response) {
                        if(response.length>0){
                            $offsFr++;
                            //console.log(response)
                            $add="";
                            $.each(response, function (key, value) {
                                 $add=$add+'<div class="card">'+
                                '    <img style="height: 125px;" class="card-img-top" src="'+value.Avt+'" alt="">'+
                                '    <div class="card-body">'+
                                '        <h4 style="text-align: center;" class="card-title"> <a  href="/FLRV-CH/profile/'+value.ID+'">'+value.name+'</a> </h4>'+
                                '        <p style="text-align: center;" class="card-text"><button type="button" class="btn btn-outline-primary"><i class="fas fa-user-plus"></i>Add friend</button></p>'+
                                '    </div>'+
                                '</div>';
                            });
                            $add='<div class="carousel-item"><div class="card-deck">'+$add+'</div></div>';
                            $('#dsFriend').append($add);
                        }

                    }
                });
            });
        });
    </script>
</body>

</html>


@endsection
