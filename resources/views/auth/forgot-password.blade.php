<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Forgot Password</title>

    <!-- Scripts -->
    <script src="http://127.0.0.1/js/app.js" defer=""></script>

    
    <!-- Fonts -->

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
       crossorigin="anonymous">


    <!-- Styles -->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css') }}">
</head>


<body id="body" class="font-sans antialiased">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark shadow-sm" id="nav">
        <div class="container-fluid position-relative">
            <img src="img/hsbc.png" href="http://127.0.0.1/login" style="width: 50px; height: 50px" >

            <a id="navText "class="text-white position-absolute top-50 start-50 translate-middle">
                HSBC Agent Monitoring and Coaching Tool
            </a>
            

                                        
            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a class="nav-link link-light me-auto" aria-current="page" href="http://127.0.0.1/login">
                    Login
                </a>
            </div>

        </div>
    </nav>

    <div class=" container-fluid col-lg-12 text-black mb-5 mt-5">
        <div class="row justify-content-between mt-5 mb-5 ">
            <div class="col-4 fluid-center mt-4 mx-5">
                <h1 id="pd" class="fs-1 ">Forgot Password?</h1>
                <p class="mt-5 fs-5">
                No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>

                <!-- Email Address -->
                <div class="mt-5">
                    <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" /> 

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf 

                        <!-- Email Address -->
                        <div>
                            <x-label for="email" :value="__('Email')" />

                            <x-input id="email" type="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="addon-wrapping"  name="email" :value="old('email')" required autofocus/>
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-button class=" btn border-0 btn-dark"  id="button2">
                                {{ __('Email Password Reset Link') }}
                            </x-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-4 fluid-center mt-1 mx-5 ">
                <img id="img" src="{{ asset('img/logo.jfif') }}" class="img-fluid rounded float-center" alt="logo" width="700" height="300">
        
            </div>
        </div>


    </div>
</body>
</html>

