@extends('layouts.appdashboard')

@section('content')
    <div id="project">

        <div class="d-flex justify-content-between">
            <h1>Project</h1>
            <a href="{{ route('project.create') }}"
                class="btn btn-lg btn-outline-primary d-flex align-items-center justify-content-between">
                <i class="bi bi-plus-square fs-4 me-2"></i>
                <span class="fs-5">Create Project</span>
            </a>
        </div>

        <hr>
        {{-- project card --}}
        @if (session('deletedProject'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span> {{ session('deletedProject') }}</span>!
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="my-5"></div>
        <div class="row g-3">
            {{-- <p>{{ $projectData }}</p> --}}
            @foreach ($projectData as $project)
                {{-- <p>{{ $project }}</p> --}}
                @foreach ($project->users as $data)
                    <div class="col-6 col-lg-3 project-div">
                        <a href="{{ route('project.show', $data->pivot->project_id) }}"
                            class="text-decoration-none text-capitalize text-black d-flex project-card flex-column justify-content-center align-items-center">
                            <i class="bi bi-kanban text-white mx-auto"></i>
                            <span class="mx-5 my-2 text-center">{{ $project->name }}</span>
                        </a>
                        {{-- <p>ini adalah {{ $data->pivot->user_id }}</p> --}}
                    </div>
                @endforeach
            @endforeach
        </div>
    </div>
@endsection
