<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login V4</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="google-signin-scope" content="profile email">
    <meta name="google-signin-client_id" content="683314081231-falahe1c0kocirc19mbmlscgcp55gdok.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js" async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--===============================================================================================-->

    <link rel="icon" type="image/png" href="/FLRV-CH/local/public/assets/login/images/icons/favicon.ico" />
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/bootstrap/css/bootstrap.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/fonts/iconic/css/material-design-iconic-font.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/animate/animate.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/css-hamburgers/hamburgers.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/animsition/css/animsition.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/select2/select2.min.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/vendor/daterangepicker/daterangepicker.css">
    <!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/css/util.css">
    <link rel="stylesheet" type="text/css" href="/FLRV-CH/local/public/assets/login/css/main.css">
    <!--===============================================================================================-->
    <script>

        function onSignIn(googleUser) {
            // Useful data for your client-side scripts:
            var profile = googleUser.getBasicProfile();
            console.log("ID: " + profile.getId()); // Don't send this directly to your server!
            console.log('Full Name: ' + profile.getName());
            console.log('Given Name: ' + profile.getGivenName());
            console.log('Family Name: ' + profile.getFamilyName());
            console.log("Image URL: " + profile.getImageUrl());
            console.log("Email: " + profile.getEmail());

            // The ID token you need to pass to your backend:
            var id_token = googleUser.getAuthResponse().id_token;
            console.log("ID Token: " + id_token);
            myObj = {
                ID: profile.getId(),
                Name: profile.getName(),
                Img: profile.getImageUrl(),
                Email: profile.getEmail(),
                token: id_token,
                DCL: $ck
            };

            $.ajax({
                type: "post",
                url: "LoginWithGoogle",
                data: {
                    data1: JSON.stringify(myObj),

                },
                dataType: "text",
                success: function(data) {
                    // console.log(data)
                    if (data == "Add to system") {
                        alert("Đã thêm tài khoản vào hệ thống");
                    } else if (data == "gotohome") {
                        window.location = "/FLRV-CH/cs";
                    } else {

                    }
                }
            });

        }
    </script>
    <script>
        $(document).ready(function() {
            $.ajaxSetup({

                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

                }

            });
            $ck = false;
            $('.g-signin2').click(function(e) {
                $ck = true;
            });
        });
    </script>
</head>

<body>

    <div class="limiter">
        <div class="container-login100" style="background-image: url('/FLRV-CH/local/public/assets/login/images/bg-01.jpg');">
            <div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
                <form class="login100-form validate-form" action="login" method="POST">
                    @csrf
                    <span class="login100-form-title p-b-49">
						Login
					</span>

                    <div class="wrap-input100 validate-input m-b-23" data-validate="Username is reauired">
                        <span class="label-input100">Username</span>
                        <input class="input100" type="text" name="username" placeholder="Type your username">
                        <span class="focus-input100" data-symbol="&#xf206;"></span>
                    </div>

                    <div class="wrap-input100 validate-input" data-validate="Password is required">
                        <span class="label-input100">Password</span>
                        <input class="input100" type="password" name="password" placeholder="Type your password">
                        <span class="focus-input100" data-symbol="&#xf190;"></span>
                    </div>

                    <div class="text-right p-t-8 p-b-31">
                        <a href="#">
							Forgot password?
						</a>
                    </div>

                    <div class="container-login100-form-btn">
                        <div class="wrap-login100-form-btn">
                            <div class="login100-form-bgbtn"></div>
                            <button class="login100-form-btn">
								Login
							</button>
                        </div>
                    </div>

                    <div class="txt1 text-center p-t-54 p-b-20">
                        <span>
							Or Sign Up Using
						</span>
                    </div>

                    <div class="flex-c-m">
                        <a href="#" class="login100-social-item bg1">
                            <i class="fa fa-facebook"></i>
                        </a>

                        <a href="#" class="login100-social-item bg2">
                            <i class="fa fa-twitter"></i>
                        </a>
                        <button type="button" data-onsuccess="onSignIn" data-longtitle="false" class="g-signin2 login100-social-item bg3"><i class="fa fa-google"></i></button>
                        <!-- <a href="#" class="login100-social-item bg3">

                        </a> -->
                    </div>

                    <div class="flex-col-c p-t-155">
                        <span class="txt1 p-b-17">
							Or Sign Up Using
						</span>

                        <a href="/FLRV-CH/account/signup" class="txt2">
							Sign Up
						</a>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div id="dropDownSelect1"></div>

    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/bootstrap/js/popper.js"></script>
    <script src="/FLRV-CH/local/public/assets/login/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/select2/select2.min.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/daterangepicker/moment.min.js"></script>
    <script src="/FLRV-CH/local/public/assets/login/vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/vendor/countdowntime/countdowntime.js"></script>
    <!--===============================================================================================-->
    <script src="/FLRV-CH/local/public/assets/login/js/main.js"></script>

</body>

</html>
