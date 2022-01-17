@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1>{{ $projectData->name }}</h1>
        <hr>
        @if (session('taskSuccess'))
            <p>Sukses adding</p>
        @endif
        <form action="{{ route('task.store') }}" method="POST" id="form-task">
            @csrf
            <input type="text" name="task" id="nameTask" placeholder="Task Name">
            <input type="hidden" name="project" id="" value="{{ $projectData->id }}">
            @error('task')
                <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>

        <div class="mt-4">
            @if ($taskData->isEmpty())
                <p>Tidak ada tugas</p>
            @else
                @foreach ($taskData as $task)
                    <div class="form-check d-flex align-items-center justify-content-between mb-3">
                        <div>
                            <input class="form-check-input m-0 cekbox" type="checkbox" name="cekbok"
                                style="width: 28px; height: 28px" {{ $task->status == true ? 'checked' : null }}
                                value="{{ $task->id }}">
                            <label class="form-check-label fs-4 ms-3">{{ $task->name }}</label>
                        </div>
                        <div class="action-section">
                            <form action="{{ route('task.destroy', [$task->id]) }}" method="POST">
                                <a href="#" class="btn btn-primary">Detail</a>
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </div>
                    </div>
                    <hr>
                @endforeach
            @endif
        </div>
    </div>

    <div class="toast-container  position-absolute bottom-0 end-0 p-3">

            <div id="liveToastChecked" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="" class="rounded me-2" alt="...">
                    <strong class="me-auto">Task</strong>
                    <small>3 second</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Task Completed
                </div>
            </div>

            <div id="liveToastUnCheck" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="" class="rounded me-2" alt="...">
                    <strong class="me-auto">Task</strong>
                    <small>3 second</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    Mark as Completed
                </div>
            </div>
    </div>



    <script>
        $(function() {
            $('.cekbox').change(function(event) {
                event.preventDefault();

                let statusChecked = $(this).is(':checked');
                let isCheck = statusChecked ? 1 : 0;
                let data_id = $(this).val();
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: '/taskupdate',
                    data: {
                        'status': isCheck,
                        'data_id': data_id
                    }
                })

                let toastLiveChecked = document.getElementById('liveToastChecked');
                let toastLiveUnCheck = document.getElementById('liveToastUnCheck');

                let toast = new bootstrap.Toast(toastLiveChecked)
                let toastUn = new bootstrap.Toast(toastLiveUnCheck);

                if (statusChecked) {
                    toast.show();
                } else {
                    toastUn.show();
                }

            });
        });
    </script>
@endsection
