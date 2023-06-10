<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }

        .login-form {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 32px;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeSlideUp 0.5s ease-out forwards;
        }

        .card-header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 24px;
            margin-right: 24px;
        }

        .form-label {
            display: block;
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 8px;
            color: #333;
        }

        .form-control {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            outline: none;
            border-color: #007bff;
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-top: 4px;
        }

        .submit-button {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 24px;
            /* Add margin-top to create space between the input field and the button */
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        .success-message {
            color: #28a745;
            font-size: 16px;
            margin-top: 16px;
            /* Decrease the margin-top to bring the success message closer to the button */
            text-align: center;
            opacity: 0;
            transform: translateY(-10px);
            animation: fadeSlideDown 0.5s ease-out forwards;
        }


        @keyframes fadeSlideUp {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeSlideDown {
            0% {
                opacity: 0;
                transform: translateY(-10px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body>
    <main class="login-form">
        <div class="container">
            <div class="card">
                <div class="card-header">Reset Password</div>
                <div class="card-body">

                    @if (Session::has('message'))
                        <div class="success-message">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <form action="{{ route('forget.password.post') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="email_address" class="form-label">E-Mail Address</label>
                            <input type="email" id="email_address" class="form-control" name="email" required
                                autofocus>
                            @if ($errors->has('email'))
                                <span class="error-message">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <button type="submit" class="submit-button" onclick="showSuccessMessage()">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>

    <script>
        function showSuccessMessage() {
            var successMessage = document.querySelector('.success-message');
            successMessage.style.opacity = 1;
            successMessage.style.transform = 'translateY(0)';
        }
    </script>
</body>

</html>
