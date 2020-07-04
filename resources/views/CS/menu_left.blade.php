<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/CS/style.css">
</head>

<body>
    <br>
    <br>
    <br>

    <div class="sidenav">

        <br>
        <br>
        <a href="profile/{{ session()->get('ID') }}"><img style="width: 50px; height: 50px;border-radius: 100%;border: 1px solid white;margin-right: 3px;" src="{{ session()->get('Avt') }}" alt="">{{ session()->get('Name') }}</a>

        <div style="background-image: linear-gradient(blue,green,120deg);border: 1px solid white;"></div>

        <br>
        <a href="#"><i class="far fa-newspaper"> </i>| Bảng tin</a>
        <a href="/FLRV-CH/profile/{{ session()->get('ID') }}"><i class="far fa-id-badge"></i>| Trang cá nhân</a>
        <a href="/FLRV-CH/pChat"><i class="far fa-comment-dots"></i>| Messenger</a>
        <a href="/FLRV-CH/gallary"><i class="fas fa-hand-holding-heart"></i>| Gallary</a>
        {{-- <a href="#">Contact</a> --}}
    </div>
    <div class="content">
        @yield('ct_right')
    </div>

</body>

</html>
