<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Festival Notification</title>
</head>
<body>
    <div>
        <!-- Header -->
        <div>
            <h1>Festival Notification</h1>
        </div>

        <!-- Main Content -->
        <div>
            <h2>{{ $festival->name }}</h2>
            <p>Date: {{ $festival->date }}</p>
            <p>Description: {!! $festival->email_body !!}</p>
            <!-- Optional Call-to-Action Button -->
            <p><a href="https://example.com">Learn More</a></p>
        </div>

        <!-- Footer -->
        <div>
            <p>Thank you for participating in our festival!</p>
            <p>For more information, visit our <a href="https://example.com">website</a>.</p>
        </div>
    </div>
</body>
</html>
