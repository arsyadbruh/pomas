@extends('layouts.appdashboard')

@section('content')
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-12">
                <label for="name" class="form-label">Nama Project</label>
                <input type="text" name="name" id="name" class="form-control">
                @error('name')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 mt-3">
                <label for="description"  class="form-label">Deskripsi Project</label>
                <input type="text" name="description" id="description"  class="form-control">
                @error('description')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary">Create</button>
            </div>
        </div>
    </form>
@endsection
