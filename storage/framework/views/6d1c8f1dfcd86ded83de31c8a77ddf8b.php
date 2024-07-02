<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify OTP</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="text-center mt-5">Verify OTP</h2>
                <form method="POST" action="<?php echo e(route('otp.verify', ['user' => $userId])); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="otp">OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Verify</button>
                </form>                
            </div>
        </div>
    </div>
</body>
</html>
<?php /**PATH /var/www/html/projects/laravel-11-multi-auth/resources/views/auth/verify-otp.blade.php ENDPATH**/ ?>