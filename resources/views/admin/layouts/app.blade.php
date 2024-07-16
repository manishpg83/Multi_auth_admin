<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>LttrSnd</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('icon.png') }}" />


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('adminlte/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.css') }}">
    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        .status-active {
            padding: 5px;
            color: green;
            border-radius: 5px;
        }

        .status-inactive {
            padding: 5px;
            color: red;
            border-radius: 5px;
        }

        /* Adjustments for fixed navbar, sidebar, and footer */
        body {
            font-family: 'Source Sans Pro', sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        nav.navbar {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1030; /* Ensure navbar is above other content */
        }

        .sidebar {
            position: fixed;
        }

        .content-wrapper {
            margin-left: 250px; /* Ensure content does not overlap sidebar */
            padding-top: 56px; /* Height of the fixed navbar */
            padding-bottom: 60px; /* Height of the fixed footer */
            overflow-y: auto;
            overflow-x: hidden;
        }

        .main-footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            background-color: #ffffff; /* Example background color */
            color: #000000; /* Example text color */
            padding: 10px 0;
        }

        /* Additional styles for scrollable content area */
        .scrollable-content {
            padding: 10px; /* Example padding */
        }
    </style>
</head>

<body class="font-sans antialiased">
    @include('admin.layouts.navigation')
    @include('admin.layouts.sidebar')

    <div class="content-wrapper">
        <div class="scrollable-content">
            @yield('content')
        </div>
    </div>

    <footer class="main-footer">
        <div class="container">
            <p>&copy; 2024. All rights reserved.</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Custom Scripts -->
    @yield('scripts')

    <script>
        $(document).ready(function() {
            $('#clientTable').DataTable();
            $('#festivalTable').DataTable();
            $('#planTable').DataTable();
        });

        // SweetAlert for delete confirmation
        $('.delete-btn').on('click', function(event) {
            event.preventDefault();
            var festivalId = $(this).data('festival-id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + festivalId).submit();
                }
            })
        });
    </script>
</body>

</html>
