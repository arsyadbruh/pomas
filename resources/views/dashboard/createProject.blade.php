@extends('layouts.appdashboard')

@section('content')
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        <input type="text" name="name" id="name" placeholder="Nama Project">
        @error('name')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <label for="description">Deskripsi Project</label>
        <input type="text" name="description" id="description">
        @error('description')
            <p class="text-danger">{{ $message }}</p>
        @enderror
        <button type="submit">Create</button>
    </form>
@endsection
