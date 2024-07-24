<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin | Register</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">

    <style>
        body {
            background-color: #3f3d4d;
        }

        .img-logo {
            margin-top: 0px; /* Adjust the top margin as needed */
            margin-bottom: 10px;
            text-align: center; /* Center align content */
        }

        .img-logo img {
            width: 80px; /* Adjust the width of the logo */
            margin-bottom: 10px; /* Optional: Adjust margin for logo */
        }

        .background {
            width: 430px;
            height: 520px;
            position: absolute;
            transform: translate(-50%, -50%);
            left: 50%;
            top: 50%;
        }

        .background .shape {
            height: 200px;
            width: 200px;
            position: absolute;
            border-radius: 50%;
        }

        .shape:first-child {
            background: linear-gradient(#42684f, #629b76);
            left: -140px;
            top: -20px;
        }

        .shape:last-child {
            background: linear-gradient(to right, #f4cd12, #f09819);
            right: -140px;
            bottom: -20px;
        }

        .register-box {
            width: 40%;
            position: absolute;
            transform: translate(-50%, -50%);
            top: 50%;
            left: 50%;
            border-radius: 10px;
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.1);
            box-shadow: 0 0 40px rgba(8, 7, 16, 0.6);
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .register-box * {
            font-family: 'Source Sans Pro', sans-serif;
            letter-spacing: 0.5px;
            outline: none;
            border: none;
        }

        .register-box h3 {
            font-size: 32px;
            font-weight: 500;
            line-height: 42px;
            text-align: center;
            color: white;
        }

        .register-box .form-group {
            margin-top: 15px;
        }

        .register-box .form-group label {
            font-size: 16px;
            font-weight: 500;
        }

        .register-box .form-group input {
            height: 50px;
            width: 100%;
            background-color: rgba(255, 255, 255, 0.07);
            border-radius: 3px;
            padding: 0 10px;
            font-size: 14px;
            font-weight: 300;
        }

        .register-box .form-group ::placeholder {
            color: #e5e5e5;
        }

        .register-box button {
            margin-top: 20px;
            width: 100%;
            color: #080710;
            padding: 10px 0;
            font-size: 18px;
            font-weight: 600;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .form-grid .form-group {
            margin-bottom: 0;
        }
    </style>
</head>

<body class="hold-transition">
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>

    <div class="register-box">
        <h3>Admin | Register Here</h3>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('admin.register') }}">
            @csrf

            <div class="form-grid">
                <!-- Name -->
                <div class="form-group">
                    <x-text-input id="name" class="form-control" type="text" name="name" :value="old('name')"
                        placeholder="Name" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="form-group">
                    <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')"
                        placeholder="Email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="form-group">
                    <x-text-input id="password" class="form-control" type="password" name="password"
                        placeholder="Password" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="form-group">
                    <x-text-input id="password_confirmation" class="form-control" type="password"
                        name="password_confirmation" placeholder="Confirm Password" required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
            </div>

            <div class="row">
                <div class="col-8 mt-4">
                    <a href="{{ route('admin.login') }}">
                        {{ __('Already registered?') }}
                    </a>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit">{{ __('Register') }}</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
    </div><!-- /.register-box -->

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.min.js') }}"></script>
</body>

</html>
