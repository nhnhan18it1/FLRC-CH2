<!--xcvxcv-->
<!DOCTYPE html>
<html lang="en">

<head>
    <title>lnding Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/intro/intro.css">
    <style>
        body {
            position: relative;
        }
    </style>
    <script>
        $(document).ready(function() {

            $('#section1').css('height', $(window).height()).fadeIn();
            $('#section2').css('height', $(window).height()).fadeIn();
            $('#section3').css('height', $(window).height()).fadeIn();
            $('#section4').css('height', $(window).height()).fadeIn();
        });
    </script>
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="50">


    <nav id="menu" class="navbar navbar-expand-md navbar-dark">
        <a class="navbar-brand" id="logo" href="#"><img src="/FLRV-CH/local/public/assets/img/logo.png" alt=""></a>
        <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"><i
                class="fas fa-bars"></i></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul id="left" class="navbar-nav">
                <li class="nav-item active">

                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section1">Mission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section2">About Us</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#section3">Contact</a>
                </li>
                <!-- <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        Section 4
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="#section41">Link 1</a>
                        <a class="dropdown-item" href="#section42">Link 2</a>
                    </div>
                </li> -->
            </ul>
            <!-- <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="text" placeholder="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form> -->
            <ul id="ACC" class="navbar-nav" style="float: right;right: 0;">
                <li class="nav-item">
                    <a name="" id="" class="btn btn-outline-primary btn-block" href="account/" role="button">Đăng
                        nhập</a>

                </li>
                <li class="nav-item">
                    <a name="" id="" class="btn btn-outline-primary btn-block" href="account/signup" role="button">Đăng kí</a>
                </li>
            </ul>
        </div>
    </nav>
    <!---->


    <div id="section1" class="container-fluid" style="padding-top:80px;padding-bottom:70px;height: 780px;;">
        <h1>Mission</h1>
        <div id="container">
            <div id="stage">
                <div id="shape" class="cube backfaces">
                    <div class="plane one"></div>
                    <div class="plane two"></div>
                    <div class="plane three"></div>
                    <div class="plane four"></div>
                    <div class="plane five"></div>
                    <div style="box-shadow: 10px 10px 5px #aaaaaa;" class="plane six"></div>
                    <div class="plane seven"></div>
                    <div class="plane eight"></div>
                    <div class="plane nine"></div>
                    <div class="plane ten"></div>
                    <div class="plane eleven"></div>
                    <div class="plane twelve"></div>

                </div>
            </div>

        </div>
    </div>
    <div id="section2" class="container-fluid" style="padding-top:80px;padding-bottom:70px;height: 780px;">
        <h1>About Us</h1>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and look at the navigation bar while scrolling!</p>
    </div>
    <div id="section3" class="container-fluid" style="padding-top:80px;padding-bottom:70px;height: 780px;">
        <h1>Contact</h1>
        <div class="row">
            <div class="col-md-6 column-1" id="CI">
                <h2>Contact Information</h2>
                <br><br>
                <div id="ct1">
                    <i class="far fa-map"></i><span>SICT-Quan Ngu Hanh Son,Da Nang</span>
                    <br>
                    <i class="far fa-address-book"></i><span>(+84)33333333303</span>
                    <br>
                    <i class="far fa-envelope"></i><span>nhavbnm@gmail.com</span>
                    <br>
                    <i class="far fa-newspaper"></i><span><a
                            href="https://www.facebook.com/profile.php?id=100006409898902">My website</a></span>

                    <br>
                </div>

                <div id="fb">
                    <i id="fa-facebook" class="fab fa-facebook"></i>
                    <i id="fa-twitter" class="fab fa-twitter"></i>
                    <i id="fa-youtube" class="fab fa-youtube"></i>
                    <i id="fa-instagram" class="fab fa-instagram"></i>
                </div>
                <style>
                    /* Always set the map height explicitly to define the size of the div
                   * element that contains the map. */
                    
                    #map {
                        height: 340px;
                    }
                    /* Optional: Makes the sample page fill the window. */
                    
                    html,
                    body {
                        height: 100%;
                        margin: 0;
                        padding: 0;
                    }
                </style>
                <br>
                <div id="map"></div>

                <script>
                    var map;

                    function initMap() {
                        map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: -34.397,
                                lng: 150.644
                            },
                            zoom: 8
                        });
                    }
                </script>
                <script type="text/javascript" src="//maps.googleapis.com/maps/api/js?AIzaSyDHElrYmsfII-3sTKXk0bqKgzsGZoAGslw&language=vi&callback=initMap"></script>
            </div>
            <div class="col-md-6 column-2">
                <div class="form-group">
                    <form action="/FLRV-CH/cs/Sendreport" method="post">
                        @csrf
                        <h2>Report</h2>
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="Name" id="" aria-describedby="helpId" required placeholder="">
                        <small id="helpId" class="form-text text-muted">Help text</small>
                        <label for="">Email</label>
                        <input type="text" class="form-control" name="Email" id="" aria-describedby="helpId" required placeholder="">
                        <small id="helpId" class="form-text text-muted">Help text</small>
                        <label for="">Chủ đề</label>
                        <input type="textarea" class="form-control" name="Title" id="" aria-describedby="helpId" required placeholder="">
                        <small id="helpId" class="form-text text-muted">Help text</small>
                        <label for="">Nội Dung</label>
                        <textarea class="form-control" name="Content" id="" required rows="3"></textarea>
                        <br>
                        <input name="" id="send" class="btn btn-block" type="submit" value="Gui">
                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- <div id="section41" class="container-fluid bg-danger" style="padding-top:80px;padding-bottom:70px;height: 750px;">
        <h1>Section 4 Submenu 1</h1>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and
            look at the navigation bar while scrolling!</p>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and
            look at the navigation bar while scrolling!</p>
    </div>
    <div id="section42" class="container-fluid bg-info" style="padding-top:80px;padding-bottom:70px;height: 750px;">
        <h1>Section 4 Submenu 2</h1>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and
            look at the navigation bar while scrolling!</p>
        <p>Try to scroll this section and look at the navigation bar while scrolling! Try to scroll this section and
            look at the navigation bar while scrolling!</p>
    </div> -->

</body>

</html>