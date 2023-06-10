@if (session('username') != null)
    {
    <script>
        window.location.href = '/admin/index';
    </script>
    }
@endif
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/login.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <title>SIGN IN/UP FORM</title>
</head>

<body>
    <h2> Sign in/up Form</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form method="POST" id="regForm" action="{{ route('validateLoginForm') }}">
                @csrf
                <h1>Register </h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="Name" id="username" name="username" required="">
                <span class="name_err"></span>
                <input type="email" placeholder="Email" id="regemail" name="email" required="">
                <span class="email_err"></span>
                <input type="password" placeholder="Password" id="regpassword" name="password" required />
                <span class="password_err"></span>
                <button type="submit">Sign Up</button>
                <span class="logedin"></span>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form method="POST" id="myform">
                @csrf
                <h1>Sign in</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name="email" id="email">
                <span class="email_err"></span>
                <input type="password" placeholder="Password" name="password" id="password">
                <span class="pswd_err"></span>
                <a href="{{ route('forget.password.get') }}">Forgot your password?</a>
                <button type="submit">Sign In</button>
                <div class="success-message"></div>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us, please login with your personal info</p>
                    <button class="ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start your journey with us</p>
                    <button class="ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>
            Created with <i class="fa fa-heart"></i> by
            <a><i>PATADIA</i> <b>RUSHABH</b></a>
        </p>
    </footer>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });

        // Login Form Validation

        $('#myForm').submit(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var email = $('#email').val();
            var password = $('#password').val();

            $.ajax({
                url: "{{ route('validateLoginForm') }}",
                type: "POST",
                data: {
                    _token: _token,
                    email: email,
                    password: password
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        if (data.success) {
                            $('.email_err').text('');
                            $('.password_err').text('');
                            window.location.href = "/admin/index";
                        } else {
                            alert(data.failed);
                            window.location.href = '/admin/login';
                        }
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });

        });

        function printErrorMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
            })
        }

        $('#regForm').submit(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            var username = $('#username').val();
            var email = $('#regemail').val();
            var password = $('#regpassword').val();

            $.ajax({
                url: "{{ route('validateRegForm') }}",
                type: "POST",
                data: {
                    _token: _token,
                    username: username,
                    email: email,
                    password: password
                },
                success: function(data) {
                    if ($.isEmptyObject(data.error)) {
                        $('.name_err').text('');
                        $('.email_err').text('');
                        $('.password_err').text('');
                        window.location.href = "/admin/login";
                        $('.logedin').text('Click on Login');
                    } else {
                        printErrorMsg(data.error);
                    }
                }
            });
        });

        function printErrorMsg(msg) {
            $.each(msg, function(key, value) {
                $('.' + key + '_err').text(value);
            })
        }
    </script>
</body>

</html>
