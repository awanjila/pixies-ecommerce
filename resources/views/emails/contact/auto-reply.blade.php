<!DOCTYPE html>
<html>
<head>
    <title>Thank you for contacting Pixies Technologies</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .logo img {
            max-width: 150px;
        }
        .footer {
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="logo">
            <img src="{{ asset('front-assets/img/brand-logo/logo.png') }}" alt="Pixies Technologies Logo">
        </div>

        <h2>Thank you for contacting Pixies Technologies</h2>

        <p>Dear {{ $data['name'] }},</p>

        <p>Thank you for reaching out to us. We have received your message and will get back to you as soon as possible.</p>

        <p>Here's a copy of your message:</p>
        <blockquote>
            {{ $data['message'] }}
        </blockquote>
        <p>If you have any further questions or need immediate assistance, please feel free to contact us at <a href="mailto:info@pixies.co.ke">info@pixies.co.ke</a>.</p>
        <p>Best regards,<br>The Pixies Technologies Team</p>

        <div class="footer">
            <p>© {{ date('Y') }} Pixies Technologies. All rights reserved.</p>
            <p>#</p>
            <p>Tel: +254 798 742 543 | Email: info@pixies.co.ke</p>
        </div>
    </div>
</body>
</html> 