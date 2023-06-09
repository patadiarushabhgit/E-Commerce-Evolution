@extends('index')
@section('profile_content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Account Settings</title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<style>
   .profile-image {
  display: inline-block;
  width: 40px;
  height: 40px;
  border-radius: 20%;
  background-color: #ff6600;
  color: #ffffff;
  text-align: center;
  font-size: 18px;
  line-height: 40px;
  margin-right: 10px;
  font-weight: bold;
  font-family: 'Arial', sans-serif;
  text-transform: uppercase;
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
  transition: background-color 0.3s ease, color 0.3s ease;
}

.profile-image:hover {
  background-color: #fcfcfc;
  color: #ff6600;
  border-radius: 20%;
  border: 0.8px outset #ff6600;
}

    .password-input {
        position: relative;
    }

    .password-input .toggle-password {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
    }
</style>





<body>
	<section class="py-5 my-5">
        <div class="container">
            <h1 class="mb-5">Account Settings</h1>
            <div class="bg-white shadow rounded-lg d-block d-sm-flex">
                <div class="profile-tab-nav border-right">
                    <div class="p-4">
                        <div class="img-circle text-center mb-3">
                            <span class="profile-image">{{ substr((Auth::user()->name), 0, 1) }}</span>
                        </div>
                        <h4 class="text-center">{{strtoupper(Auth::user()->name)}}</h4>
                    </div>
                    <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
                            <i class="fa fa-home text-center mr-1"></i>
                            Account
                        </a>
                        <a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
                            <i class="fa fa-key text-center mr-1"></i>
                            Password
                        </a>
                    </div>
                </div>
                <div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                        <h3 class="mb-4">Account Settings</h3>
                        <form action="{{ route('edit_profile') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" id="name" name="name" class="form-control" value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Email</label>
                                          <input type="text" id="email" name="email" class="form-control" value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                          <label>Role</label>
                                          <input type="text" id="role" name="role" class="form-control" value="{{ $user->roles }}">
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
                        <h3 class="mb-4">Password Settings</h3>
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="set_password_form" method="post" enctype="multipart/form-data" action="{{ route('edit_profile') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Old password</label>
                                        <div class="password-input">
                                            <input type="password" id="old_password" name="old_password" class="form-control">
                                            <i class="toggle-password fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>New password</label>
                                        <div class="password-input">
                                            <input type="password" id="new_password" name="new_password" class="form-control">
                                            <i class="toggle-password fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Confirm new password</label>
                                        <div class="password-input">
                                            <input type="password" id="confirm_password" name="confirm_password" class="form-control">
                                            <i class="toggle-password fas fa-eye"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        const togglePassword = document.querySelectorAll('.toggle-password');

        togglePassword.forEach((icon) => {
            icon.addEventListener('click', () => {
                const inputField = icon.previousElementSibling;
                const fieldType = inputField.getAttribute('type') === 'password' ? 'text' : 'password';
                inputField.setAttribute('type', fieldType);

                // Toggle the icon based on the password visibility
                icon.classList.toggle('fa-eye');
                icon.classList.toggle('fa-eye-slash');
            });
        });
    </script>

	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
@endsection
