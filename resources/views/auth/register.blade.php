<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Register </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}">

    <!-- Bootstrap css -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- App css -->
    <link href="{{ asset('assets/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style"/>
    <!-- icons -->
    <link href="{{ asset('assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Head js -->
    <script src="{{ asset('assets/js/head.js') }}"></script>
    <!-- toastr -->

    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >
    <!-- toastr -->
</head>

<div class="account-pages mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6 col-xl-4">
                <div class="card bg-pattern">

                    <div class="card-body p-4">

                        <div class="text-center w-75 m-auto">
                            <div class="auth-logo">
                                <a href="/" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <img src="{{asset('assets-front/images/logos/logo-ft.png')}}" alt="" height="80">
                                            </span>
                                </a>

                                  
                            </div>
                            <p class="text-muted mb-4 mt-3">Enter your Email/Phone/Name and password to access admin panel.</p>
                        </div>

                        <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        
        <div class="mb-3">
                                <label for="name" class="form-label">{{__('Name')}}</label>
                                <input class="form-control @error('name') is-invalid @enderror" id="name" type="text" name="name" :value="old('name')" required autofocus>
                            @error('name')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>

        <!-- Email Address -->

        <div class="mb-3">
                                <label for="email" class="form-label">{{__('Email')}}</label>
                                <input class="form-control @error('email') is-invalid @enderror" id="email" type="text" name="email" :value="old('email')" required autofocus>
                            @error('email')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>

    
        <!-- Phone Number -->
        
        <div class="mb-3">
                                <label for="name" class="form-label">{{__('Phone')}}</label>
                                <input class="form-control @error('phone') is-invalid @enderror" id="phone" type="text" name="phone" :value="old('phone')" required autofocus>
                            @error('phone')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>


        <!-- Password -->
        

        <div class="mb-3">
                                <label for="password" class="form-label">{{__('Password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password"
                                           required autocomplete="current-password"/>
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>

        <!-- Confirm Password -->
        
<div class="mb-3">
                                <label for="password_confirmation" class="form-label">{{__('Confirm Password')}}</label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                                           required autocomplete="new-password"/>
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                @error('password')
                                <span class="text-danger"> {{$message}}</span>
                                @enderror
                            </div>

        <div class="flex items-center justify-end mt-4">
            
    

            <div class="text-center d-grid">
                               
                                <button class="btn btn-primary" type="submit">  {{ __('Sign Up') }} </button>
                            </div>
        </div>
    </form>

   
</div>

<footer class="footer footer-alt">
    2023 - <script>document.write(new Date().getFullYear())</script> &copy; wabegadgets  <a href="" class="text-white-50">Wabe Studio</a>
</footer>

<!-- Vendor js -->
<script src="{{ asset('assets/js/vendor.min.js') }}"></script>

<!-- App js -->
<script src="{{ asset('assets/js/app.min.js') }}"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    @if(Session::has('message'))
    var type = "{{ Session::get('alert-type','info') }}"
    switch(type){
        case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            break;
        case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
        case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
        case 'error':
            toastr.error(" {{ Session::get('message') }} ");
            break;
    }
    @endif
</script>


</body>
</html>
