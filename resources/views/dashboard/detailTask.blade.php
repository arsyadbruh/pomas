@extends('layouts.appdashboard')

@section('content')
    <div class="d-flex justify-content-center align-items-center ">
        <form action="" class="w-100">
            <div class="mb-3">
                <label for="taskname" class="form-label">Nama Tugas</label>
                <input type="email" class="form-control" id="taskname" value="{{ $task->name }}">
            </div>
            <div class="mb-3">
                <label for="taskdesc" class="form-label">Task Description</label>
                <textarea class="form-control" id="taskdesc" rows="3">{{ $task->description }}</textarea>
            </div>
            <a href="{{ route('project.show', [$projectID]) }}" class="btn btn-danger">back</a>
            <button type="submit" class="btn btn-primary float-end">Update</button>
        </form>
    </div>
@endsection
