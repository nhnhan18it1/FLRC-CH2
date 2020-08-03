<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>

<head>
    <title>Chat</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/chats/chats.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>


    <script>
        var socket = io('https://nhandz.herokuapp.com/');
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        function YCVC() {
            AcceptCall($('#IDR').val())
            socket.emit('video-call-rq',{IDND:$('#IDR').val(),IDNG:{{ session()->get('ID') }},Name:"{{ session()->get('Name') }}",Avt:'{{ session()->get('Avt') }}',Token:0})
            $('#callModel').css('display', 'block');
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

        function closeB() {
            $('#callModel').css('display', 'none');
        }
        //alert("ID:{{ session()->get('ID') }}")
        function LoadMess($ID,$node) {
            //console.log($ID)
            $('#rece').scrollTop(9999);
            $('#kchat').css('display', 'block');
            $('#Avtr').attr('src', ""+$($node.parents(".ccx").find('.Avtx')).attr('src')+"");
            $('#nameR').text($($node.parents(".ccx").find('a')).html())
            $('#IDR').val($ID);
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/postMess",
                data: {
                    data1: $ID
                },
                dataType: "json",
                success: function(data) {

                    $add = "";
                    $.each(data, function(key, value) {

                        if (value.IDsend == {{ session()->get('ID') }}) {
                            $add = $add + '<div class="d-flex justify-content-end mb-4"><div class="img_cont_msg"><img style="width: 50px;height: 50px;;border-radius: 100%;" src="{{ session()->get("Avt") }}">' +
                                '</div><div class="msg_cotainer">' + value.content + '<span class="msg_time">' + value.created_at + '</span></div></div>';
                        } else {
                            $add = $add + '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img style="width: 50px;height: 50px;;border-radius: 100%;" src="'+$($node.parents().find('.Avtx')).attr('src')+'">' +
                                '</div><div class="msg_cotainer">' + value.content + '<span class="msg_time">' + value.created_at + '</span></div></div>';
                        }


                    });
                    $('#rece').html($add);
                }
            });
        }
        function senMss() {

            $.ajax({
                type: "post",
                url: "sendmess",
                data: "data",
                dataType: "json",
                success: function (response) {

                }
            });
        }
        $(document).ready(function() {

            socket.emit('client-send-ID', {
                IDND: {{session()->get('ID')}},
                Name: "{{ session()->get('Name') }}",
                Avt: '{{ session()->get('Avt') }}',
            });

            socket.on('server-as-rqv',function(data){
                console.log(data)
                if(data.rq===true){
                    $.ajax({
                        type: "post",
                        url: "/FLRV-CH/pChat/saveIDNN",
                        data: {
                            IDNN:data.IDNG,
                        },
                        dataType: "json",
                        success: function (response) {
                            window.location="/FLRV-CH/pChat/videochat#1";
                        }
                    });
                    window.location="/FLRV-CH/pChat/videochat#1";
                }
                else{
                    $('#callModel').css('display', 'none');
                    alert('Cuộc gọi bị từ chối');
                }
            })
            socket.on('server-send-rqvideo',function(data){
                console.log(data)
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
            $('.btn-outline-danger').click(function(e) {

                console.log($(this).text());


            });
            socket.on('server-send-listus', function(data) {
                $add = '';
                $.each(data, function(key, value) {
                    if (value.IDND != {{ session()->get('ID') }}) {
                        $add = $add +
                            "<li class='ccx'><div class='d-flex bd-highlight'><div class='img_cont'>" +
                            "<img src='"+value.Avt+"' class='rounded-circle user_img Avtx'>" +
                            '<span class="online_icon online"></span></div>' +

                            '<div class="user_info">' +
                            '<span><a class="xname" onclick="LoadMess(' + value.IDND + ',$(this))" href="javascript:void(0)">' + value.Name + '</a> </span>' +
                            '<p>Taherah left 7 mins ago</p></div></div></li>';
                    }
                });
                $('#listus').html($add);
            })
            $('#btnsend').click(function(e) {
                if ($('#content').val() != "") {
                    if ($('#IDR').val() == 0) {

                    } else {
                        var obj = {
                            ID: ' '+{{ session()->get("ID") }}+' ',
                            IDR: ' '+$('#IDR').val()+' ',
                            Name: '{{ session()->get("Name") }}',
                            Content: $('#content').val()
                        };
                        //console.log(obj);
                    UpLoadM(obj)
                    socket.emit('Client-send-messagePP', obj);
                    $add = '<div class="d-flex justify-content-end mb-4"><div class="img_cont_msg"><img src="{{ session()->get("Avt") }}" class="rounded-circle user_img_msg">' +
                        '</div><div class="msg_cotainer">' + $('#content').val() + '<span class="msg_time">9:12 AM, Today</span></div></div>';
                    $('#rece').append($add);
                    $('#content').val("");
                    $('#rece').scrollTop(9999);
                    }

                }

            });

            socket.on('Server-send-messagePP', function(data) {

                $add = '<div class="d-flex justify-content-start mb-4"><div class="img_cont_msg"><img src="'+$('#Avtr').attr('src')+'" class="rounded-circle user_img_msg">' +
                    '</div><div class="msg_cotainer">' + data.Content + '<span class="msg_time">9:12 AM, Today</span></div></div>';
                $('#rece').append($add);
                $('#rece').scrollTop(9999);

            })
            $("#searchIP").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#listus li ").filter(function() {
                  $(this).toggle($(this).find(".user_info").find("span").text().toLowerCase().indexOf(value) > -1)

                });
              });

            $(document).ajaxComplete(function() {

            });



            $('#action_menu_btn').click(function() {
                $('.action_menu').toggle();
            });
        });
        function UpLoadM($objC) {
            $.ajax({
                type: "post",
                url: "/FLRV-CH/cs/saveMess",
                data: {
                    data1:JSON.stringify($objC),
                },
                dataType: "json",
                success: function (response) {
                    console.log(response);
                }
            });
         }
    </script>
</head>
<body>
    <style>

            /* The Modal (background) */
            a{
                text-decoration: none;
                color: black;
            }
            a:hover{
                text-decoration: none;
                color: black;
            }
            #rece{
                max-height: 315px;
                height: 315px;
                overflow-y: auto;
            }
            #kchat{
                display: none;
            }
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
                <p>đang đợi chấp nhận</p>
                <span><img id="avtCall" src="/FLRV-CH/local/public/assets/img/avatar/avt0.jpg" style="width: 50px;height: 50px;border: 1.2px solid gray;border-radius: 100%;margin-right: 5px;" alt=""><strong id="nameCall">nhan dz</strong></span>
                <br><br>
                <div class="btn-group" style="width: 100%;" role="group" aria-label="">
                    {{--  <button type="button" style="width: 49%;" id="acceptC" class="btn btn-outline-primary "><i class="fas fa-phone-square"></i></button>  --}}
                    <button type="button"  id="deniC" onclick="closeB()" class="btn btn-outline-danger btn-block"><i class="fas fa-phone-slash"></i></button>
                </div>
            </div>

    </div>

    <div class="container-fluid h-100">
        <div class="row justify-content-center h-100">
            <div class="col-md-4 col-xl-3 chat">
                <div class="card mb-sm-3 mb-md-0 contacts_card">
                    <div class="card-header">
                        <div class="input-group">
                            <img style="width: 45px;height: 45px; border-radius: 100%;padding-right: 10x;border: 1px solid white;" src="{{ session()->get('Avt') }}" alt="">
                            <input id="searchIP" type="text" placeholder="Search..." name="" class="form-control search">
                            <div class="input-group-prepend">
                                <span class="input-group-text search_btn"><i class="fas fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body contacts_body">
                        <ui id="listus" class="contacts">
                            <li class="active">
                                <div class="d-flex bd-highlight">
                                    <div class="img_cont">
                                        <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                                        <span class="online_icon"></span>
                                    </div>
                                    <div class="user_info">
                                        <span>Khalid</span>
                                        <p>Kalid is online</p>
                                    </div>
                                </div>
                            </li>

                        </ui>
                    </div>
                    <div class="card-footer"></div>
                </div>
            </div>
            <div class="col-md-8 col-xl-6 chat">
                <div id="kchat" class="card">
                    <div class="card-header msg_head">
                        <div class="d-flex bd-highlight">
                            <div class="img_cont">
                            <input id="IDR" style="width: 70px;;" type="hidden" value="0">
                                <img id="Avtr" src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img">
                                <span class="online_icon"></span>
                            </div>
                            <div class="user_info">
                                <span id="nameR">Chat with Khalid</span>
                                <p>1767 Messages</p>
                            </div>
                            <div class="video_cam">
                                <span><button type="button" onclick="YCVC()" class="btn btn-primary"><i class="fas fa-video"></i></button></span>
                                <span><i class="fas fa-phone"></i></span>
                            </div>
                        </div>
                        <span id="action_menu_btn"><i class="fas fa-ellipsis-v"></i></span>
                        <div class="action_menu">
                            <ul>
                                <li><i  class="fas fa-user-circle"></i> View profile</li>
                                <li><i class="fas fa-users"></i> Add to close friends</li>
                                <li><i class="fas fa-plus"></i> Add to group</li>
                                <li><i class="fas fa-ban"></i> Block</li>
                            </ul>
                        </div>
                    </div>
                    <div id="rece" class="card-body msg_card_body">
                        {{--
                        <div class="d-flex justify-content-end mb-4">
                            <div class="msg_cotainer_send">
                                Ok, thank you have a good day
                                <span class="msg_time_send">9:10 AM, Today</span>
                            </div>
                            <div class="img_cont_msg">
                                <img src="/FLRV-CH/local/public/assets/img/newi/abc1.jpeg" class="rounded-circle user_img_msg">
                            </div>
                        </div> --}} {{--
                        <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                Bye, see you
                                <span class="msg_time">9:12 AM, Today</span>
                            </div>
                        </div> --}} {{-- @foreach ($mess ?? '' as $item)
                        <div class="d-flex justify-content-start mb-4">
                            <div class="img_cont_msg">
                                <img src="https://static.turbosquid.com/Preview/001292/481/WV/_D.jpg" class="rounded-circle user_img_msg">
                            </div>
                            <div class="msg_cotainer">
                                {{ $item }}
                                <span class="msg_time">9:12 AM, Today</span>
                            </div>
                        </div>
                        @endforeach --}}
                    </div>
                    <div class="card-footer">
                        <form action="" method="post">
                            {{ csrf_field() }}
                            <div class="input-group">
                                <div class="input-group-append">
                                    <span class="input-group-text attach_btn"><i class="fas fa-paperclip"></i></span>
                                </div>
                                <textarea name="massage" id="content" class="form-control type_msg" placeholder="Type your message..."></textarea>
                                <div class="input-group-append">
                                    <button type="button" id="btnsend" class="input-group-text send_btn"><i class="fas fa-location-arrow"></i></button>


                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
    </script>
</body>

</html>
