<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcut icon" href="{{ asset('img/logo.png') }}" type="image/x-icon">

    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    {{-- google font --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;900&display=swap"
        rel="stylesheet">

    {{-- Javascript --}}
    <script src="{{ asset('js/app.js') }}"></script>
</head>

<body>

    {{-- Header Navabr --}}
    <header class="navbar navbar-dark navbar-expand-lg sticky-top flex-md-nowrap p-0 shadow-sm justify-content-start justify-content-lg-between">
        <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('welcome') }}">POMAS</a>
        <ul class="navbar-nav px-3">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    {{ Auth::user()->username }}
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li>
                        <a href="{{ route('profile.index') }}" class="dropdown-item">
                            Profile
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                            onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

    </header>

    <div class="container-fluid">
        <div class="row">
            {{-- Sidebar --}}

            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link {{ $pageTitle === 'myproject' ? 'active' : 'text-white'  }}"  href="{{ route('project.index') }}">
                                <i class="bi {{ $pageTitle === 'myproject' ? 'bi-house-door-fill' : 'bi-house' }}"></i>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ $pageTitle === 'mytask' ? 'active' : 'text-white'  }}" href="{{ route('mytask') }}">
                            <i class="bi {{ $pageTitle === 'mytask' ? 'bi-check-circle-fill' : 'bi-check-circle' }}"></i>
                                My Task
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link  {{ $pageTitle === 'setting' ? 'active' : 'text-white'  }}" href="#">
                            <i class="bi {{ $pageTitle === 'inbox' ? 'bi-inbox-fill' : 'bi-inbox' }}"></i>
                                inbox
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-white" href="#">
                            <i class="bi bi-question-circle-fill"></i>
                                Help
                            </a>
                        </li>
                    </ul>

                </div>
            </nav>

            {{-- Main content --}}
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 mt-3">
                @yield('content')
            </main>
        </div>
    </div>


</body>

</html>
