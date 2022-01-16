@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1>Edit Profile</h1>
        <hr>
        <form action="{{ route('profile.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')
            <input type="text" name="username" id="usern" value="{{ $user->username }}">
            @error('username')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <input type="email" name="email" id="email" value="{{ $user->email }}">
            @error('email')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn btn-primary">Save</button>
            <a href="{{ route('profile.index') }}" class="btn btn-danger">Cancel</a>

        </form>
    </div>
@endsection
