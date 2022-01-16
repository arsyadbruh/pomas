@extends('layouts.appdashboard')

@section('content')
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        <input type="text" name="nama" id="nama">
        <button type="submit">Create</button>
    </form>
@endsection
