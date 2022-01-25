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
        <form action="{{ route('profile.passwordUpdate') }}" method="POST">
            @csrf
            <div class="mb-3 row">
                <label for="oldPassword" class="col-sm-2 col-form-label">Current Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="oldPassword" name="oldPassword" >
                </div>
                @error('oldPassword')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="password" class="col-sm-2 col-form-label">New Password</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="usern" name="password" >
                </div>
                @error('password')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-3 row">
                <label for="password_confirmation" class="col-sm-2 col-form-label">Confirmation</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="password_confirmation" name="password_confirmation" >
                </div>
                @error('password_confirmation')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="float-end">
                <a href="{{ route('profile.index') }}" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
@endsection
