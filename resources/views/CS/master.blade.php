<!doctype html>
<html lang="en">

<head>
    <title>@yield('title')</title>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/baiviet/he.css">
    <style>
        #snackbar {
          visibility: hidden;
          min-width: 250px;
          margin-left: -125px;
          background-color: #333;
          color: #fff;
          text-align: center;
          border-radius: 2px;
          padding: 16px;
          position: fixed;
          z-index: 1;
          left: 50%;
          bottom: 30px;
          font-size: 17px;
        }

        #snackbar.show {
          visibility: visible;
          -webkit-animation: fadein 0.5s, fadeout 0.5s 2.5s;
          animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @-webkit-keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
        }

        @keyframes fadein {
          from {bottom: 0; opacity: 0;}
          to {bottom: 30px; opacity: 1;}
        }

        @-webkit-keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }

        @keyframes fadeout {
          from {bottom: 30px; opacity: 1;}
          to {bottom: 0; opacity: 0;}
        }
        </style>
    <script>
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
        $(document).ready(function() {
            $('.myPopover').popover({
                html: true,
                content: function() {
                    var elementId = $(this).attr("data-popover-content");
                    return $(elementId).html();
                }
            });
            $('#ipSearch').keyup(function (e) {
                $('#rsSearch').css('display', 'BLOCK');
                if($('#ipSearch').val()==""){
                    $('#rsSearch').css('display', 'none');
                    $('#ulrs').html('');
                }
                else{

                    $.ajax({
                        type: "post",
                        url: "/FLRV-CH/cs/search",
                        data: {
                            key:$('#ipSearch').val(),
                        },
                        dataType: "json",
                        success: function (data) {
                            console.log(data.length)
                            if(data.length!=0){
                                $add='';
                                $.each(data, function (index, value) {
                                     $add=$add+'<li class="list-group-item"><a href="/FLRV-CH/profile/'+value.ID+'"><img style="width: 55px;height: 55px;border-radius: 100%;margin-right: 10px;" src="'+value.Avt+'" alt="" ><strong>'+value.name+'</strong></a></li>';
                                });
                                $('#ulrs').html($add);
                            }
                            else{
                                $add='<li class="list-group-item">không tìm thấy "'+$('#ipSearch').val()+'"!!!</li>';
                                $('#ulrs').html($add);

                            }


                        }
                    });
                }


            });
        });
    </script>

</head>

<body>

<!-- -->
    <nav id="mn" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" id="logo" href="/FLRV-CH/cs"><img src="/FLRV-CH/local/public/assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul style="margin-right: 200px;" class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item active">
                    <!-- <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a> -->
                </li>
                <li class="nav-item my-2 my-lg-0">
                    <!-- <button id="helo" type="button" class="btn btn-outline-primary dropdown-item">Hello</button> -->
                    <!-- <a class="nav-link" href="#">Link</a> -->
                </li>

            </ul>
            <form style="position: relative;" class="form-inline mr-auto  my-2 ">
                <!-- my-lg-0 -->
                <input id="ipSearch" class="form-control mr-md-2" style="width: 350px;" type="text" placeholder="Search">
                <button style="margin-left: -10px;" class="btn btn-outline-success my-2 my-sm-0" type="submit"><i class="fas fa-search"></i></button>
                <div id="rsSearch" style="display: none; ">
                    <ul id="ulrs" class="list-group list-group-flush">
                        {{-- <li class="list-group-item"><a href=""><img style="width: 55px;height: 55px;border-radius: 100%;margin-right: 10px;" src="/FLRV-CH/local/public/assets/img/avatar/avt_Nguyen Hai Nhan_41.png" alt="" ><strong>nhandz</strong></a></li> --}}
                        {{-- <li class="list-group-item">Item 1</li>
                        <li class="list-group-item">Item 1</li>
                        <li class="list-group-item">Item 1</li> --}}
                    </ul>
                </div>
            </form>

            <ul style="float: right;padding-right: 150px;" class="navbar-nav .mx-auto">
                <p style="font-size: 25px;">|</p>
                <li class="nav-item dropdown"><button style="border: none;background: none;" type="button" class="nav-link dropdown-toggle" data-target="#adsF" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true" data-placement="bottom"><i style="font-size: 25px;;" class="far fa-user"></i></button>
                    <div id="adsF" style="background-color: rgb(244, 250, 255);width: 340px;max-height: 420px;overflow-x: hidden;overflow-y: auto;padding-right: 5px;padding-left: 2px ;float: left;border: 2px solid gray;"  class="dropdown-menu" aria-labelledby="noID">
                @if (count($adF)!=0)
                @foreach ($adF as $item)
                <td scope="row">
                    <div style="margin-top: 5px;padding-top: 5px;" class="chip">
                        <a href="/FLRV-CH/profile/{{ $item->IDNG }}"><img src="{{ $item->accountG->Avt }}" alt="Person" width="96" height="96"> {{ $item->accountG->name }}</a>


                        <div class="btn-group yc">
                            <button type="button" class="btn btn-success" onclick='acF("{{ $item->accountG->ID }}",$(this))'><i class="far fa-check-circle"></i></button>
                            <button type="button" class="btn btn-secondary" onclick="dnF({{ $item->accountG->ID }},$(this))"><i class="far fa-times-circle"></i></button>

                        </div>
                        <!-- <span class="closebtn" onclick="this.parentElement.style.display='none'">&times;</span> -->
                    </div> <br>
                </td>
                @endforeach
                @else
                <td scope="row">
                    <div style="margin-top: 5px;padding-top: 5px;" class="chip">
                        <img src="/FLRV-CH/local/public/assets/img/icons-search.png" alt="Person" width="96" height="96"> không có yêu cầu nào!!
                </td>
                @endif

                </li>
                {{--  <li class="nav-item active"></li>  --}}

                <li class="nav-item dropdown">
                    <button id="messID" style="border: none;background: none;" type="button" class="nav-link dropdown-toggle" data-target="#listmess" data-toggle="dropdown" aria-haspopup="false" aria-expanded="true"><i style="font-size: 25px;;" class="far fa-comment"></i></button>
                    <!-- <a class="nav-link dropdown-toggle" href="messID" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a> -->
                    <div id="listmess" class="dropdown-menu" style="width: 350px;;" aria-labelledby="messID">
                        @if (count($mess)!=0)
                            @foreach ($mess as $item)
                            <div class="dropdown-item" style="padding: 0 0 0 0;height: 75px;display: inline-block;padding-right: 3px;border: 1.2px solid rgb(218, 215, 215);margin-bottom: 1px;">
                                @if ($item->ID1==session()->get('ID'))
                                <a class="nav-link" href="javascript:void(0)"> <p><img style="width: 45px; height: 45px;border-radius: 100%;margin-right: 8px;" src="{{ $item->account1->Avt }}" alt=""> <strong>{{ $item->account1->name }}</strong><br> <span style="margin-left: 60px;">{{ $item->chats1[0]->content }}</span>  </p> </a>
                                @endif
                                @if ($item->ID2==session()->get('ID'))
                                <a class="nav-link" href="javascript:void(0)"> <p><img style="width: 45px; height: 45px;border-radius: 100%;margin-right: 8px;" src="{{ $item->account1->Avt }}" alt=""> <strong>{{ $item->account2->name }}</strong><br> <span style="margin-left: 60px;">{{ $item->chats2[0]->content }}</span>  </p> </a>
                                @endif

                            </div>
                            @endforeach
                            @else
                            <div class="dropdown-item" style="padding: 0 0 0 0;height: 65px;display: inline-block;padding-right: 3px;border: 1.2px solid rgb(218, 215, 215);margin-bottom: 1px;">
                                <p><img style="width: 50px; height: 50px;border-radius: 100%;margin-right: 8px;" src="/FLRV-CH/local/public/assets/img/message-icon-3357821_960_720.png" alt=""> <strong></strong> Không có thông báo mới</p>
                            </div>
                            @endif
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <button style="border: none;background: none;" type="button" class="nav-link dropdown-toggle" id="noID" data-toggle="dropdown"  data-target="#notifi" aria-haspopup="true"
                    aria-expanded="true">
                    <i style="font-size: 25px;;" class="far fa-bell"></i></button>
                        <div id="notifi" style="background-color: rgb(244, 250, 255);width: 340px;max-height: 420px;overflow-x: hidden;overflow-y: auto;padding-right: 5px;padding-left: 2px ;float: left;border: 2px solid gray;"  class="dropdown-menu" aria-labelledby="noID">
                            @if (count($noti)!=0)
                            @foreach ($noti as $item)
                            <div class="dropdown-item" style="padding: 0 0 0 0;height: 75px;display: inline-block;padding-right: 3px;border: 1.2px solid rgb(218, 215, 215);margin-bottom: 1px;">
                                <a class="nav-link" href="/FLRV-CH/cs/newdetail/{{ $item->IDBV }}"> <p><img style="width: 50px; height: 50px;border-radius: 100%;margin-right: 8px;" src="{{ $item->news->account->Avt }}" alt=""> <strong>{{ $item->news->account->name }}</strong>  da {{ $item->Type }} </p> </a>
                            </div>
                            @endforeach
                            @else
                            <div class="dropdown-item" style="padding: 0 0 0 0;height: 65px;display: inline-block;padding-right: 3px;border: 1.2px solid rgb(218, 215, 215);margin-bottom: 1px;">
                                <p><img style="width: 50px; height: 50px;border-radius: 100%;margin-right: 8px;" src="/FLRV-CH/local/public/assets/img/11132018110326AMtọađàm.jpg" alt=""> <strong></strong> Không có thông báo mới</p>
                            </div>
                            @endif

                        </div>
                </li>

                <p style="font-size:25px;">|</p>
            </ul>
            <ul style="float: right;padding-right: 100px;" class="navbar-nav .mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" data-target="#logout" aria-haspopup="true" aria-expanded="false">{{ session()->get('Name') }}</a>
                    <div id="logout" class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="/FLRV-CH/account/logout"><i class="fas fa-door-open"></i>logout</a>

                    </div>
                </li>

            </ul>
        </div>
    </nav>
    <!-- <br><br><br><br> -->

    <!-- <button type="button" class="btn btn-secondary myPopover" data-toggle="popover" data-placement="bottom"
        data-html="true" title="" data-popover-content='#tt'>Trigger</button> -->
    <table id="listfriend" class="table" style="display: none;">
        <thead>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <tr>



            </tr>
        </tbody>
    </table>
    {{--  <link rel="stylesheet" href="/FLRV-CH/local/public/assets/CS/pop-up-chat.css">  --}}
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/CS/style2.css">
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/CS/box-chat.css">
    <div class="sidenav2">
        <br>
        <br>
        <br>
        <div id="listus">
            <a class="friend" onclick="opc($(this))" style="border: 2px solid rgb(149, 142, 189);border-radius: 5%;" href="javascript:void(0)"><img style="width: 45px; height: 45px;border-radius: 100%;border: 1px solid white;padding-right: 10px" src="/FLRV-CH/local/public/assets/img/newi/abc10.jpeg" alt=""> nhan dz</a>
            <a class="friend" onclick="opc($(this))" style="border: 2px solid rgb(149, 142, 189);border-radius: 5%;" href="javascript:void(0)"><img style="width: 45px; height: 45px;border-radius: 100%;border: 1px solid white;" src="/FLRV-CH/local/public/assets/img/newi/abc10.jpeg" alt=""> nhan dz</a>
        </div>
        <div>
        </div>
    </div>

    <div id="chatview" style="z-index: 1;" class="p1">
        <div id="profile">
        <input type="hidden" id="IDC" value="0">
        <input type="hidden" id="imgAvx" name="" value="xxx">
        <br>
            <img id="imgAv" style="height: 50px;width: 50px;border-radius: 100%;border: 1.5px solid white;" src="/FLRV-CH/local/public/assets/img/logo.png" alt="">
            <div id="close">
                <div class="cy"></div>
                <div class="cx"></div>
            </div>

            <p id="NameC" style="margin-top: 7px;"></p>
            <span>miro@badev@gmail.com</span>
        </div>
        <div id="chat-messages">
            {{-- <label>Thursday 02</label>

            <div class="message" data-toggle="tooltip" data-placement="top" title="xcvsd">
                <div >
                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                </div>

                <div class="bubble">
                    Really cool stuff!
                    <div class="corner"></div>
                    <span>3 min</span>
                </div>
            </div>

            <div class="message right" data-toggle="tooltip" data-placement="top" title="xcvsd">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" />
                <div class="bubble">
                    Can you share a link for the tutorial?
                    <div class="corner"></div>
                    <span>1 min</span>
                </div>
            </div>

            <div class="message">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                <div class="bubble">
                    Yeah, hold on
                    <div class="corner"></div>
                    <span>Now</span>
                </div>
            </div>

            <div class="message right">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/2_copy.jpg" />
                <div class="bubble">
                    Can you share a link for the tutorial?
                    <div class="corner"></div>
                    <span>1 min</span>
                </div>
            </div>

            <div class="message">
                <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/1_copy.jpg" />
                <div class="bubble">
                    Yeah, hold on
                    <div class="corner"></div>
                    <span>Now</span>
                </div>
            </div> --}}

        </div>

        <div id="sendmessage">
            <input id="ipMess" type="text" value="Send message..." />
            <button id="send"></button>
        </div>

    </div>
    <div id="snackbar">Some text some message..</div>

<script>
    function showSn($text) {
        var x = document.getElementById("snackbar");
        $("#snackbar").text($text);
        x.className = "show";

        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>
    <!--model img-->
    <!-- Button trigger modal -->
    <!-- <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#modelId">
  Launch
</button> -->

    <!-- Modal -->
    <style>

        /* The Modal (background) */
        .modalCall {
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
        .modalCall-content {
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
    <div id="callModel" class="modalCall">

        <!-- Modal content -->
        <div class="modalCall-content">
            <h3>Yêu cầu video call</h3>
            {{--  <span id="closeCall" class="close">&times;</span>  --}}
            <p>bạn nhận được cuộc gọi từ nhandz</p>
            <span><img id="avtCall" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" style="width: 50px;height: 50px;border: 1.2px solid gray;border-radius: 100%;margin-right: 5px;" alt=""><strong id="nameCall">nhan dz</strong></span>
            <br><br>
            <div class="btn-group" role="group" aria-label="">
                <button type="button" id="acceptC" class="btn btn-outline-primary"><i class="fas fa-phone-square"></i></button>
                <button type="button" id="deniC" class="btn btn-outline-danger"><i class="fas fa-phone-slash"></i></button>

            </div>
        </div>

    </div>
    <script>
        // Get the modal
        //var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        //var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        //var span = document.getElementsByClassName("close")[0];

        // When the user clicks the button, open the modal
        //btn.onclick = function() {
        //  modal.style.display = "block";
        //}

        // When the user clicks on <span> (x), close the modal
        //span.onclick = function() {
        //  modal.style.display = "none";
        //}

        // When the user clicks anywhere outside of the modal, close it
        $('#closeCall').click(function (e) {
            e.preventDefault();
            $('#callModel').css('display', 'none');
        });


    </script>
    @yield('content')
    <script>
        var socket = io('http://localhost:3000');
        //var socket=io('https://nhandz.herokuapp.com/');
        $(document).ready(function() {
            socket.emit('client-send-ID', {
                IDND: {{session()->get('ID')}},
                Name: "{{ session()->get('Name') }}",
                Avt: "{{ session()->get('Avt') }}",
            });
            acx={IDND: {{session()->get('ID')}},
            Name: "{{ session()->get('Name') }}",
            Avt: '{{ session()->get('Avt') }}',};
            console.log(acx)
            socket.on('server-send-listus', function(data) {
                    $add = '';
                    $.each(data, function(key, value) {
                        if (value.IDND != {{session()-> get('ID')}}) {
                            $add = $add + '<a class="friend" onclick="opc($(this),'+value.IDND+')" style="border: 2px solid rgb(149, 142, 189);border-radius: 5%;" href="javascript:void(0)"><img style="width: 45px; height: 45px;border-radius: 100%;border: 1px solid white;" src="' + value.Avt + '" alt="">' + value.Name + '</a>';
                        }
                    });
                    $('#listus').html($add);
            })
            socket.on('server-send-rqvideo',function(data){
                //console.log(data)
                $('#callModel p').text("Bạn nhận được cuộc gọi từ "+data.Name);
                $('#avtCall').attr('src', data.avt);
                $('#callModel').css('display', 'block');
                $('#acceptC').click(function (e) {
                    //alert('asdas')
                    socket.emit('A-answer-rqv',{rq:true,IDNN:""+data.IDNG+"",IDNG:data.IDND})
                    console.log({rq:true,IDNN:data.IDNG,IDNG:data.IDND})
                    AcceptCall(data.IDNG)
                    window.location="/FLRV-CH/pChat/videochat";

                });
                $('#deniC').click(function (e) {
                    e.preventDefault();
                    socket.emit('A-answer-rqv',{rq:false,IDNN:data.IDNG,IDNG:data.IDND})
                    $('#callModel').css('display', 'none');
                });

            })
            socket.on('server-cmt',function(data){
                showSn(data.NameNG+" đã bình luận về bài viết của bạn!")
                //console.log(data)
                $add='<div class="dropdown-item" style="padding: 0 0 0 0;height: 75px;display: block;padding-right: 3px;border: 1.2px solid rgb(218, 215, 215);margin-bottom: 1px;">'+
                    '<a class="nav-link" href="/FLRV-CH/cs/detail/'+data.IDBV+'"><img style="width: 50px; height: 50px;border-radius: 100%;margin-right: 8px;" src="'+data.AvtNg+'" alt=""> <strong>'+data.NameNG+'</strong>  da binh luan ve bai viet cua ban  </a></div>';
                $('#notifi').prepend($add);
            })
            $('.ipCMT').keypress(function(e) {
                var keycode = (event.keyCode ? event.keyCode : event.which);
                if (keycode == '13') {
                    // console.log();
                    $box = $(this).parents(".card").find('#CMTct');
                    if ($($box).val() != "") {
                        var obj = {
                            IDBV: $(this).parents(".card").find('#IDBV').val(),
                            Content: $($box).val(),
                        }
                        var dataNode={
                            IDBV: $(this).parents(".card").find('#IDBV').val(),
                            IDNN: $(this).parents(".card").find('#IDND').val(),
                            IDNG: " "+{{ session()->get('ID') }}+" ",
                            NameNG: "{{ session()->get('Name') }}",
                            AvtNg: "{{ session()->get('Avt') }}",
                            Content: $($box).val(),
                        }
                        console.log(dataNode)
                        socket.emit('client-cmt',dataNode)
                        $add ='<div class="container">' +
                            '<a href="#"><img src="{{ session()->get("Avt") }}" alt="Avatar">{{ session()->get("Name") }}</a>' +
                            '<p>' + $($box).val() + '<span class="time-right"> 1 phut </p></span></div>';
                        $(this).parents(".card").find('.cmtCT').append($add);
                        $.ajax({
                            type: "post",
                            url: "/FLRV-CH/cs/postCMT",
                            data: {
                                data1: JSON.stringify(obj),
                                data2: JSON.stringify(dataNode),
                            },
                            dataType: "text",
                            success: function(data) {
                                if (data == "success") {
                                    // alert(data)
                                    $add = '<div class="container">' +
                                        '<a href="#"><img src="/FLRV-CH/local/public/assets/img/intro/12.jpg" alt="Avatar"></a>' +
                                        '<p>' + $($box).val() + '</p>' +
                                        '<span class="time-right">11:00</span></div>';
                                    $(this).parents(".card").find('.cmtCT').append('<br> <p>' + $($box).val() + '</p>');
                                    console.log($($box).val())
                                    $($box).val("");;
                                }
                            }
                        });
                    }
                }
            });
            $("#ipMess").keyup(function (e) {
                if (e.keyCode==13) {
                    //chat-messages
                    $('#chat-messages').scrollTop(9999);
                    if ($('#ipMess').val() != "") {
                        if ($('#IDC').val() == 0) {

                        }
                        else {
                            var obj = {
                            ID: ' '+{{ session()->get("ID") }}+' ',
                            IDR: ' '+$('#IDC').val()+' ',
                            Name: '{{ session()->get("Name") }}',
                            Content: $('#ipMess').val()
                        };
                        //console.log(obj);
                        UpLoadM(obj)
                        if(obj.IDR=={{ session()->get('ID') }}){

                        }
                        else{
                            socket.emit('Client-send-messagePP', obj);
                        }
                        //alert($("imgAvx").val())
                        $add ='<div class="message right">'+
                            '<img src="{{ session()->get('Avt') }}" />'+
                            '<div class="bubble">'+
                                $('#ipMess').val()
                                +'<div class="corner"></div>'+
                                '<span>1 min</span></div></div>';
                        $('#chat-messages').append($add);
                        $('#ipMess').val("");
                        }

                    }
                    //alert("asad-"+$('#imgAv').attr("src")+"-"+$('#ipMess').val());
                }
            });
            socket.on('Server-send-messagePP', function(data) {
                console.log(data)
               // console.log($("imgAvx").attr("src"))

                if(data.ID.trim()==""+$('#IDC').attr("value")+""){
                    $add ='<div class="message">'+
                        '<img src="'+$('#imgAv').attr("src")+'" />'+
                        '<div class="bubble">'+
                            data.Content
                            +'<div class="corner"></div>'+
                            '<span>1 min</span></div></div>';
                    $('#chat-messages').append($add);
                }
                else{
                    showSn("ban co tin nhan moi tu "+data.Name+"...."+data.Content);
                }
                $('#chat-messages').scrollTop(9999);


            })

                ///////////////////////////////////////////
            var preloadbg = document.createElement("img");
            preloadbg.src = "https://s3-us-west-2.amazonaws.com/s.cdpn.io/245657/timeline1.png";

            $("#searchfield").focus(function() {
                if ($(this).val() == "Search contacts...") {
                    $(this).val("");
                }
            });
            $("#searchfield").focusout(function() {
                if ($(this).val() == "") {
                    $(this).val("Search contacts...");

                }
            });

            $("#sendmessage input").focus(function() {
                if ($(this).val() == "Send message...") {
                    $(this).val("");
                }
            });
            $("#sendmessage input").focusout(function() {
                if ($(this).val() == "") {
                    $(this).val("Send message...");

                }
            });
            $("#close").click(function (e) {
               $("#IDC").attr("value", 0);
               $("#NameC").text("");
            });
        });

        function acF($id,$node){
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/AsRqF",
                data: {
                    ID:$id,
                    RQ:true,
                },
                dataType: "json",
                success: function (response) {
                    $($node).parents('.chip').css('display','none');
                }
            });
        }
        function dnF($id,$node){
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/AsRqF",
                data: {
                    ID:$id,
                    RQ:false,
                },
                dataType: "json",
                success: function (response) {
                    $($node).parents('.chip').css('display','none');
                }
            });
        }

        function opc($ec,$value){
            $(".friend").each(function() {
                $($ec).click(function() {
                    var childOffset = $($ec).offset();
                    var parentOffset = $($ec).parent().parent().offset();
                    var childTop = childOffset.top - parentOffset.top;
                    var clone = $($ec).find('img').eq(0).clone();
                    var top = childTop + 12 + "px";

                    $(clone).css({
                        'top': top
                    }).addClass("floatingImg").appendTo("#chatbox");

                    setTimeout(function() {
                        $("#profile p").addClass("animate");
                        $("#profile").addClass("animate");
                    }, 100);
                    setTimeout(function() {
                        $("#chat-messages").addClass("animate");
                        $('.cx, .cy').addClass('s1');
                        setTimeout(function() {
                            $('.cx, .cy').addClass('s2');
                        }, 100);
                        setTimeout(function() {
                            $('.cx, .cy').addClass('s3');
                        }, 200);
                    }, 150);

                    $('.floatingImg').animate({
                        'width': "68px",
                        'left': '108px',
                        'top': '20px'
                    }, 200);

                    var name = $($ec).find("p strong").html();
                    var email = $($ec).find("p span").html();
                    $("#profile p").html(name);
                    $("#profile span").html(email);

                    $(".message").not(".right").find("img").attr("src", $(clone).attr("src"));
                    $('#friendslist').fadeOut();
                    $('#chatview').fadeIn();
                    $('#chat-messages').scrollTop(9999);

                    $('#close').unbind("click").click(function() {
                        $("#chat-messages, #profile, #profile p").removeClass("animate");
                        $('.cx, .cy').removeClass("s1 s2 s3");
                        $('.floatingImg').animate({
                            'width': "40px",
                            'top': top,
                            'left': '12px'
                        }, 200, function() {
                            $('.floatingImg').remove()
                        });

                        setTimeout(function() {
                            $('#chatview').fadeOut();
                            $('#friendslist').fadeIn();
                        }, 50);
                        $('#IDC').attr('value', 0);
                        //alert($($ec.find("img")).attr("src"));
                        $("#imgAvx").attr('value', "xxx");
                    });

                });
            });
            $('#IDC').attr('value', $value);
            //alert($($ec.find("img")).attr("src"));
            $("#imgAvx").attr('value', $($ec.find("img")).attr("src"));
            socket.emit("client-require-partner",$value)

            socket.on("server-require-partner",function($data){
                //console.log($data);
                //$("#profile p")
                $("#profile p").text($data.Name);
                $('#imgAv').attr('src', $data.Avt);
                $.ajax({
                    type: "post",
                    url: "/FLRV-CH/cs/postMess",
                    data: {
                        data1:$data.IDND
                    },
                    dataType: "json",
                    success: function (data) {
                        //console.log(data)
                        id={{session()->get('ID')}};
                        avt="{{session()->get("Avt")}}";
                        $add="";
                         $.each(data, function (indexInArray, valueOfElement) {
                             console.log(valueOfElement.IDsend)

                             if (valueOfElement.IDsend == id) {
                                $add=$add+'<div class="message right">'+
                                '<img src="'+avt+'" />'+
                                '<div class="bubble">'+valueOfElement.content+'<div class="corner"></div>'+
                                '<span><br></span></div></div>';
                             }
                             else{
                                $add=$add+'<div class="message">'+
                                '<img src="'+$data.Avt+'" />'+
                                '<div class="bubble">'+valueOfElement.content+'<div class="corner"></div>'+
                                '<span></span></div></div>';
                             }

                        });

                        $("#chat-messages").html($add);

                    }
                });
            })

        }
        function AcceptCall(param) {
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/saveToken",
                data: {
                    IDNG:param
                },
                dataType: "text",
                success: function (data) {

                }
            });
         }
        function UpLoadM($objC) {
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/saveMess",
                data: {
                    data1:JSON.stringify($objC),
                },
                dataType: "json",
                success: function (response) {

                }
            });
         }

         $(document).ajaxComplete(function() {

        });
    </script>
</body>

</html>
