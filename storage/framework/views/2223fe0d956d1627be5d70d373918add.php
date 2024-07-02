<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
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
                                <?php if(Route::has('login')): ?>
                                    <?php if(auth()->guard('web')->check()): ?>
                                        <a href="<?php echo e(url('/dashboard')); ?>" class="btn btn-outline-primary">Dashboard</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('login')); ?>" class="btn btn-outline-primary">Log in</a>
                                        <?php if(Route::has('register')): ?>
                                            <a href="<?php echo e(route('register')); ?>" class="btn btn-outline-success">Register</a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    <?php if(auth()->guard('admin')->check()): ?>
                                        <a href="<?php echo e(url('/admin/dashboard')); ?>" class="btn btn-outline-primary">Admin Dashboard</a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('admin.login')); ?>" class="btn btn-outline-primary">Admin Log in</a>
                                        <?php if(Route::has('admin.register')): ?>
                                            <a href="<?php echo e(route('admin.register')); ?>" class="btn btn-outline-success">Admin Register</a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                    
                                <?php endif; ?>
                            </nav>
                        </header>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/projects/laravel-11-multi-auth/resources/views/welcome.blade.php ENDPATH**/ ?>