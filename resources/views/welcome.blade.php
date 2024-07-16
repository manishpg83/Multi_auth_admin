<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lttr snd</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}" />

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        body {
            background-color: #42684f;
            color: #ffffff;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
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

        /* Slider section */
        .slider-section {
            background-color: #ffffff;
            padding: 50px 0;
            text-align: center;
        }

        .slider-section h2 {
            color: #42684f;
            margin-bottom: 30px;
        }

        .slider {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .slider img {
            max-width: 100%;
            height: auto;
            max-height: 300px;
            margin: 0 20px;
            border-radius: 5px;
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

        <!-- Slider section -->
        <section class="slider-section">
            <div class="container">
                <h2>Explore Our Features</h2>
                <div class="slider">
                    <img src="{{ asset('images/slider1.jpeg') }}" alt="Slider Image 1">
                    <img src="{{ asset('images/slider2.jpeg') }}" alt="Slider Image 2">
                    <img src="{{ asset('images/slider3.jpeg') }}" alt="Slider Image 3">
                </div>
            </div>
        </section>

        <!-- Another section -->
        <section style="background-color: #42684f; color: #ffffff; padding: 50px 0; text-align: center;">
            <div class="container">
                <h2>Why Choose Us?</h2>
                <p>We provide excellent service and innovative solutions.</p>
                <a href="#" class="btn btn-outline-light btn-lg mt-3">Learn More</a>
            </div>
        </section>

        <!-- Footer section -->
        <footer class="footer">
            <p>&copy; 2024 Lttrsnd. All rights reserved.</p>
        </footer>
    </div>
</body>

</html>
