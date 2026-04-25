@extends('layouts.front_app')

@section('title',
'Pixies Technologies | Surgical Instruments · Medical Supplies · Hospital Equipment · Lab Consumables · Reliable Healthcare Solutions')

@section('meta_title', 'Our Products · Surgical Instruments · Medical Supplies · Hospital Equipment · Lab Consumables · Trusted Healthcare Solutions')

@section('content')
    <div class="container">
        <h2 style="text-align: center; margin-bottom: 20px;">Frequently Asked Questions & Their Answers</h2>
        <img src="{{ asset('front-assets/images/cta-banner.jpg') }}" alt="FAQ Image" style="width: 100%; max-width: 1200px; height: 50vh; margin-bottom: 20px;">
        <div class="accordion" style="max-width: 800px;">
            <div class="accordion-item">
                <div class="accordion-header">Do you supply to individuals or only hospitals?</div>
                <div class="accordion-content">
                    <p>We supply to both hospitals/clinics and individuals. Whether you need bulk purchases for your facility 
                    or single items for personal use, Pixies Technologies is here to serve you.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Do you deliver outside Nairobi?</div>
                <div class="accordion-content">
                    <p>Yes, we deliver countrywide across Kenya. We also arrange regional deliveries on request.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Are your products certified?</div>
                <div class="accordion-content">
                    <p>All our surgical instruments and medical supplies are sourced from trusted manufacturers 
                    and comply with international and local medical standards.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Do you offer after-sales support?</div>
                <div class="accordion-content">
                    <p>Yes, we provide customer support for product guidance, installation (where applicable), 
                    and troubleshooting. Contact us if you encounter any issues with your order.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Can I return or replace a product?</div>
                <div class="accordion-content">
                    <p>If an item arrives damaged or defective, we will replace it at no extra charge. Please 
                    contact our support team within 48 hours of delivery with photos of the product, and 
                    we’ll guide you through the return process.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">Do you sell wholesale?</div>
                <div class="accordion-content">
                    <p>Yes, we sell both retail and wholesale. For bulk orders, please contact us at 
                    +2547XXXXXXXX to receive our wholesale pricing and terms.</p>
                </div>
            </div>
            <div class="accordion-item">
                <div class="accordion-header">How can I contact you for urgent orders?</div>
                <div class="accordion-content">
                    <p>You can reach us directly via phone at +2547XXXXXXXX, by email at 
                    support@Pixies Technologies.com, or through our social media platforms.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        .accordion {
            margin: 0 auto;
        }

        .accordion-item {
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            overflow: hidden;
        }

        .accordion-header {
            padding: 10px;
            background-color: #f2f2f2;
            cursor: pointer;
            font-weight: bold;
            position: relative;
        }

        .accordion-header:hover {
            background-color: #e0e0e0;
        }

        .accordion-toggle {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
        }

        .accordion-content {
            padding: 10px;
            display: none;
        }

        .accordion-item.active .accordion-content {
            display: block;
        }

        .accordion-item.active .accordion-header .accordion-toggle::after {
            content: '-';
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const accordionHeaders = document.querySelectorAll('.accordion-header');

            accordionHeaders.forEach(header => {
                header.addEventListener('click', () => {
                    const accordionItem = header.parentElement;
                    const isActive = accordionItem.classList.contains('active');

                    // Close all accordion items
                    document.querySelectorAll('.accordion-item').forEach(item => {
                        item.classList.remove('active');
                    });

                    // Toggle active class for clicked accordion item
                    accordionItem.classList.toggle('active', !isActive);
                });
            });
        });
    </script>
@endpush
