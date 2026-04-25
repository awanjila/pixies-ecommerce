@extends('layouts.front_app')

@section('title', 'Contact Us | Pixies Technologies | Electronics, Security & Smart Devices in Nairobi Kenya')

@section('meta_title', 'Contact Pixies Technologies | Electronics, Security & Smart Devices in Nairobi Kenya - Your Security Solutions Partner')

@section('content')
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image" data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Contact Us</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Contact</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<contact-form></contact-form>
@endsection