@extends('layouts.appdashboard')

@section('content')
    <div>
        <h1 class="text-capitalize">
            <a href="{{ route('project.index') }}" class="text-black text-decoration-none">
                <i class="bi bi-arrow-left-circle"></i>
            </a>
            {{ $projectData->name }}
        </h1>
        <hr>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-task-tab" data-bs-toggle="tab" data-bs-target="#nav-task"
                    type="button" role="tab" aria-controls="nav-task" aria-selected="true">Task</button>
                <button class="nav-link" id="nav-setting-project-tab" data-bs-toggle="tab"
                    data-bs-target="#nav-setting-project" type="button" role="tab" aria-controls="nav-setting-project"
                    aria-selected="false">Setting</button>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-task" role="tabpanel" aria-labelledby="nav-task-tab">
                <div class="mt-4">
                    <form action="{{ route('task.store') }}" method="POST" id="form-task" class="row g-3">
                        @csrf
                        <div class="col-8">
                            <input class="form-control w-100" type="text" name="task" id="nameTask" placeholder="Task Name">
                            <input type="hidden" name="project" id="" value="{{ $projectData->id }}">
                            @error('task')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary w-100">Add Task</button>
                        </div>
                    </form>

                    <div class="mt-4">
                        @if ($taskData->isEmpty())
                            <p>Tidak ada tugas</p>
                        @else
                            @foreach ($taskData as $task)
                                <div class="form-check d-flex align-items-center justify-content-between mb-3">
                                    <div>
                                        <input class="form-check-input m-0 cekbox" type="checkbox" name="cekbok"
                                            style="width: 28px; height: 28px"
                                            {{ $task->status == true ? 'checked' : null }} value="{{ $task->id }}">
                                        <label class="form-check-label fs-4 ms-3">{{ $task->name }}</label>
                                    </div>
                                    <div class="action-section d-flex">
                                        <div class="selection me-3">
                                            <select class="form-select" name="selecting"
                                                aria-label="Default select example">
                                                <option value="none">None</option>
                                                <option value="{{ $task->id }}" hidden class="task-option-id"></option>
                                                @foreach ($assignUser as $user)
                                                    @foreach ($user->projects as $item)
                                                        @if ($projectData->id == $item->pivot->project_id)
                                                            <option value="{{ $user->id }}"
                                                                {{ $user->id == $task->user_id ? 'selected' : '' }}>
                                                                {{ $user->username }}</option>
                                                        @endif
                                                    @endforeach

                                                @endforeach
                                            </select>
                                        </div>
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
            </div>

            <div class="tab-pane fade" id="nav-setting-project" role="tabpanel" aria-labelledby="nav-setting-project-tab">
                <div class="mt-4">
                    @if (session('addMemberSuccess'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('addMemberSuccess') }} !</strong> Member with
                            {{ session('emailMember') }}
                            has added to this project
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <form action="{{ route('project.addMember') }}" method="POST" class="row g-3">
                        @csrf
                        <div class="col-8">
                            <input type="text" name="member" id="member" class="form-control">
                            @error('member')
                                <span class="text-danger">{{ $message }} !</span>
                            @enderror
                            <input type="hidden" name="projectID" value="{{ $projectData->id }}">
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary w-100">Add Member</button>
                        </div>
                    </form>
                    <h3>Daftar Anggota Team</h3>
                    <div class="mt-3">
                        @foreach ($assignUser as $user)
                            @foreach ($user->projects as $item)
                                @if ($projectData->id == $item->pivot->project_id)
                                    <p>Username : {{ $user->username }}</p>
                                    <p>E-mail : {{ $user->email }}</p>
                                    <hr>
                                @endif
                            @endforeach

                        @endforeach
                    </div>
                </div>
            </div>
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
        $(document).ready(function() {
            $('select.form-select').change(function() {
                let data_id = $(this).find('.task-option-id').val();
                let selectedData = $(this).val();
                // let selectedText = $(this).find('option:selected').text();
                // console.log("data : ",selectedData === "none");
                // console.log("text : ",selectedText);
                // console.log("id input : ",data_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/taskAssign",
                    data: {
                        'data_id': data_id,
                        'selected': selectedData
                    },
                    success: function(data) {
                        console.log('success change status');
                    }
                });
            })
        });
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
