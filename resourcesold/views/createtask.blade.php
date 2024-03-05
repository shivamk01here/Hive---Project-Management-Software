<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Laravel Registration</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        Create Task
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route ('kaamdekh.create') }}">
                            @csrf

                            <div class="form-group">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type_id" id="type" class="form-control selectpicker" data-live-search="true" required>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>

                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="reported_by">Reported By</label>
                                <select name="reported_by" id="reported_by" class="form-control selectpicker" data-live-search="true" >
                                    @foreach($reporters as $reporter)
                                    <option value="{{ $reporter->email }}">{{ $reporter->email }}</option>



                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="medium">Medium</label>
                                <select name="medium_id" id="medium" class="form-control selectpicker" data-live-search="true" >
                                    @foreach($mediums as $medium)
                                    <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="project_type">Project Type</label>
                                <select name="project_type_id" id="project_type" class="form-control selectpicker" data-live-search="true" required>
                                    @foreach($project_types as $project_type)
                                    <option value="{{ $project_type->id }}">{{ $project_type->name }}</option>
                                    @endforeach
                                    
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="stage">Stage</label>
                                <select name="stage_id" id="stage" class="form-control selectpicker" data-live-search="true" required>
                                    @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>

                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group">
                                <label for="task_owner">Task Owner</label>
                                <select name="task_owner" id="task_owner" class="form-control selectpicker" data-live-search="true" >
                                    @foreach($taskowners as $taskowner)
                                    <option value="{{ $taskowner->email }}">{{ $taskowner->email }}</option>

                                    @endforeach

                                </select>
                            </div>

                            <div class="form-group datepicker">
                                <label for="report_date">Report Date</label>
                                <input type="date" name="report_date" id="report_date" class="form-control" required>
                            </div>

                            <div class="form-group datepicker">
                                <label for="due_date">Due Date</label>
                                <input type="date" name="due_date" id="due_date" class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control textarea"></textarea>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Task</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>







</body>

</html>