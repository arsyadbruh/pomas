@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1>Edit Profile</h1>
        <hr>
        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <form action="{{ route('profile.passwordUpdate')}}" method="POST">
        @csrf
            <input type="text" name="oldPassword" id="oldPassword" placeholder="Current Password">
            @error('oldPassword')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="text" name="password" id="password" placeholder="New Password">
            @error('password')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <input type="text" name="password_confirmation" id="password_confirmation" placeholder="Password Confirmation">
            @error('password_confirmation')
                <p class="text-danger">{{$message}}</p>
            @enderror
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('profile.index') }}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection
