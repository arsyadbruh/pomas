<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>POMAS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <style>
        html,
        body {
            height: 100%;
            font-size: 16px;
        }
    </style>

</head>

<body class="d-flex justify-content-center align-items-center">
    <div>
        <h1 class="fw-bold text-danger">POMAS</h1>
        @auth
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-lg btn-danger">Logout</button>
            </form>
            @else
            <p><a href="{{ route('login') }}">Go to Login</a></p>
        @endauth
    </div>
</body>

</html>
