<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>OTP Verification</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        .container {
            width: 100%;
            padding: 20px;
            background-color: #f2f2f2;
        }

        .email-content {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border: 1px solid #dddddd;
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .email-header h2 {
            color: #333333;
            font-weight: bold;
            margin-top: 0;
        }

        .otp-code {
            font-size: 36px;
            color: #4CAF50;
            font-weight: bold;
            text-align: center;
            margin-bottom: 20px;
        }

        .instruction {
            font-size: 16px;
            color: #333333;
            text-align: center;
            margin-bottom: 40px;
        }

        .footer {
            background-color: #ffffff;
            padding: 20px;
            border-top: 1px solid #dddddd;
            text-align: center;
            border-radius: 0 0 10px 10px;
        }

        .footer p {
            font-size: 14px;
            color: #666666;
            margin: 0;
        }

        .contact-link {
            color: #337ab7;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="email-content">
            <div class="email-header">
                <h2>OTP Verification</h2>
            </div>
            <div class="otp-code">
                Your Code: <span style="color: #4CAF50; font-size: 40px;">{{ $otp }}</span>
            </div>
            <div class="instruction">
                Select and copy the code above to proceed with verification.
            </div>
            <div class="footer">
                <p>
                    If you did not request this verification, please ignore this email.
                </p>
                <p>
                    If you have any questions or concerns, please reply to this email or contact our support team at
                    <a href="mailto:briskbraintechnologies@gmail.com" class="contact-link">hello@gmail.com</a>.
                </p>
            </div>
        </div>
    </div>
</body>

</html>
