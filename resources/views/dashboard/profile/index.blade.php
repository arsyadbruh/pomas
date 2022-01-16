@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1>User Profile</h1>
        <hr>
        @if (session('profileSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Profile Updated !</strong> Your profile has been successfuly updated
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session('passwordSuccess'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>{{ session('passwordSucesss') }}</strong> Your password has been change
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <h4>Username : {{ $userProfile->username }}</h4>
        <h4>Email : {{ $userProfile->email }}</h4>
        <a href="{{ route('profile.edit', $userProfile->id) }}" class="btn btn-md btn-primary">Edit Profile</a>
        <a href="{{ route('profile.passwordEdit') }}" class="btn btn-md btn-primary">Edit Password</a>
    </div>
@endsection
