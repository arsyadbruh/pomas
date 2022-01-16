@extends('layouts.appdashboard')

@section('content')
<div id="project">

    <div class="d-flex justify-content-between">
        <h1>Project</h1>
        <a href="{{ route('project.create') }}" class="btn btn-lg btn-outline-primary d-flex align-items-center justify-content-between">
            <i class="bi bi-plus-square fs-4 me-2"></i>
            <span class="fs-5">Create Project</span>
        </a>
    </div>

    <hr>
    {{-- project card --}}
    <div class="my-5"></div>
    <div class="row g-3">
        {{-- <p>{{ $test }}</p> --}}
        @foreach ($projectData as $project)
            @foreach ($project->users as $data)
                <div class="col-6 col-lg-3">
                    <a href="{{ route('project.show', $data->pivot->project_id) }}">
                        <div class="d-flex project-card flex-column justify-content-center align-items-center">
                            <i class="bi bi-kanban text-white mx-auto"></i>
                            <span class="mx-5 my-2 text-center">{{ $project->name }}</span>
                        </div>
                    </a>
                </div>
            @endforeach
        @endforeach
    </div>
</div>
@endsection
