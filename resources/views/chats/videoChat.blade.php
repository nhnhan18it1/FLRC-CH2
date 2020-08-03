<!doctype html>
<html lang="en">

<head>
    <title>Chat</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/chat/chats.css">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/2.3.0/socket.io.js"></script>
    <script src="http://192.168.61.33:8888/FLRV-CH/local/server_node/public/bundle.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    <script>
        $(document).ready(function() {
            //const socket = io('http://192.168.1.21:3000');
            $('#btnConnect').click(function(e) {
                e.preventDefault();
                console.log('sadas')
            });
        });
        function infor(){
            obj={
                IDND: {{session()->get('ID')}},
                Name: "{{ session()->get('Name') }}",
                Avt: "{{ session()->get('Avt') }}",
            }
            //console.log(obj)
            return obj;
        }

    </script>
    {{--  @if (session('$IDNN'))
    <input type="hidden" name="IDNN" value="{{ session()->get('IDNN') }}">
    @else
    <input type="hidden" name="IDNN" value="0">
    @endif  --}}
    <input type="hidden" name="IDNN" id="IDNN" value="{{ session()->get('IDNG') }}">
    <div style="position: relative;border: 2px solid gray;">
        <video id="friendstream"  width="1900px" style="height: 550px;" controls></video>
        <video id="localstream"  style="position: fixed;top: 15%;right: 0;" width="200" controls></video>
    </div>


    {{--  <br> myconnect Tk  --}}
    {{--  <textarea name="" id="txtMySignal" cols="30" rows="10"></textarea>  --}}
    <br>
    <div style="width: 100%;background-color: white;">
        <div style="margin: auto;left: 40%;width: 550px;;" class="btn-group" role="group" aria-label="">
            <button type="button" style="width: 100px;height: 50px;" class="btn btn-outline-primary"><i class="fas fa-microphone-alt"></i></button>
            <a href="#" style="width: 100px;height: 50px;" class="btn btn-primary active" role="button" disabled></a>
            <button type="button" style="width: 100px;height: 50px;" class="btn btn-outline-danger" onclick="window.location='/FLRV-CH/cs'"><i class="fas fa-phone-slash"></i></button>
        </div>
    </div>

    {{--  <input type="text" id="txtFriendSignal">  --}}
    <br>
    {{--  <button type="button" id="btnConnect" class="btn btn-primary">Connect</button>  --}}
</body>

</html>
