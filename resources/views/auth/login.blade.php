<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> HSBC Agent Monitoring and Coaching Tool</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
     <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
       crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/login.css') }}">
</head>

<body class="font-sans antialiased">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark shadow-sm" id="nav">
        <div class="container-fluid">
            <img src="img/hsbc.png" style="width: 50px; height: 50px">
            <a id="navText"class="navbar navbar-brand" href="{{ url('/') }}">
                HSBC Agent Monitoring and Coaching Tool
            </a>
                                    
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->
                    @guest
                        @if (Route::has('login'))
                            <li class="nav-item ">
                                <a class="nav-link active" id="navText" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                        @endif
                        
                    @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name }}
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class=" container-fluid col-lg-12 text-black mb-5 mt-5">
        <div class="row justify-content-between mt-5 mb-5 ">
            <div class="col-4 fluid-center mx-5 my-5 ">
                <h1 id="pd" class="fs-1 mb=5">Web Agent Monitoring and Coaching Tool</h1>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4" :status="session('status')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form method="POST" action="{{ route('login') }}">

                @csrf
                <!-- Email Address -->
                <div class="mt-5">
                    <x-label for="email" :value="__('Please enter your email')" />
                    <input id="email" type="email" class="form-control" placeholder="Email" aria-label="email" aria-describedby="addon-wrapping"  name="email" :value="old('email')" required autofocus>
                </div>

                <!-- Password -->
                <div class="mt-5">
                    <x-label for="password" :value="__('Please enter your password:')" />

    
                    <input id="password" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="addon-wrapping"  name="password" required autocomplete="current-password">
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-600">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="d-flex justify-content-between d-grid gap-2">
                    <div class="mt-5 mr-auto justify-content-md-start">
                        @if (Route::has('password.request'))
                            <a class="link-dark" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>

                    <div class="mt-5 justify-content-md-end">
                        <x-button class="ml-5 btn border-0 btn-dark" id="button">
                            {{ __('Log in') }}
                        </x-button>
                    </div>
                </div>

            </div>
        
            <div class="col-4 fluid-center mt-5 mx-5 my-5">
                <img id="img" src="{{ asset('img/logo.jfif') }}" class="img-fluid rounded float-center" alt="logo" width="700" height="300">
        
            </div>
        </div>
    </div>

</body>
</html>






