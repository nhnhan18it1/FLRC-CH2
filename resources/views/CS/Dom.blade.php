<base href="{{asset('')}}">
<?php
require("../FLRV-CH/local/public/Dom/simple_html_dom.php");
$html=file_get_html("https://www.pexels.com/search/galaxy/");
$anh=$html->find(".photo-item__img");
$z=0;
foreach($anh as $t){
    //file_put_contents('../FLRV-CH/local/public/assets/img/newi/abc'.$z.'.jpeg',file_get_contents($t->src));


}


?>
<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <base href="{{asset('')}}">
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/baiviet/he.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
        </script>
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <!--  <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.4.0.min.js"></script>  -->




</head>

<body>
    <nav id="mn" class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#collapsibleNavId"
            aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav mt-2 mt-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item my-2 my-lg-0">
                    <button id="helo" type="button" class="btn btn-outline-primary dropdown-item">Hello</button>
                    <!-- <a class="nav-link" href="#">Link</a> -->
                </li>

            </ul>
            <form class="form-inline mx-auto mr-auto  my-2 ">
                <!-- my-lg-0 -->
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
            <ul style="float: right;" class="navbar-nav .mx-auto">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu" aria-labelledby="dropdownId">
                        <a class="dropdown-item" href="#">logout</a>

                    </div>
                </li>

            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col-md-2 column-1">

        </div>
        <div class="col-md-5 column-2">
            <br><br><br>
            @foreach ($anh as $t)
            <div  class="card">
                <div class="card-header">
                    Header
                </div>
                <div style="padding:0px 0px 0px 0px;" class="card-body">
                    <h4 class="card-title">Title</h4>
                    <p class="card-text">{{ basename($t->src) }}</p>
                    <img src="{{$t->src}}" alt="">
                </div>
                <div class="card-footer text-muted">
                    Footer
                </div>
            </div>
            @php

            @endphp
            @endforeach


        </div>
        <div class="col-md-3 column-3">

        </div>

    </div>
    <div class="back-to-top">
        <i class="fas fa-chevron-circle-up"></i>
    </div>
    <script>
        $(document).ready(function () {
            $(window).scroll(function () {
                var oldva = 0;
                var pos_body = $("html,body").scrollTop();
                if (pos_body > 1200) {
                    $('.back-to-top').addClass('hien-ra');

                }
                else {
                    $('.back-to-top').removeClass('hien-ra');

                }

            });
            $('.back-to-top').click(function (event) {
                $('html,body').animate({ scrollTop: 0 }, 1400);
            });
        });

    </script>
</body>

</html>

