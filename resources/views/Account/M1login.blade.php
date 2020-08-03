<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <base href="{{asset('')}}">
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <style>
        body {
            overflow-x: hidden;
            overflow-y: hidden;
        }

        #left {
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
        }

        #left .box {
            position: relative;
            width: 290px;
            height: 290px;
            background: white;
            border: 1px solid black;
            margin-left: 10px;
            margin-top: 8px;
            box-sizing: border-box;
            display: inline-block;

        }

        #left .box .imgBox {
            position: relative;
            overflow: hidden;
            background-color: black;
        }

        #left .box .imgBox img {
            max-width: 100%;

            max-height: 100%;
            height: 290px;
            width: 290px;
            transition: all 2s;
        }

        #left .box:hover .imgBox img {
            transform: scale(1.2);
        }

        #left .box .details {
            position: absolute;
            top: 10px;
            left: 15px;
            bottom: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.747);
            transform: scaleY(0);
            transition: all 0.5s;
        }

        #left .box:hover .details {
            transform: scaleY(1);
        }

        #left .box .details .content {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            text-align: center;
            padding: 15px;
            color: #fff;
        }

        #btnsub button {
            margin: auto;
            margin-left: 55px;
        }
        @media screen and (max-width: 450px) {
            html{
                overflow: auto;
            }
            #left{
                display: block;
            }
            #left{
                width: 100%
            }
            #qb{
                margin: 1px 18px 10px 18px;
            }
            #left .box{
                width: 100%;
            }
            #left .box .imgBox {
                padding-left: 10%;
            }
        }
    </style>
    <script>
        $(document).ready(function() {
            if($(window).width()>480){
                $('#left').css('height', $(window).height());
                $('#right').css('height', $(window).height());
            }

        });
    </script>
</head>

<body>
    <div class="row">
        <div id="left"
            style="margin: 0 0 0 0;;background-color: black;;"
            {{--  background-image: linear-gradient(120deg,rgb(53, 53, 226),rgb(74, 77, 65),rgb(243, 83, 195)  --}}
            class="col-md-6 colun-1">
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/12.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/11.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/10.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/9.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/8.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/6.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/7.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/8.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="box">
                <div class="imgBox"><img src="/public/assets/img/intro/9.jpg" alt="" srcset=""></div>
                <div class="details">
                    <div class="content">
                        <h2 style="color: yellowgreen;">nhanpro</h2>
                        <p>
                            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                            Obcaecati consequuntur dolorem repellat illum,
                            non consectetur labore unde aliquam optio rem natus, illo fugiat qui,
                            ullam excepturi quis harum sed laborum.
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!--xxxxxxxx----------------------------------------------------------------------------------xxxxxx-->

        <div style="margin: 0 0 0 0;padding: 0 0 0 0;" class="col-md-6 column-2">
            <form method="POST" action="{{ route('login') }}" style="margin: auto;padding: 18px 15px 0px 5px;border-bottom: 2px solid blue;background-color: whitesmoke;">
                <div class="form-group">
                    @csrf
                    <div style="margin: 0 0 0 0;padding: 0 0 0 0;" class="row">
                        <div class="col-md-4 colun-1">
                            <input type="text" name="username" id="" class="form-control" placeholder="Tài khoản"
                                aria-describedby="helpId">

                        </div>
                        <div class="col-md-4 colun-2">
                            <input type="password" name="password" id="" class="form-control" placeholder="Mật khẩu"
                                aria-describedby="helpId">

                        </div>
                        <div  class="col-md-4 colun-3">
                            <button type="submit" class="btn btn-primary btn-block">Đăng nhập</button>

                        </div>
                    </div>
                </div>
                @if(count($errors)>0)
                @foreach ($errors->all() as $error)
                    <div class="alert alert-danger" role="alert">
                    <strong>{{$error}}</strong>
                    </div>
                @endforeach
                @endif
                @if (session('thongbao'))
                <div class="alert alert-danger" role="alert">
                    <strong>{{session('thongbao')}}</strong>
                    </div>
                @endif
            </form>
            <div class="row">
                <div style="margin: 0 0 0 0;padding: 0 0 0 0;" class="col-md-3 column-1">

                </div>
                <div id="qb" class="col-md-6 column-2">
                    <br>
                    <br><br><br><br><br><br><br>
                    <img style="display: block;" src="/public/assets/img/logo.png" alt="" srcset="">
                    <p style="font-size: 25px;"><b>Hóng biến toàn thế giới!! <br> Xem Điều gì đang xảy ra trên thế giới!!</b></p>
                    <a name="" id="" class="btn btn-danger btn-block" href="account/login" role="button">Đăng nhập</a>
                    <a name="" id="" class="btn btn-outline-primary btn-block" href="account/signup" role="button">Đăng kí</a>
                </div>
                <div style="margin: 0 0 0 0;padding: 0 0 0 0;" class="col-md-3 column-3">

                </div>
            </div>
        </div>
    </div>
</body>

</html>
