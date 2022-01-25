@extends('layouts.authapp')

@section('content')

<form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('username') is-invalid @enderror" id="username" name="username"
                placeholder="Username" value="{{ old('username') }}">
            <label for="username">Username</label>
            @error('username')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name"
                placeholder="Name" value="{{ old('name') }}">
            <label for="name">Name</label>
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
                placeholder="Email" value="{{ old('email') }}">
            <label for="email">Email address</label>
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password"
                placeholder="Password">
            <label for="password">Password</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="form-floating mb-3">
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                placeholder="Password Confirm">
            <label for="password-confirm">Confirmation Password</label>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Register</button>
        <span>Sudah punya akun <a href="{{ route('login') }}">Login</a> </span>

</form>
@endsection
