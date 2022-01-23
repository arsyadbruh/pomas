@extends('layouts.appdashboard')

@section('content')
    <div>
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="text-capitalize">
                <a href="{{ route('project.index') }}" class="text-black text-decoration-none">
                    <i class="bi bi-arrow-left-circle"></i>
                </a>
                {{ $project->name }}
            </h1>
            @canany(['admin', 'owner'], [$project])
                <div class="d-flex">
                    <div class="me-3">
                        @cannot('admin', [$project])
                            <form action="{{ route('project.destroy', [$project]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Delete Project</button>
                            </form>
                        @endcannot
                    </div>
                    <div>
                        <form action="{{ route('project.export') }}" method="POST">
                            @csrf
                            <input type="hidden" name="projectID" value="{{ $project->id }}">
                            <button type="submit" class="btn btn-primary">Export PDF</button>
                        </form>
                    </div>
                </div>
            @endcanany
            {{-- <div>
                <form action="{{ route('project.export') }}" method="POST">
                    @csrf
                    <input type="hidden" name="projectID" value="{{ $project->id }}">
                    <button type="submit" class="btn btn-primary">Export PDF</button>
                </form>
            </div> --}}

        </div>
        <hr>
        <div class="alert-section">
            @if (session('addMemberSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span> User <strong> {{ session('addMemberSuccess') }} </strong> has add to this project </span>!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('addMemberFail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <span> User <strong> {{ session('addMemberFail') }} </strong> is not found </span>!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('kickMemberSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>User <strong>{{ session('kickMemberSuccess') }} </strong> has kicked ! </span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('updateProjectSuccess'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session('updateProjectSuccess') }} !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('denied'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>{{ session('denied') }} !</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            @if (session('updateRole'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <span>user <strong>{{ session('deleteDeny') }} !</strong> Role updated</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>
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
                <div class="mt-4"> {{-- Task --}}
                    @canany(['admin', 'owner'], $project)
                        <form action="{{ route('task.store') }}" method="POST" id="form-task" class="row g-3">
                            @csrf
                            <div class="col-8">
                                <input class="form-control w-100" type="text" name="task" id="nameTask" placeholder="Task Name"
                                    value="{{ old('task') }}">
                                @error('task')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                                <input type="hidden" name="projectid" id="" value="{{ $project->id }}">
                            </div>
                            <div class="col-4 col-lg-2">
                                <div class='input-group'>
                                    <input type='text' class="form-control" name="taskdate" id="taskDatepicker"
                                        autocomplete="off" />
                                    <span class="input-group-text"><i class="bi bi-calendar-week"></i></span>
                                </div>
                                @error('taskdate')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-12 col-lg-2">
                                <button type="submit" class="btn btn-primary w-100">Add Task</button>
                            </div>
                        </form>
                    @endcanany

                    <div class="mt-4"> {{-- daftar tugas --}}
                        @if ($taskData->isEmpty())
                            <p class="text-center fs-2 fw-bold">Tidak ada tugas</p>
                        @else
                            <table id="table-task-project">
                                <thead>
                                    <tr>
                                        <th> </th>
                                        <th>Nama Tugas</th>
                                        <th>Penanggung Jawab</th>
                                        <th style="text-align: center;">Deadline</th>
                                        <th style="text-align: center;">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($taskData as $task)
                                        <tr>
                                            <td> {{-- checkbox --}}
                                                <input class="form-check-input m-0 cekbox" type="checkbox" name="cekbok"
                                                    style="width: 28px; height: 28px"
                                                    {{ $task->status == true ? 'checked' : null }}
                                                    value="{{ $task->id }}">
                                            </td>
                                            <td style="width: 30rem">{{ $task->name }}</td> {{-- Nama Tugas --}}
                                            <td > {{-- Penanggung Jawab --}}
                                                {{-- id user is member then just print penanggung jawab --}}
                                                @canany(['member'], [$project])
                                                    @foreach ($assignUser as $user)
                                                        @foreach ($user->projects as $item)
                                                            @if ($user->id == $task->user_id )
                                                                {{ $user->username }}
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @endforeach
                                                {{-- if user is admin and is owner then print selection --}}
                                                @elsecanany(['admin', 'owner'], [$project])
                                                    <select class="form-select" id="assign-user" name="selecting"
                                                        aria-label="Default select example" style="width:fit-content;">
                                                        <option value="none">None</option>
                                                        <option value="{{ $task->id }}" hidden class="task-option-id">
                                                        </option>
                                                        @foreach ($assignUser as $user)
                                                            @foreach ($user->projects as $item)
                                                                @if ($project->id == $item->pivot->project_id)
                                                                    <option value="{{ $user->id }}"
                                                                        {{ $user->id == $task->user_id ? 'selected' : '' }}>
                                                                        {{ $user->username }}</option>
                                                                @endif
                                                            @endforeach
                                                        @endforeach
                                                    </select>
                                                @endcanany
                                            </td>
                                            <td style="text-align: center;">
                                                {{ date('d F Y', strtotime($task->deadline)) }}</td>
                                            <td style="text-align: center;"> {{-- action --}}
                                                <div class="d-flex flex-column flex-lg-row justify-content-center">
                                                    <a href="{{ route('task.show', ['task' => $task->id, 'project_id' => $project->id]) }}" class="btn btn-primary me-2">Detail</a>
                                                    @canany(['admin', 'owner'], [$project])
                                                        <form action="{{ route('task.destroy', [$task->id]) }}" method="POST">
                                                            @csrf
                                                            @method('delete')
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    @endcanany
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        @endif
                        <div class="add-more-margin-bottom"></div>
                    </div>

                </div>
            </div>

            <div class="tab-pane fade" id="nav-setting-project" role="tabpanel" aria-labelledby="nav-setting-project-tab">
                <div class="mt-4">
                    <form action="{{ route('project.update', [$project]) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="name-project-form" class="form-label">Nama Project</label>
                            <input type="text" class="form-control" name="projectname" id="name-project-form"
                                placeholder="name@example.com" value="{{ $project->name }}">
                        </div>
                        <div class="mb-3">
                            <label for="desc-project-form" class="form-label">Description</label>
                            <textarea class="form-control" name="projectdesc" id="desc-project-form"
                                rows="3">{{ $project->description }}</textarea>
                        </div>
                        <button type="submit"
                        class="btn btn-primary"
                        @canany(['member'], [$project]) disabled @endcanany> {{-- if user member then disable button --}}
                            Update
                        </button>
                    </form>
                </div>
                <div class="my-4">
                    <h3>Daftar Anggota Team</h3>
                    @canany(['admin', 'owner'], [$project])
                        <form action="{{ route('project.addMember') }}" method="POST" class="row g-3">
                            @csrf
                            <div class="col-8">
                                <input type="text" name="member" id="member" class="form-control">
                                @error('member')
                                    <span class="text-danger">{{ $message }} !</span>
                                @enderror
                                <input type="hidden" name="projectID" value="{{ $project->id }}">
                            </div>
                            <div class="col-4">
                                <button type="submit" class="btn btn-primary w-100">Add Member</button>
                            </div>
                        </form>
                    @endcanany
                    <div class="mt-3">

                        <table id="table-team-project">
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assignUser as $users)
                                    @foreach ($users->projects as $item)
                                        @if ($project->id == $item->pivot->project_id)
                                            <tr>
                                                <td>{{ $users->username }}</td>
                                                <td>{{ $users->email }}</td>
                                                <td>
                                                    @canany(['owner', 'admin'], [$project])
                                                        @if($item->pivot->role === 'owner')
                                                            {{ $item->pivot->role }}
                                                        @else
                                                            <select class="form-select" name="user-role" id="user-role">
                                                                <option value="{{ $project->id }}" hidden class="task-option-id">
                                                                <option value="{{ $users->id }}"
                                                                    {{ $item->pivot->role === 'member' ? 'selected' : '' }}>member</option>
                                                                <option value="{{ $users->id  }}"
                                                                    {{ $item->pivot->role === 'admin' ? 'selected' : '' }}>admin</option>
                                                            </select>
                                                        @endif

                                                    @elsecan('member', [$project])
                                                        {{ $item->pivot->role }}
                                                    @endcanany
                                                </td>
                                                @canany(['owner'], [$project])
                                                    <td style="text-align: right;">
                                                        <form action="{{ route('project.kickMember') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" name="emailMember"
                                                                value="{{ $users->email }}">
                                                            <input type="hidden" name="projectID"
                                                                value="{{ $project->id }}">
                                                            <button type="submit" class="btn btn-danger">Kick</button>
                                                        </form>
                                                    </td>
                                                @endcanany
                                            </tr>
                                        @endif
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="add-more-margin-bottom"></div>
            </div>
        </div>

    </div>

    <div class="toast-container  position-fixed bottom-0 end-0 p-3">

        <div id="liveToastChecked" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <i class="bi bi-check-circle-fill fs-4 text-success me-3"></i>
                <strong class="me-auto">Task</strong>
                <small>3 second</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                Task Completed
            </div>
        </div>

        <div id="liveToastUnCheck" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header bg-danger">
                <i class="bi bi-x-circle-fill me-3 fs-4 text-white"></i>
                <strong class="me-auto text-white">Task</strong>
                <small class="text-white">3 second</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body bg-danger">
                <span class="text-white"> Mark as uncompleted</span>
            </div>
        </div>
    </div>



    <script>
        $(document).ready(function() {
            $('select#assign-user').change(function() {
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
         $(document).ready(function() {
            $('select#user-role').change(function() {
                let data_id = $(this).find('.task-option-id').val();
                let selectedData = $(this).val();
                let selectedText = $(this).find('option:selected').text();
                // console.log("data : ",selectedData === "none");
                // console.log("text : ",selectedText);
                // console.log("id input : ",data_id);
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: "/updateRole",
                    data: {
                        'project_id': data_id,
                        'selectedUser': selectedData,
                        'selectedRole' : selectedText
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
