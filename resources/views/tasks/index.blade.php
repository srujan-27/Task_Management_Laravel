<!DOCTYPE html>
<html>
<head>
    <title>Task Manager</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .task-item {
            padding: 10px;
            margin: 5px 0;
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            cursor: move;
        }
    </style>
</head>
<body class="p-4">
    <div class="container">
        <h2 class="mb-4">📝 Task Manager</h2>

        {{-- Project Filter --}}
        <form method="GET" action="/">
            <div class="mb-3 d-flex gap-2">
                <select name="project_id" class="form-select w-auto">
                    <option value="">All Projects</option>
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $projectId == $project->id ? 'selected' : '' }}>
                            {{ $project->name }}
                        </option>
                    @endforeach
                </select>
                <button class="btn btn-primary">Filter</button>
            </div>
        </form>

        {{-- Create Project --}}
<form method="POST" action="{{ route('projects.store') }}" class="mb-4 d-flex gap-2">
    @csrf
    <input type="text" name="name" placeholder="New Project Name" class="form-control" required>
    <button class="btn btn-secondary">Add Project</button>
</form>


        {{-- Create Task --}}
        <form method="POST" action="{{ route('tasks.store') }}" class="mb-4">
            @csrf
            <div class="row g-2">
                <div class="col-md-6">
                    <input type="text" name="name" placeholder="Task Name" class="form-control" required>
                </div>
                <div class="col-md-4">
                    <select name="project_id" class="form-select">
                        <option value="">Select Project (optional)</option>
                        @foreach($projects as $project)
                            <option value="{{ $project->id }}">{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <button class="btn btn-success w-100">Add Task</button>
                </div>
            </div>
        </form>

        {{-- Task List --}}
        <ul id="task-list" class="list-unstyled">
            @foreach($tasks as $task)
                <li class="task-item" data-id="{{ $task->id }}">
                    <form method="POST" action="{{ route('tasks.update', $task->id) }}" class="d-flex align-items-center justify-content-between mb-2">
    @csrf @method('PUT')
    <input type="text" name="name" value="{{ $task->name }}" class="form-control me-2" style="width:70%;">
    <button class="btn btn-sm btn-primary me-1">Update</button>
</form>

<form method="POST" action="{{ route('tasks.destroy', $task->id) }}" class="d-inline">
    @csrf @method('DELETE')
    <button class="btn btn-sm btn-danger">Delete</button>
</form>

                </li>
            @endforeach
        </ul>
    </div>

    {{-- jQuery + Drag & Drop --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    <script>
        $(function () {
            $("#task-list").sortable({
                update: function () {
                    let order = [];
                    $(".task-item").each(function () {
                        order.push($(this).data("id"));
                    });

                    $.ajax({
                        url: "{{ route('tasks.reorder') }}",
                        method: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr("content"),
                            order: order
                        },
                        success: function () {
                            console.log("Order updated.");
                        }
                    });
                }
            });
        });
    </script>
</body>
</html>
