@extends('CS.master') @section('content')


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
    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
    </script>
</head>

<body>

    <br>
    <br>
    <br>
    <div class="row">
        <div class="col-md-10" style="padding: 0 0 0 0;">
            <div class="row">
                <div style="padding: 0 0 0 0;" class="col-md-3 column-1">
                    @foreach ($bv as $item) @if ($item->IDBV%4==0)
                    <div id="box">
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
                            <h4> <a href="/FLRV-CH/profile/{{ $item->IDND }}"><img style="width: 45px;" src="{{ $item->account->Avt }}" alt=""> {{ $item->account->name }}</a> </h4>
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
    </style>
    <script>
        $(document).ready(function() {
            $offs = 1;
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
                                        '<h4><a href="/FLRV-CH/profile/'+value.IDND+'"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-1").append($add);
                                } else if (index % 4 == 1) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/'+value.IDND+'"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-2").append($add);
                                } else if (index % 4 == 2) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/'+value.IDND+'"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-3").append($add);
                                } else if (index % 4 == 3) {
                                    $add = '<div id="box">' +
                                        '<img src="' + value.Img + '" alt="">' +
                                        '<div class="carousel-captionx d-none d-md-block">' +
                                        '<h4><a href="/FLRV-CH/profile/'+value.IDND+'"><img style="width: 45px;" src="' + value.Avt + '" alt=""> ' + value.name + '</a></h4>' +
                                        '<p>' + value.Content + '</p></div></div>';
                                    $(".column-4").append($add);
                                }
                            });

                        }
                    });
                }
            });
        });
    </script>
</body>

</html>
@endsection
