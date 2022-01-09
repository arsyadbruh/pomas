<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POMAS</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    {{-- css --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <style>
        html,
        body {
            height: 100%;
            font-size: 16px;
        }

        body {
            display: flex;
            align-items: center;
        }

        .text-content {
            width: 100%;
            max-width: 350px;

        }

        .title-brand {
            font-weight: 900;
            font-size: 4rem;
            color: #ff4343;
        }

        .form-content {
            width: 100%;
            max-width: 400px;
            padding: 15px;
        }

    </style>
</head>

<body>
    <main class="w-100 m-auto">
        <div class="container d-flex justify-content-center justify-content-lg-between align-items-center flex-wrap">
            <div class="text-content">
                <h1 class="title-brand">POMAS</h1>
                <p class="fs-5">Project Manager Application Website. Kelola project mu dengan lebih simple dan
                    mudah</p>
            </div>
            <div class="form-content">
                @yield('content')
            </div>
        </div>
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
</body>

</html>
