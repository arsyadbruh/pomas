@extends('layouts.appdashboard')

@section('content')
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <span> User <strong> {{ session('success') }} </strong> </span>!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span> User <strong> {{ session('error') }} </strong> </span>!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="d-flex justify-content-center align-items-center ">
        <form action="{{ route('task.update', [$task->id]) }}" method="POST" class="w-100">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-6 mb-3">
                    <label for="taskname" class="form-label">Nama Tugas</label>
                    <input type="text" class="form-control" id="taskname" value="{{ $task->name }}" name="taskname">
                </div>
                <div class="col-6 mb-3">
                    <label for="tanggal" class="form-label">Tanggal</label>
                    <div class="input-group">
                        <input type="text" class="form-control" name="taskdate" value="{{ date('Y/m/d', strtotime($task->deadline)) }}" id="taskDatepicker" autocomplete="off">
                        <span class="input-group-text"><i class="bi bi-calendar-week"></i></span>
                    </div>

                </div>
                <div class="col-12 mb-3">
                    <label for="taskdesc" class="form-label">Task Description</label>
                    <textarea class="form-control" id="taskdesc" rows="3" name="taskdesc">{{ $task->description }}</textarea>
                </div>
                <div class="col-12">
                    <a href="{{ route('project.show', [$projectID]) }}" class="btn btn-danger">back</a>
                    <button type="submit" class="btn btn-primary float-end">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('js-script')

<script>
    $(function() {
        $('#taskDatepicker').datepicker({
            format: "yyyy/mm/dd",
            weekStart: 0,
            calendarWeeks: true,
            autoclose: true,
            todayHighlight: true
        });
    });
</script>

@endsection


