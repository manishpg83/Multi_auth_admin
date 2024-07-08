<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lttr snd</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        body {
            background-color: #42684f;
            color: #ffffff;
            margin: 0;
            padding: 0;
        }

        /* Custom CSS for logo and buttons */
        .navbar {
            background-color: #f4eef1;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            width: 50px;
            height: auto;
        }

        .buttons {
            display: flex;
            align-items: center;
        }

        .btn-nav {
            margin-left: 10px;
            background-color: #f4cd12;
            color: #42684f;
            border-color: #f4cd12;
        }

        .btn-nav:hover,
        .btn-nav:focus {
            background-color: #42684f;
            border-color: #42684f;
            color: #f4cd12;
        }

        /* Full-width image */
        .full-width-img {
            width: 100%;
            height: auto;
            display: block;
            margin: 0 auto;
            max-height: 500px;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px 0;
            background-color: #f4eef1;
            color: gray;
        }

        .footer p {
            margin: 0;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50">
        <!-- Navbar section -->
        <div class="navbar">
            <div class="logo">
                <img src="{{ asset('images/logo1.jpeg') }}" alt="Logo" class="img-fluid">
            </div>
            <div class="buttons">
                <a href="{{ route('register') }}" class="btn btn-warning btn-nav">Sign in / Sign up</a>
                {{-- <a href="{{ route('admin.register') }}" class="btn btn-outline-warning btn-nav">Admin Sign in / Sign up</a> --}}
            </div>
        </div>

        <!-- Full-width image section -->
        <img src="{{ asset('images/banner1.jpeg') }}" alt="Full Width Image" class="full-width-img">

        <!-- Footer section -->
        <footer class="footer">
            <p>&copy; 2024 Lttrsnd. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
