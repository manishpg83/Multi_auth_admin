<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Your Laravel App</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom styles -->
    <style>
        body {
            background-color: #42684f; /* Background color */
        }

        /* Custom CSS for logo and buttons */
        .logo-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-end;
            height: 300px; /* Adjust the height as needed */
            position: relative;
            padding: 20px; /* Optional: Add padding for spacing */
        }

        .logo {
            width: 300px; /* Adjust the width */
            height: auto; /* Maintain aspect ratio */
        }

        .buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px; /* Adjust spacing */
        }

        .btn-nav {
            margin-bottom: 10px; /* Adjust spacing between buttons */
        }

        /* Centering navigation links */
        .header-nav {
            display: flex;
            justify-content: center; /* Center horizontally */
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="bg-gray-50">
        <div class="logo-container text-center py-4">
            <div class="logo">
                <img src="/images/logo1.jpeg" alt="Logo" class="img-fluid">
            </div>
        </div>
        <div class="container-fluid">
            <div class="header-nav py-4">
                <div class="row justify-content-center">
                    <div class="col">
                        <!-- Header -->
                        <header class="flex flex-col lg:flex-row items-center justify-between py-6 lg:py-10">
                            <!-- Navigation Links -->
                            <nav class="flex flex-col lg:flex-row items-center space-y-2 lg:space-y-0 lg:space-x-4">
                                @if (Route::has('login'))
                                    @auth('web')
                                        <a href="{{ url('/dashboard') }}" class="btn btn-outline-primary">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Log in</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-outline-success">Register</a>
                                        @endif
                                    @endauth

                                    @auth('admin')
                                        <a href="{{ url('/admin/dashboard') }}" class="btn btn-outline-primary">Admin Dashboard</a>
                                    @else
                                        <a href="{{ route('admin.login') }}" class="btn btn-outline-primary">Admin Log in</a>
                                        @if (Route::has('admin.register'))
                                            <a href="{{ route('admin.register') }}" class="btn btn-outline-success">Admin Register</a>
                                        @endif
                                    @endauth

                                    {{-- @auth('teacher')
                                        <a href="{{ url('/teacher/dashboard') }}" class="btn btn-outline-info">Teacher Dashboard</a>
                                    @else
                                        <a href="{{ route('teacher.login') }}" class="btn btn-outline-info">Teacher Log in</a>
                                        @if (Route::has('teacher.register'))
                                            <a href="{{ route('teacher.register') }}" class="btn btn-outline-dark">Teacher Register</a>
                                        @endif
                                    @endauth --}}
                                @endif
                            </nav>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
