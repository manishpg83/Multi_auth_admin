<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            border: 1px solid #e0e0e0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-image: url('https://yourdomain.com/images/email-bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .header {
            text-align: center;
            padding: 20px;
            background-color: #f2cf11;
            color: #ffffff;
            border-radius: 8px 8px 0 0;
            position: relative;
        }

        .header img {
            max-width: 120px;
            height: auto;
        }

        .header h1 {
            margin: 10px 0 0;
            font-size: 24px;
        }

        .main-content {
            padding: 20px;
            background-color: #e6e6e6;
            color: #333;
            text-align: center;
        }

        .main-content h2 {
            color: #42684f;
        }

        .festival-image {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #f2cf11;
            color: #ffffff;
            border-radius: 0 0 8px 8px;
            font-size: 14px;
        }

        .footer a {
            color: #ffffff;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .footer-icons {
            margin-top: 10px;
        }

        .footer-icons img {
            max-width: 30px;
            height: auto;
            margin: 0 5px;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            color: #ffffff;
            background-color: #f2cf11;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 10px;
        }

        .button:hover {
            background-color: #42684f;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <img src="https://www.briskbraintech.com/images/logo/1707390152.png" alt="Company Logo">
            <h1>Festival Notification</h1>
        </div>

        <!-- Main Content -->
        <div class="main-content">
            <img src="https://img.freepik.com/free-vector/flat-design-business-party-illustration_23-2149481435.jpg"
                alt="Festival Image" class="festival-image">
            <h2>{{ $festival->name }}</h2>
            <p>Date: {{ $festival->date }}</p>
            <p>Description: {!! $festival->email_body !!}</p>
            <!-- Optional Call-to-Action Button -->
            <a href="https://example.com" class="button">Learn More</a>
        </div>

        <!-- Footer -->
        <!-- Footer -->
        <div class="footer">
            <p>Thank you for participating in our festival!</p>
            <p>For more information, visit our <a href="https://example.com">website</a>.</p>
        </div>

    </div>
</body>

</html>
