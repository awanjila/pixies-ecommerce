<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Contact Form Submission</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
        }
        .header {
            background-color: #f8f9fa;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        .details {
            margin-bottom: 20px;
        }
        .label {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>New Contact Form Submission</h2>
            <p>A new contact form submission has been received from wabegadgets website.</p>
        </div>

        <div class="details">
            <p><span class="label">Name:</span> {{ $data['name'] }}</p>
            <p><span class="label">Email:</span> {{ $data['email'] }}</p>
            @if(isset($data['phone']))
            <p><span class="label">Phone:</span> {{ $data['phone'] }}</p>
            @endif
            <p><span class="label">Subject:</span> {{ $data['subject'] }}</p>
            <p><span class="label">Message:</span></p>
            <p>{{ $data['message'] }}</p>
        </div>

        <div class="footer">
            <p>This is an automated message from your website's contact form.</p>
            <p>Time of submission: {{ now()->format('Y-m-d H:i:s') }}</p>
        </div>
    </div>
</body>
</html> 