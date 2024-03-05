<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <title>Reports Listing</title>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    @include('navbar')


    <div class="container">


        <div class="col-md-12 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h1>Reports Listing</h1>
                </div>


                <div class="card-body">
                    <form id=filter>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="type_id">Type:</label>
                                    <select name="type_id" id="type_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="0" selected>All Types</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="reported_by">Reported By</label>
                                    <select name="reported_by" id="reported_by" class="form-control selectpicker" data-live-search="true">
                                        <option value="xxx" selected>Select a Reporter</option>
                                        @foreach($reporters as $reporter)
                                        <option value="{{ $reporter->email }}">{{ $reporter->email }}</option>

                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="medium_id">Medium:</label>
                                    <select name="medium_id" id="medium_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="0" selected>Select a medium</option>
                                        @foreach($mediums as $medium)
                                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="project_type_id">Project Type:</label>
                                    <select name="project_type_id" id="project_type_id" class="form-control selectpicker" data-live-search="true">
                                        <option value="0" selected>All Project Types</option>
                                        @foreach($project_types as $project_type)
                                        <option value="{{ $project_type->id }}">{{ $project_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="stage">Stage</label>
                                    <select name="stage_id" id="stage" class="form-control selectpicker" data-live-search="true" required>
                                        <option value="0" selected>Select a Stage</option>
                                        @foreach($stages as $stage)
                                        <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="task_owner">Task Owner</label>
                                    <select name="task_owner" id="task_owner" class="form-control selectpicker" data-live-search="true">
                                        <option value="xxx" selected>Select a Task Owner</option>
                                        @foreach($taskowners as $taskowner)
                                        <option value="{{ $taskowner->email }}">{{ $taskowner->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                        </div>
                        <div class="form-group">
                            <button type="submit">Apply Filters</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="row">
            <div class="mt-6 row offset-md-2">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Project Type</th>
                            <th>Report Date</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tasks as $task)
                        <tr>
                            <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}"> {{ $task->id }} </a></td>
                            <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">{{ $task->title }}</a></td>
                            <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">{{ $task->type }}</a></td>
                            <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">{{ $task->project_type }}</a></td>
                            <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">{{ $task->report_date }}</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>

</body>

</html>