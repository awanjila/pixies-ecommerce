<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quotation | Pixies Technologies</title>
    <style>
        /* Modern styles for the email */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }
        .invoice {
            max-width: 600px;
            margin: 20px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
            position: relative;
        }
        .company-logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .header {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }
        .invoice-details, .client-details {
            width: 48%;
        }
        .invoice-details h4, .client-details h4 {
            color: #25bab5;
            margin: 0 0 10px 0;
        }
        .client-details p, .invoice-details p {
            margin: 5px 0;
        }
        .order-details {
            margin-top: 20px;
        }
        .order-details h5 {
            color: #25bab5;
            margin: 0 0 10px 0;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .table th, .table td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        .table th {
            background-color: #25bab5;
            color: #ffffff;
        }
        .subtotal, .total {
            margin-top: 20px;
            text-align: right;
        }
        .subtotal strong, .total strong {
            color: #25bab5;
        }
        .btn-primary {
            background-color: #25d366;
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            display: inline-block;
            margin-top: 20px;
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .btn-primary svg {
            fill: #ffffff;
            width: 20px;
            height: 20px;
            margin-right: 5px;
        }
        .btn-primary:hover {
            background-color: #128c7e;
        }
        .about-us {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .social-links {
            margin-top: 10px;
        }
        .social-links a {
            margin-right: 10px;
        }
    </style>
</head>
<body>

<div class="invoice">
    <div class="company-logo">
        <img src="front-assets/img/brand-logo/logo.png" alt="Company Logo" style="max-width: 150px;">
    </div>

    <div class="header">
        <div class="invoice-details">
            <h4><b>Invoice Details</b></h4>
            <p><strong>Organization:</strong> {{ config('app.name') }}</p>
            <p><strong>Date:</strong> {{ now()->format('d-m-Y') }}</p>
            <p><strong>Phone Number:</strong> +254710909198</p>
            <p><strong>Quotation Number:</strong> {{ $data['invoice_no'] }}</p>
        </div>

        <div class="client-details">
            <h4><b>Client Details</b></h4>
            <p><strong>Name:</strong> {{ $data['customer_name'] }}</p>
            <p><strong>Email:</strong> {{ $data['customer_email'] }}</p>
            <p><strong>Telephone:</strong> {{ $data['customer_phone'] }}</p>
        </div>
    </div>

    <div class="order-details">
        <h5><b>Order Details</b></h5>
        <table class="table">
            <thead>
                <tr>
                    <th>Product Name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $subtotal = 0;
                @endphp
                @foreach($contents as $content)
                <tr>
                    <td>{{ $content['name'] }}</td>
                    <td>Ksh {{ $content['price'] }}</td>
                    <td>{{ $content['quantity'] }}</td>
                    <td>Ksh {{ $content['price'] * $content['quantity'] }}</td>
                </tr>
                @php
                    $subtotal += $content['price'] * $content['quantity'];
                @endphp
                @endforeach
            </tbody>
        </table>

        <div class="subtotal">
            <p><strong>Subtotal:</strong> Ksh {{ $subtotal }}</p>
        </div>

        <div class="total">
            <p><strong>Total:</strong> Ksh {{ $subtotal }}</p>
        </div>
    </div>

   

    <div class="about-us">
    <h4>About Us</h4>
    <p>Your trusted partner in Surgical Instruments, Medical Supplies, and Healthcare Solutions. We provide top-quality surgical tools and hospital equipment to keep your healthcare facility well-equipped and efficient.</p>
    <div class="social-links">
        <a href="https://www.facebook.com/pixies" target="_blank"><img src="facebook_icon.png" alt="Facebook"></a>
        <a href="https://www.instagram.com/pixies" target="_blank"><img src="instagram_icon.png" alt="Instagram"></a>
        <a href="https://twitter.com/pixies" target="_blank"><img src="twitter_icon.png" alt="Twitter"></a>
    </div>
</div>

</div>

</body>
</html>
