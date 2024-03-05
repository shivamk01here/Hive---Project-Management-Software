@extends('layouts.app')

@section('content')
<style>
  body {
        font-size: 14px; 
    }
    .{
        width:100%;
    }
   
</style>



@if(session('success'))
<div id="success-message" class="alert alert-success" style="position: fixed; right: 10px; z-index: 1000;">
    {{ session('success') }}
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header" style="display:flex; justify-content: space-between; align-items: center;">
                <div style="margin-right: auto;">
                    <a href="#" id="showFilters" class="btn btn-info">
                        <i class="fas fa-filter"></i> Filters
                    </a>
                </div>
                <div style="margin-left: auto;">
                    <a href="{{ route('new-task') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Add Task
                    </a>
                </div>
                <div class="ml-2">
                    <button id="downloadButton" class="btn btn-warning">
                        <i class="fas fa-download"></i> Download Tasks
                    </button>
                </div>

            </div>
                <form id="filterForm" style="display: none;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="type_id" style="display: block;">Type:</label>
                                <select name="type_id" id="type_id" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">All Types</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="reported_by" style="display: block;">Reported By</label>
                                <select name="reported_by" id="reported_by" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a Reporter</option>
                                    @foreach($reporters as $reporter)
                                    <option value="{{ $reporter->id }}">{{ $reporter->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="medium_id" style="display: block;">Medium:</label>
                                <select name="medium_id" id="medium_id" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a medium</option>
                                    @foreach($mediums as $medium)
                                    <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="stage" style="display: block;">Stage</label>
                                <select name="stage_id" id="stage" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a Stage</option>
                                    @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="task_owner" style="display: block;">Task Owner</label>
                                <select name="task_owner" id="task_owner" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a Task Owner</option>
                                    @foreach($taskowners as $taskowner)
                                    <option value="{{ $taskowner->id }}">{{ $taskowner->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="from_date" style="display: block;">From Date:</label>
                                <input type="date" name="from_date" id="from_date" class="form-control" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="till_date" style="display: block;">Till Date:</label>
                                <input type="date" name="till_date" id="till_date" class="form-control" style="width: 100%;">
                            </div>
                        </div>
                        <div class="col-md-2">
                                <div class="form-group">
                                <label for="task_priority" style="display: block;">Task Priority</label>
                                <select name="task_priority" id="task_priority" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a Priority</option>
                                    @foreach($task_priorities as $task_priority)
                                        <option value="{{ $task_priority->id}}">{{ $task_priority->name }}</option>
                                    @endforeach
                                </select>
                                </div>
                         </div> 

                         <div class="col-md-2">
                            <div class="form-group">
                                <label for="task_sprint" style="display: block;">TASK SPRINT:</label>
                                <select name="task_sprint" id="task_sprint" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">Select a Sprint</option>
                                    @foreach($sprints as $task_sprint)
                                    <option value="{{ $task_sprint->id }}">{{ $task_sprint->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label for="project_type_id" style="display: block;">Project Type:</label>
                                <select name="project_type_id" id="project_type_id" class="form-control selectpicker select2" data-live-search="true" style="width: 100%;">
                                    <option value="">All Project Types</option>
                                    @foreach($project_types as $project_type)
                                    <option value="{{ $project_type->id }}">{{ $project_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mb-3" type="submit">Apply Filters</button>
                    </div>
                    </div>
                </form>

            <table id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Sprint</th>
                        <th>Title</th>
                        <th>Type</th>
                        <th>Priority</th>
                        <th>Project Type</th>
                        <th>Startdate</th>
                        <th>DueDate</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                 
                    @foreach($tasks as $key =>$task)
                        @php
                        $dueDate = \Carbon\Carbon::parse($task->due_date);
                        $isOverdue = $dueDate->isPast() && $task->stage_id !== 5;
                        $isSubtask = !is_null($task->parent_task_id);
                        $isDeleted = $task->task_status == 3;
                        @endphp
                        @if (!$isDeleted)
                        <tr style="{{ $task->task_status == 2 ? 'background-color: #DCDCDC;' : ($isOverdue ? 'background-color: #f8d7da;' : '') }}">
                            <td>{{$key+1}}</td>
                            <td><a href="{{ url('/task-view/'.$task->id) }}">{{ $task->sprint_name }}</a></td>
                            <td>

                                <a href="{{ url('/task-view/'.$task->id) }}">
                                    @if ($isSubtask)
                                        <span class="badge badge-info" >sub</span>
                                    @endif
                                    {{ $task->title }}
                                </a>
                            </td>
                            <td><a href="{{ url('/task-view/'.$task->id) }}">{{ $task->type }}</a></td>
                            <td>
                                <a href="{{ url('/task-view/'.$task->id) }}">
                                    @if ($task->priority_id == 1)
                                        <span style="color: grey;">Track</span>
                                    @elseif ($task->priority_id == 2)
                                        <span style="color: violet;">Low</span>
                                    @elseif ($task->priority_id == 3)
                                        <span style="color: orange;">Medium</span>
                                    @elseif ($task->priority_id == 4)
                                        <span style="color: red;">High</span>
                                    @endif
                                </a>
                            </td>
                            <td><a href="{{ url('/task-view/'.$task->id) }}">{{ $task->project_type }}</a></td>
                            <td><a href="{{ url('/task-view/'.$task->id) }}">{{ \carbon\carbon::parse($task->report_date)->format('j F Y') }}</a></td>
                            <td><a href="{{ url('/task-view/'.$task->id) }}">{{ \carbon\carbon::parse($task->due_date)->format('j F Y') }}</a></td>                     
                            <td>
                                <a href="{{ url('/task-view/'.$task->id) }}">
                                    @if ($task->task_status == 1)
                                    <span class="badge badge-success">Active
                                    </span>
                                    @elseif ($task->task_status == 2)
                                        <span class="badge badge-info">
                                        <i class="fas fa-check"></i> Completed</span>
                                    @elseif ($task->task_status == 3)
                                        <span class="badge badge-danger">Deleted</span>    
                                    @else
                                        <span class="badge badge-secondary">Some other status</span>
                                    @endif
                                </a>
                            </td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#showFilters").click(function(e) {
            e.preventDefault();
            $("#filterForm").slideToggle();
        });
    });
</script>


<!-- <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script> -->


<script>
    $(document).ready(function() {
        $('.select2').select2()

        $('#myTable').DataTable({

        });
    });
   
       
$(document).ready(function() {
    var table = $('#myTable').DataTable();
    setTimeout(function() {
                $('#success-message').fadeOut('fast');
            }, 5000);

    $('#downloadButton').on('click', function() {
        var data = table.rows().data().toArray();
     
        var csvContent = "";
        csvContent += "Number,Sprint,Title,Type,Priority,Project Type,Startdate,Duedate\n";

        for (var i = 0; i < data.length; i++) {
            var number = i + 1;
            var Sprint = $(data[i][1]).text(); 
            var title = $(data[i][2]).text();
            var type = $(data[i][3]).text();
            var priority = $(data[i][4]).text().replace(/\n/g, ' '); 
            var projectType = $(data[i][5]).text();
            var Startdate = $(data[i][6]).text();
            var Duedate = $(data[i][7]).text();


            Sprint = Sprint.trim();
            title = title.trim();
            type = type.trim();
            priority = priority.trim();
            projectType = projectType.trim();
            Startdate = Startdate.trim();
            Duedate = Duedate.trim();
            csvContent += number + ',"' + Sprint + '","' + title + '","' + type + '","' + priority + '","' + projectType + '","' + Startdate + '","' + Duedate + '"\n';
        }


        var blob = new Blob([csvContent], { type: "text/csv;charset=utf-8" });
        // console.log(csvContent);
        saveAs(blob, "tasks.csv");
    });
});

    
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
       
        function getUrlParameter(name) {
            name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
            var regex = new RegExp("[\\?&]" + name + "=([^&#]*)");
            var results = regex.exec(location.search);
            return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
        }
        
        document.getElementById("type_id").value = getUrlParameter("type_id");
        document.getElementById("reported_by").value = getUrlParameter("reported_by");
        document.getElementById("medium_id").value = getUrlParameter("medium_id");
        document.getElementById("stage").value = getUrlParameter("stage_id");
        document.getElementById("task_owner").value = getUrlParameter("task_owner");
        document.getElementById("project_type_id").value = getUrlParameter("project_type_id");
        document.getElementById("from_date").value = getUrlParameter("from_date");
        document.getElementById("till_date").value = getUrlParameter("till_date");
        document.getElementById("task_priority").value = getUrlParameter("task_priority");
        document.getElementById("task_sprint").value = getUrlParameter("task_sprint");
    });
</script>

<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable();
    var downloadButton = $('#downloadButton');

    function hideDownloadButtonIfEmpty() {
        var firstRowData = table.row(0).data(); 

        if (!firstRowData || !firstRowData.length) {
            downloadButton.hide(); 
        } else {
            downloadButton.show();
        }
    }
    hideDownloadButtonIfEmpty();
    table.on('draw', hideDownloadButtonIfEmpty);
});
</script>

@endsection