@extends('layouts.authapp')

@section('content')


    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Sign in</button>
        <span>Belum punya akun ? <a href="{{ route('register') }}">Daftar Sekarang</a> </span>

    </form>

@endsection
