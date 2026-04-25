<!DOCTYPE html>
<html>
<head>
    <title>New Blog Post from Pixies Technologies</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .email-container {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header { text-align: center; margin-bottom: 30px; }
        .logo { max-width: 150px; height: auto; }
        .blog-image {
            width: 100%;
            max-height: 300px;
            object-fit: cover;
            margin-bottom: 20px;
        }
        .blog-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 15px;
        }
        .blog-description { margin-bottom: 25px; }
        .read-more-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #333;
            color: white !important;
            text-decoration: none;
            border-radius: 5px;
            margin-bottom: 30px;
        }
        .social-links {
            text-align: center;
            margin-bottom: 20px;
            padding: 15px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            color: #333;
            text-decoration: none;
            font-size: 20px;
        }
        .social-icon {
            width: 30px;
            height: 30px;
        }
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }
        .footer a {
            color: #333;
            text-decoration: underline;
        }
        .about-us {
            background-color: #f8f8f8;
            padding: 20px;
            margin: 20px 0;
            border-radius: 5px;
            text-align: center;
        }
        .about-us h3 {
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }
        .about-us p {
            color: #666;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <img src="{{ asset('front-assets/img/brand-logo/logo.png') }}" alt="Pixies Technologies Logo" class="logo">
        </div>

        <div class="blog-content">
            @if($blog->image)
                <img src="{{ asset($blog->image) }}" alt="{{ $blog->name }}" class="blog-image">
            @endif

            <h1 class="blog-title">{{ $blog->name }}</h1>
            
            <div class="blog-description">
                {!! Str::limit(strip_tags($blog->description), 200) !!}
            </div>

            <a href="{{ url('show/blog/' . $blog->slug) }}" class="read-more-btn">Read More</a>
        </div>

        <div class="about-us">
            <h3>About Pixies Technologies</h3>
            <p>Your trusted partner in Surgical Instruments, Medical Supplies, and Healthcare Solutions. We provide top-quality surgical tools and hospital equipment to keep your healthcare facility well-equipped and efficient.</p>
        </div>

        <div class="social-links">
            <a href="https://facebook.com/wabegadgets" target="_blank">
                <img src="{{ asset('front-assets/img/social/facebook.png') }}" alt="Facebook" class="social-icon">
            </a>
            <a href="https://twitter.com/wabegadgets" target="_blank">
                <img src="{{ asset('front-assets/img/social/twitter.png') }}" alt="Twitter" class="social-icon">
            </a>
            <a href="https://instagram.com/wabegadgets" target="_blank">
                <img src="{{ asset('front-assets/img/social/instagram.png') }}" alt="Instagram" class="social-icon">
            </a>
            <a href="https://linkedin.com/company/wabegadgets" target="_blank">
                <img src="{{ asset('front-assets/img/social/linkedin.png') }}" alt="LinkedIn" class="social-icon">
            </a>
        </div>

        <div class="footer">
            <p>© {{ date('Y') }} Pixies Technologies. All rights reserved.</p>
            <p>Contact us: info@pixies.co.ke | +254 798 742 543</p>
            <p>If you no longer wish to receive these emails, you can <a href="{{ url('/unsubscribe') }}">unsubscribe here</a></p>
        </div>
    </div>
</body>
</html> 