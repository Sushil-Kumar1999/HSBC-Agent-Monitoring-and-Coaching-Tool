@extends('layouts.navigationbar')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="dA6hUZXf43T4RjxrQdvQUSnWfvKuOZVMjP9enwoX">

    <title> Edit Supervisor</title>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&amp;display=swap">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
    crossorigin="anonymous">


    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navbar.css') }}">
    <link rel="stylesheet" href="{{asset('css/agentdashboard.css') }}">
    <link rel="stylesheet" href="{{asset('css/splitviewdashboard.css') }}">
    <link rel="stylesheet" href="{{asset('css/rewardviewer.css') }}">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer=""></script>

</head>

<body class="font-sans antialiased">
    <nav class="navbar fixed-top navbar-expand-md navbar-dark shadow-sm" id="nav">
        <div class="container-fluid position-relative">
            <img src="{{ asset('img/hsbc.png') }}" href="{{ route('admin.index') }}" style="width: 50px; height: 50px">

            <a class="nav-link link-light me-auto" aria-current="page" href="{{ route('admin.index') }}">
                Admin Dashboard
            </a>

            <a id="navText "class="text-white position-absolute top-50 start-50 translate-middle">
                HSBC Agent Monitoring and Coaching Tool
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="relative" x-data="{ open: false }" @click.outside="open = false" @close.stop="open = false">
                    <div @click="open = ! open">
                        <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                            <div id="dropdown">{{ Auth::user()->name }}

                            </div>

                            <div class="ml-1">
                                <svg id="dropdown" class="fill-current h-4 w-4 " xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </button>
                    </div>

                    <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" class="absolute z-50 mt-2 w-48 rounded-md shadow-lg origin-top-right right-0" style="display: none;" @click="open = false">
                        <div class="rounded-md ring-1 ring-black ring-opacity-5 py-1 bg-white">
                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <a class="block px-4 py-2 text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    this.closest('form').submit();">Log Out</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Navigation Menu -->
            <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
                <div class="pt-2 pb-3 space-y-1">
                    <a class="block pl-3 pr-4 py-2 border-l-4 border-indigo-400 text-base font-medium text-indigo-700 bg-indigo-50 focus:outline-none focus:text-indigo-800 focus:bg-indigo-100 focus:border-indigo-700 transition duration-150 ease-in-out" href="http://127.0.0.1/agentdashboard">
                            Admin Dashboard
                    </a>
                </div>

                <!-- Responsive Settings Options -->
                <div class="pt-4 pb-1 border-t border-gray-200">
                    <div class="px-4">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>

                    <div class="mt-3 space-y-1">
                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            <input type="hidden" name="_token" value="dA6hUZXf43T4RjxrQdvQUSnWfvKuOZVMjP9enwoX">
                            <a class="block pl-3 pr-4 py-2 border-l-4 border-transparent text-base font-medium text-gray-600 hover:text-gray-800 hover:bg-gray-50 hover:border-gray-300 focus:outline-none focus:text-gray-800 focus:bg-gray-50 focus:border-gray-300 transition duration-150 ease-in-out" href="http://127.0.0.1/logout" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    Log Out
                            </a>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </nav>

    <div class="mt-3">
        <main>
            <div class="mt-5 p-3">
                <div class="py-12">
                    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" >
                        <div id="supervisor" class="p-3  overflow-hidden shadow-sm ">
                            <h2 class="font-semibold text-xl text-800 leading-tight">
                               Edit Supervisor : {{$user->name}}
                            </h2>

                        </div>

                        <div class="p-6 bg-white border-b border-gray-200">
                            <form method="POST" action="{{ route('admin.updateSupervisor', $user) }}">
                                @csrf

                                <label class="fs-5 pb-0" for="name">Name:</label>
                                <br></br>
                                <textarea input type="text" id="name" name="name" rows="1" cols="50" value="{{ old('name') }}"
                                    >{{$user->name}}</textarea>
                                <br></br>

                                <label class="fs-5 pb-0" for="email">Email:</label>
                                <br></br>
                                <textarea input type="text" id="email" name="email" rows="1" cols="50" value="{{ old('email') }}"
                                    >{{$user->email}}</textarea>
                                <br></br>

                                <label class="fs-5 pb-0" for="team_name">Team:</label>
                                <br></br>
                                <textarea input type="text" id="team_name" name="team_name" rows="1" cols="50" value="{{ old('team_name') }}"
                                    >{{$user->supervises()->first()->name}}</textarea>
                                <br></br>

                                <button style="width: 470px;" class="mb-3 mt-2 d-grid text-white btn border-0 btn-dark" type='sumbit'>Edit</button>
                                <a class="fs-5 mt-2 pt-3" href="{{route('admin.supervisorDetails', [$user])}}">Cancel</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
