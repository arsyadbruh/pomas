<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Project {{ $project->name }}</title>
    <style>
        .general-information {
            margin-top: 30px;
        }

        .general-information,
        .teams-information {
            margin-bottom: 20px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 6px;
        }
    </style>
</head>
<body>
    <h2 style="margin-bottom: 7px">{{ $project->name }}</h2>
    <span>Project manage with POMAS</span>
    <hr>
    <div class="general-information">
        <table>
            <thead>
                <tr style="background-color: #ddd;"><th colspan="2">General Information</th></tr>
            </thead>
            <tbody>
                <tr>
                    <td style="width: 150px">Project Name</td>
                    <td>{{ $project->name }}</td>
                </tr>
                <tr>
                    <td style="width: 150px">Project Description</td>
                    <td>{{ $project->description }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="teams-information">
        <table>
            <thead>
                <tr style="background-color: #ddd;"><th colspan="2">Project Teams</th></tr>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($userData as $users)
                    @foreach ($users->projects as $user)
                        @if ($project->id == $user->pivot->project_id)
                            <tr>
                                <td>{{ $users->username }}</td>
                                <td>{{ $users->email }}</td>
                            </tr>
                        @endif
                    @endforeach
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="task-information">
        <hr>
        <h3>Activity Information</h3>
        <table>
            <thead>
                <tr>
                    <th>Task Name</th>
                    <th>Deadline</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($taskData as $task)
                    <tr>
                        <td>{{ $task->name }}</td>
                        <td>{{ $task->deadline }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</body>
</html>
