<!doctype html>
<html lang="en">

<head>
    <title>sign Up</title>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="/FLRV-CH/local/public/assets/intro/intro.css">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <script>
        $.ajaxSetup({

            headers: {

                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

            }

        });
    </script>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f1f1f1;
        }

        #regForm {
            background-color: #ffffff;
            margin: 100px auto;
            font-family: Raleway;
            padding: 40px;
            width: 70%;
            min-width: 300px;
        }

        h1 {
            text-align: center;
        }

        input {
            padding: 10px;
            width: 100%;
            font-size: 17px;
            font-family: Raleway;
            border: 1px solid #aaaaaa;
        }
        /* Mark input boxes that gets an error on validation: */

        input.invalid {
            background-color: #ffdddd;
        }
        /* Hide all steps by default: */

        .tab {
            display: none;
        }

        button {
            background-color: #4CAF50;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            font-size: 17px;
            font-family: Raleway;
            cursor: pointer;
        }

        button:hover {
            opacity: 0.8;
        }

        #prevBtn {
            background-color: #bbbbbb;
        }
        /* Make circles that indicate the steps of the form: */

        .step {
            height: 15px;
            width: 15px;
            margin: 0 2px;
            background-color: #bbbbbb;
            border: none;
            border-radius: 50%;
            display: inline-block;
            opacity: 0.5;
        }

        .step.active {
            opacity: 1;
        }
        /* Mark the steps that are finished and valid: */

        .step.finish {
            background-color: #4CAF50;
        }
    </style>
</head>

<body>
    <form id="regForm" action="/FLRV-CH/account/postsignup" method="POST" enctype="multipart/form-data">
        @csrf
        <h1>Register:</h1>
        <!-- One "tab" for each step in the form: -->
        <div class="tab">Name:
            <p><input placeholder="Your full name..." oninput="this.className = ''" name="fname"></p>
            <!-- <p><input placeholder="Last name..." oninput="this.className = ''" name="lname"></p> -->
        </div>
        <div class="tab">Contact Info:
            <p><input placeholder="E-mail..." onchange="check('email',$(this).val())" oninput="this.className = ''" name="email"></p>
            <p><input placeholder="Phone..." onchange="check('phone',$(this).val())" oninput="this.className = ''" name="phone"></p>
            <p>
                <select style="width: 100%;" class="form-control" oninput="this.className = ''" aria-placeholder="gioiws tính" name="sex" id="">
                <option>Male</option>
                <option>Female</option>
                <option>Other</option>
                </select>
            </p>
            <div id="Cialert" style="display: none;" class="alert alert-danger" role="alert">
                <strong>danger</strong>
            </div>
        </div>
        <div class="tab">Birthday:
            <p><input type="date" oninput="this.className = ''" name="dob" id=""></p>
            <!-- <p><input placeholder="dd" oninput="this.className = ''" name="dd"></p>
            <p><input placeholder="mm" oninput="this.className = ''" name="nn"></p>
            <p><input placeholder="yyyy" oninput="this.className = ''" name="yyyy"></p> -->
        </div>
        <div class="tab">Login Info:
            <p><input placeholder="Username..." onchange="check('username',$(this).val())" oninput="this.className = ''" name="uname"></p>
            <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p>
            <div id="accalert" style="display: none;" class="alert alert-danger" role="alert">
                <strong>danger</strong>
            </div>
        </div>
        <div class="tab">Image:
            <p><input placeholder="your avatar" id="file" type="file" required oninput="this.className = ''" name="file"></p>
            <!-- <p><input placeholder="Password..." oninput="this.className = ''" name="pword" type="password"></p> -->
            <div class="file-upload-content">
                <img style="width: 200px; height: 200px; border: 1px solid gray;" class="file-upload-image" src="#" alt="your image" />
                <div class="image-title-wrap"></div>
            </div>
        </div>
        <div style="overflow:auto;">
            <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </div>
        </div>
        <!-- Circles which indicates the steps of the form: -->
        <div style="text-align:center;margin-top:40px;">
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
            <span class="step"></span>
        </div>
    </form>
    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab

        function showTab(n) {
            // This function will display the specified tab of the form...
            var x = document.getElementsByClassName("tab");
            x[n].style.display = "block";
            //... and fix the Previous/Next buttons:
            if (n == 0) {
                document.getElementById("prevBtn").style.display = "none";
            } else {
                document.getElementById("prevBtn").style.display = "inline";
            }
            if (n == (x.length - 1)) {
                document.getElementById("nextBtn").innerHTML = "Submit";
            } else {
                document.getElementById("nextBtn").innerHTML = "Next";
            }
            //... and run a function that will display the correct step indicator:
            fixStepIndicator(n)
        }

        function nextPrev(n) {
            // This function will figure out which tab to display
            var x = document.getElementsByClassName("tab");
            // Exit the function if any field in the current tab is invalid:
            if (n == 1 && !validateForm()) return false;
            // Hide the current tab:
            x[currentTab].style.display = "none";
            // Increase or decrease the current tab by 1:
            currentTab = currentTab + n;
            // if you have reached the end of the form...
            if (currentTab >= x.length) {
                // ... the form gets submitted:
                document.getElementById("regForm").submit();
                return false;
            }
            // Otherwise, display the correct tab:
            showTab(currentTab);
        }

        function validateForm() {
            // This function deals with validation of the form fields
            var x, y, i, valid = true;
            x = document.getElementsByClassName("tab");
            y = x[currentTab].getElementsByTagName("input");
            // A loop that checks every input field in the current tab:
            for (i = 0; i < y.length; i++) {
                // If a field is empty...
                if (y[i].value == "") {
                    // add an "invalid" class to the field:
                    y[i].className += " invalid";
                    // and set the current valid status to false
                    valid = false;
                }
            }
            // If the valid status is true, mark the step as finished and valid:
            if (valid) {
                document.getElementsByClassName("step")[currentTab].className += " finish";
            }
            return valid; // return the valid status
        }

        function fixStepIndicator(n) {
            // This function removes the "active" class of all steps...
            var i, x = document.getElementsByClassName("step");
            for (i = 0; i < x.length; i++) {
                x[i].className = x[i].className.replace(" active", "");
            }
            //... and adds the "active" class on the current step:
            x[n].className += " active";
        }
        $('.file-upload-content').hide();

        var uploadField = document.getElementById("file");
        uploadField.onchange = function() {
            // alert('sdfs');
            if (this.files[0].size > 8388608) {
                alert("File is too big!");
                this.value = "";
                $('.file-upload-content').hide();
            } else {
                alert('allow')
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('.image-upload-wrap').hide();
                    $('.file-upload-image').attr('src', e.target.result);
                    $('.file-upload-content').show();
                    $('.image-title').html(uploadField.files[0].name);
                };
                reader.readAsDataURL(uploadField.files[0]);
            }
        };

        function check($ti, $content) {
            $.ajax({
                type: "post",
                url: "/FLRV-CH/account/checkIF",
                data: {
                    title: $ti,
                    content: $content,
                },
                dataType: "text",
                success: function(response) {
                    console.log(response)
                    switch ($ti) {
                        case 'username':
                            if (response == 'false') {
                                $('#accalert').html('<strong>Tài khoản đã được sử sụng</strong>');
                                $('#accalert').css('display', 'block');
                            } else {
                                $('#accalert').css('display', 'none');
                            }
                            break;
                        case 'email':
                            if (response == 'false') {
                                $('#Cialert').html('<strong>email đã được sử sụng</strong>');
                                $('#Cialert').css('display', 'block');
                            } else {
                                $('#Cialert').css('display', 'none');
                            }
                            break;
                        case 'phone':
                            if (response == 'false') {
                                $('#Cialert').html('<strong>Số điện thoại này đã được sử sụng</strong>');
                                $('#Cialert').css('display', 'block');
                            } else {
                                $('#Cialert').css('display', 'none');
                            }
                            break;
                        default:
                            break;
                    }
                }
            });
        }
    </script>
</body>

</html>
