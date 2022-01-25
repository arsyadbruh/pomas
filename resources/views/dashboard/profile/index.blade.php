@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1>User Profile</h1>
        <hr>
        @if (session('profileSuccess'))
            <div class="alert alert-success alert-dismissible fade show " role="alert">
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
        <div class="card">
            <div class="card-header">
                Informasi Pribadi
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between my-3">
                    <span>Name</span>
                    <span>{{ $userProfile->name }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between my-3">
                    <span>Username</span>
                    <span>{{ $userProfile->username }}</span>
                </div>
                <hr>
                <div class="d-flex justify-content-between my-3">
                    <span>Email</span>
                    <span>{{ $userProfile->email }}</span>
                </div>
                <hr>
                <a href="{{ route('profile.edit', $userProfile->id) }}" class="btn btn-primary float-end">Edit Profile</a>
            </div>
        </div>

        <div class="card mt-4">
            <div class="card-header">
                Keamanan
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-between my-4">
                    <span>Verifikasi 2 Langkah</span>
                    <span> <strong>coming soon</strong> </span>
                </div>
                <hr>
                <div class="d-flex justify-content-between my-4">
                    <span>Sandi</span>
                    <a href="{{ route('profile.passwordEdit') }}" class="btn btn-md btn-primary">Edit Password</a>
                </div>
            </div>
        </div>

        <div class="mb-5"></div>

    </div>
@endsection
