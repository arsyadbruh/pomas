@extends('layouts.appdashboard')

@section('content')
    <h1>My Task</h1>
    {{-- <div class="divider"></div> --}}
    <hr>

    @foreach ($projectData as $project)
        @foreach ($project->users as $data)
            @foreach ($taskData as $task)
            {{-- jika user tergabung dalam project dan punya tugas pada project tersebut --}}
                @if ($task->project_id == $data->pivot->project_id)
                    <div class="d-flex align-items-center border-bottom mt-3 toggle-collpase-task">
                        <a class="text-decoration-none fw-bold text-capitalize" role="button" data-bs-toggle="collapse"
                            href="#collapse{{ $project->id }}" aria-expanded="false" aria-controls="collapse{{ $project->id }}">
                            <i class="bi bi-caret-right-fill"></i> {{ $project->name }}</a>
                    </div>
                    @break
                @endif
            @endforeach
        @endforeach

        @foreach ($taskData as $task)
            @if ($task->project_id == $project->id)
                <div class="collapse my-2" id="collapse{{ $task->projects->id }}">
                    <div class="card card-body">
                        <p>{{ $task->name }}</p>
                    </div>
                </div>
            @endif
        @endforeach
    @endforeach

    <script>
        $(document).ready(function() {
            $('.toggle-collpase-task').on('click', 'a', function() {
                let iconToggle = $(this).find('i');
                // console.log(iconToggle);
                iconToggle.toggleClass('bi-caret-right-fill bi-caret-down-fill');
            });
        });
    </script>

@endsection
