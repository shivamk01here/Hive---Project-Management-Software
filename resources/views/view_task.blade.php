@extends('layouts.app')

@section('content')
<head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- @if ($task[0]->task_status == 2)
        <script>
            window.location.href = "{{ route('view-task', ['task_id' => $task[0]->id]) }}";
        </script>
    @endif
<script> -->

   <meta name="csrf-token" content="{{ csrf_token() }}">


    <script>
    $(document).ready(function () {
        $("#toggleButtons").click(function () {
            $("#buttonContainer").toggle();
        });
    });
</script>

</head>
<style>
     .select2{
    width: 100% !important;
}

body {
    font-size: 14px; 
}
</style>
<style>
#comments-container {
    background-color: #f5f5f5;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    margin-top: 20px;
    
}

.comment {
    margin-bottom: 10px;
}

.commenter-name {
    font-weight: bold;
}

.comment-content {
    margin-left: 10px;
}
.commenter-name {
font-weight: bold;
color: #007bff; 
}
.select2-selection--multiple{
    float:left;
    width: 100%;
}
.loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 0, 0.6); /* Yellowish background with 60% opacity */
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }


    .body {
        position: absolute;
        top: 50%;
        margin-left: -50px;
        left: 50%;
        animation: speeder .4s linear infinite;
    }

    .body > span {
        height: 5px;
        width: 35px;
        background: #000;
        position: absolute;
        top: -19px;
        left: 60px;
        border-radius: 2px 10px 1px 0;
    }

    .base span {
        position: absolute;
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-right: 100px solid #000;
        border-bottom: 6px solid transparent;
    }

    .base span:before {
        content: "";
        height: 22px;
        width: 22px;
        border-radius: 50%;
        background: #000;
        position: absolute;
        right: -110px;
        top: -16px;
    }

    .base span:after {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-top: 0 solid transparent;
        border-right: 55px solid #000;
        border-bottom: 16px solid transparent;
        top: -16px;
        right: -98px;
    }

    .face {
        position: absolute;
        height: 12px;
        width: 20px;
        background: #000;
        border-radius: 20px 20px 0 0;
        transform: rotate(-40deg);
        right: -125px;
        top: -15px;
    }

    .face:after {
        content: "";
        height: 12px;
        width: 12px;
        background: #000;
        right: 4px;
        top: 7px;
        position: absolute;
        transform: rotate(40deg);
        transform-origin: 50% 50%;
        border-radius: 0 0 0 2px;
    }

    .body > span > span:nth-child(1),
    .body > span > span:nth-child(2),
    .body > span > span:nth-child(3),
    .body > span > span:nth-child(4) {
        width: 30px;
        height: 1px;
        background: #000;
        position: absolute;
        animation: fazer1 .2s linear infinite;
    }

    .body > span > span:nth-child(2) {
        top: 3px;
        animation: fazer2 .4s linear infinite;
    }

    .body > span > span:nth-child(3) {
        top: 1px;
        animation: fazer3 .4s linear infinite;
        animation-delay: -1s;
    }

    .body > span > span:nth-child(4) {
        top: 4px;
        animation: fazer4 1s linear infinite;
        animation-delay: -1s;
    }

    @keyframes fazer1 {
        0% {
            left: 0;
        }
        100% {
            left: -80px;
            opacity: 0;
        }
    }

    @keyframes fazer2 {
        0% {
            left: 0;
        }
        100% {
            left: -100px;
            opacity: 0;
        }
    }

    @keyframes fazer3 {
        0% {
            left: 0;
        }
        100% {
            left: -50px;
            opacity: 0;
        }
    }

    @keyframes fazer4 {
        0% {
            left: 0;
        }
        100% {
            left: -150px;
            opacity: 0;
        }
    }

    @keyframes speeder {
        0% {
            transform: translate(2px, 1px) rotate(0deg);
        }
        10% {
            transform: translate(-1px, -3px) rotate(-1deg);
        }
        20% {
            transform: translate(-2px, 0px) rotate(1deg);
        }
        30% {
            transform: translate(1px, 2px) rotate(0deg);
        }
        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
            transform: translate(-1px, 3px) rotate(-1deg);
        }
        60% {
            transform: translate(-1px, 1px) rotate(0deg);
        }
        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }
        80% {
            transform: translate(-2px, -1px) rotate(1deg);
        }
        90% {
            transform: translate(2px, 1px) rotate(0deg);
        }
        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    .longfazers {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .longfazers span {
        position: absolute;
        height: 2px;
        width: 20%;
        background: #000;
    }

    .longfazers span:nth-child(1) {
        top: 20%;
        animation: lf .6s linear infinite;
        animation-delay: -5s;
    }

    .longfazers span:nth-child(2) {
        top: 40%;
        animation: lf2 .8s linear infinite;
        animation-delay: -1s;
    }

    .longfazers span:nth-child(3) {
        top: 60%;
        animation: lf3 .6s linear infinite;
    }

    .longfazers span:nth-child(4) {
        top: 80%;
        animation: lf4 .5s linear infinite;
        animation-delay: -3s;
    }

    @keyframes lf {
        0% {
            left: 200%;
        }
        100% {
            left: -200%;
            opacity: 0;
        }
    }

    @keyframes lf2 {
        0% {
            left: 200%;
        }
        100% {
            left: -200%;
            opacity: 0;
        }
    }

    @keyframes lf3 {
        0% {
            left: 200%;
        }
        100% {
            left: -100%;
            opacity: 0;
        }
    }

    @keyframes lf4 {
        0% {
            left: 200%;
        }
        100% {
            left: -100%;
            opacity: 0;
        }
    }
</style>
@if ($task[0]->task_status == 2)
    <style>
        .card-body {
            background-color: #DCDCDC;
        }
        .card-header{
            background-color: #DCDCDC;
        }
        .card-body input,
        .card-body select,
        .card-body textarea {
            background-color: #DCDCDC;
            color: #550; 
        }
    </style>
@endif
<!-- le dekh -->
<style>
     .checkpoint {
        width: 30px;
        height: 30px;
        background-color: #ccc;
        border-radius: 50%;
        margin: 5px;
        display: flex;
        align-items: center;
    }

    .completed {
        background-color: green;
       
    }

    .checkpoint-container{
        display:flex;
        gap:45px;
    }

    .stage-name {
        margin-top: 45px;
        font-size: 11px;
    }

    .arrow {
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 10px 10px 0 10px;
        border-color: #ccc transparent transparent transparent;
        margin-top: 5px;
        transform:rotate(270deg);
    }
    .datepicker {
    position: absolute;
    z-index: 999;
}

.form-group.datepicker {
    position: relative;
}
    </style>



<!-------------------------------------- Shivam.k is CHANGING CODE from HERE ------------------------------------->

@if (session('success'))
<div id="success-message" class="alert alert-success" style="position: fixed; right: 10px; z-index: 1000;">
        {{ session('success') }}
    </div>
@endif
<div class="loading-overlay" id="loadingOverlay">
    <div class="body">
        <span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div class="base">
            <span></span>
            <div class="face"></div>
        </div>
    </div>
    <div class="longfazers">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <h1></h1>
</div>

<div class="row mt-3">
    <div class="col-md-12 text-right">
        <button id="toggleButtons" class="btn btn-primary btn-info">
            <i class="fas fa-bars"></i>
        </button>
        <div id="buttonContainer" style="display: none;">
            <!-------------------------------- till here ----------------------->
            @if ($task_owner[0]->id == session('user_id'))
            <a href="{{ route('review-request', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-md">
                <i class="fas fa-search"></i> Request for Review
            </a>
            @endif

            <a href="{{ route('view-task', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-md btn-info">
                <i class="fas fa-eye"></i> View Only
            </a>
            @if (!is_null($task[0]->parent_task_id))
            <a href="{{ route('view-parent-task', ['parent_task_id' => $task[0]->parent_task_id]) }}" class="btn btn-primary btn-md">
                <i class="fas fa-eye"></i> View MAIN Task
            </a>
            @endif
            @if ($task[0]->parent_task_id == null)
            <a href="{{ route('add-subtask-view', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-md btn-info">
                <i class="fas fa-plus"></i> Add Subtask
            </a>
            <a href="{{ route('view-subtasks', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-md btn-info">
                <i class="fas fa-eye"></i> View Subtasks
            </a>
            @endif
            <a href="{{ route('view-task-history', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-md btn-secondary" style="background-color: grey;">
                <i class="fas fa-history"></i> Task History
            </a>
        </div>
    </div>
</div>


<!------------ TILL HERE FOR ADDING NEW TASK  AND TASK HISTORY BUTTONS , SUBTASK, MAIN TASK------------------->



<div class="row">
    <div class="col-md-12">
        <div class="card mt-2">

            <div >
                    <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">

                    <div>
                        @if (!is_null($task[0]->parent_task_id) && $task[0]->task_status == 2)
                            <h4>
                                <span class="badge badge-success">
                                    <i class="fas fa-trophy"></i> TASK COMPLETED
                                </span>
                                <span class="badge badge-warning">SUBTASK</span>
                            </h4>
                        @elseif ($task[0]->task_status == 2)
                            <h4><span class="badge badge-success">
                                    <i class="fas fa-trophy"></i> TASK COMPLETED
                                </span></h4>
                        @elseif (!is_null($task[0]->parent_task_id))
                            <h4><span class="badge badge-warning">SUBTASK</span></h4>
                        @else
                            <h4>Update Task</h4>
                        @endif


                        <!----------------------------------- toggle button ---------------------------->

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="toggleCheckbox" @if($task[0]->visibility == 1) checked @endif>
                            <label class="custom-control-label" for="toggleCheckbox">
                                check it to make it public
                            </label>
                        </div>
                    </div>
                        <!-- aa dekh  -->
                            <?php
                                    $data = [
                                        [
                                            "id" => 1,
                                            "name" => "backlog",
                                            "department_id" => 1,
                                        ],
                                        [
                                            "id" => 2,
                                            "name" => "development",
                                            "department_id" => 1,
                                        ],
                                        [
                                            "id" => 3,
                                            "name" => "working",
                                            "department_id" => 1,
                                        ],
                                        [
                                            "id" => 4,
                                            "name" => "testing",
                                            "department_id" => 1,
                                        ],
                                        [
                                            "id" => 5,
                                            "name" => "Live",
                                            "department_id" => 1,
                                        ],
                                    ];

                                    $actualStage = $task[0]->stage;

                                    // Find the index of the actual stage
                                    $actualStageIndex = array_search(strtolower($actualStage), array_map('strtolower', array_column($data, 'name')));

                                    // Loop through each stage and create checkpoints with arrows
                                    echo "<div class='checkpoint-container'>";
                                    for ($i = 0; $i < count($data); $i++) {
                                        $stage = $data[$i];
                                        $stageName = strtolower($stage["name"]);
                                        $completedClass = ($i <= $actualStageIndex) ? "completed" : "";
                                        echo "<div class='checkpoint $completedClass'>";
                                        echo "<span class='stage-name'>$stageName</span>";
                                        if ($i < count($data) - 1) {
                                            echo "<div class='arrow'></div>";
                                        }
                                        echo "</div>";
                                    }
                                    echo "</div>";
                            ?>
                    </div>
            </div>  

            <!-- Form Start -->
            <div class="card-body @if ($task[0]->task_status == 2) grey-bg @endif">

                <form method="POST" action="{{ route('kaamdekh.update') }}" enctype="multipart/form-data">
                    @csrf

                    <div>
                        <div class="form-group text-right row ">
                            <div class=col-lg-2 col-4></div>
                            <div class=col-lg-2 col-4></div>
                            <div class=col-lg-2 col-4></div>
                            <div class=col-lg-6 col-4>
                            <div>
                            @if (in_array(session('user_id'), session('superuser_ids')))
                                    @if ($task[0]->task_status == 1)
                                        <a href="{{ route('completion-mail', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-info" onclick="return confirm('you wanna complete this task with mail ?')">
                                             <i class="fa fa-envelope"></i></i> Complete With Mail
                                        </a>
                                        <button type="submit" name="mark_as_completed" class="btn btn-success btn-medium" onclick="return confirm('Are you sure you wanna complete this task without mail ?')">
                                            <i class="fa fa-thumb-tack"></i> Mark as Complete
                                        </button>
                                    @endif

                                    @if ($task[0]->task_status == 2)
                                    <a href="{{ route('re-activate-task', ['task_id' => $task[0]->id]) }}" class="btn btn-primary btn-info">
                                    <i class="fas fa-react"></i></i> re-activate Task
                                    </a>
                                    @endif

                                    <button type="submit" name="delete_task" class="btn btn-danger btn-medium" onclick="return confirm('Are you sure you want to delete this task?')">
                                        <i class="fas fa-trash"></i> Delete Task
                                    </button>
                            @endif
                            </div>
                            </div>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="taskid" value="{{ $task[0]->id }}">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title<span>*</span></label>
                                <input type="text" name="title" id="title" value="{{ $task[0]->title}}" class="form-control" @if ($task[0]->task_status == 2) disabled @endif>
                                @if ($errors->has('title'))
                                <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="type">Type</label>
                                <select name="type_id" id="type" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif>
                                    <option value="{{ $task[0]->type_id}}">{{ $task[0]->type}}</option>
                                    @foreach($types as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group">
                                <label for="reported_by">Reported By</label>
                                <select name="reported_by" id="reported_by" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif >
                                    <option value="{{ $task[0]->reported_by_id}}">{{ $task[0]->reported_by}}</option>
                                    @foreach($reporters as $reporter)
                                    <option value="{{ $reporter->id}}">{{ $reporter->email }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="medium">Medium</label>
                                <select name="medium_id" id="medium" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif>
                                    <option value="{{ $task[0]->medium_id}}">{{ $task[0]->medium}}</option>
                                    @foreach($mediums as $medium)
                                    <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="project_type">Project Type</label>
                                <select name="project_type_id" id="project_type" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif>
                                    <option value="{{ $task[0]->project_type_id }}">{{ $task[0]->project_type }}</option>
                                    @foreach($project_types as $project_type)
                                    <option value="{{ $project_type->id }}">{{ $project_type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                    <label for="task_owner" style="display: block;">Task Collaborator</label>
                                    <select name="task_owner_collab[]" id="task_owner_collab" class="form-control select2" multiple>
                                        
                                    @foreach($taskowners as $taskowner)
                                        @php
                                            $isSelected = false;
                                        @endphp
                                        @if(isset($collab))
                                        @foreach($collab as $coll)
                                            @if($taskowner->id == $coll->task_follower)
                                                @php
                                                    $isSelected = true;
                                                @endphp
                                                <option value="{{ $taskowner->id }}" selected>{{ $taskowner->email }}</option>
                                                @break
                                            @endif
                                        @endforeach
                                        @endif
                                        @if(!$isSelected)
                                            <option value="{{ $taskowner->id }}">{{ $taskowner->email }}</option>
                                        @endif
                                    @endforeach
                                    </select>
                                </div>

                            <div class="form-group">
                                <label for="file" style="display: block;">Upload Image or PDF</label>
                                <input type="file" name="file" id="file" class="form-control-file" value="{{ old('file') }}">
                                @if ($errors->has('file'))
                                    <span class="text-danger">{{ $errors->first('file') }}</span>
                                @endif

                                <!-- Display the uploaded image if it exists -->
                            <?php
                               
                                $file_path = $task[0]->file_path;
                            ?>
                               <img src="{{asset($file_path)}}" alt="" width = "225px">
                               @if ($task[0]->file_path)
                                    <div class="mt-2">
                                        <a href="{{asset($file_path)}}" download class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i> Download
                                        </a>
                                    
                                        <a href="{{asset($file_path)}}" target="_blank" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> View
                                        </a>
                                    </div>
                                @endif
                            </div>
    
                        </div>
                      
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stage">Stage</label>
                                <select name="stage_id" id="stage" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif>
                                    <option value="{{ $task[0]->stage_id}}">{{ $task[0]->stage}}</option>
                                    @foreach($stages as $stage)
                                    <option value="{{ $stage->id }}">{{ $stage->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                              <label for="task_priority">Task Priority</label>
                                <select name="task_priority" id="task_priority" class="form-control select2" @if ($task[0]->task_status == 2) disabled @endif>
                                <option value="{{ $task[0]->priority_id }}">{{ $task[0]->priority_name }}</option>
                                  
                                 @foreach($task_priorities as $task_priority)
                                     <option value="{{ $task_priority->id }}">
                                       {{ $task_priority->name }}
                                  </option>
                                 @endforeach
                                </select>
                            </div>

                            <input type='hidden' id = emailowner name='owneremail'>

                            <div class="form-group">
                                <label for="task_owner">Task Owner</label>
                                <select name="task_owner" id="task_owner" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif >
                                    <option value="{{ $task_owner[0]->id}}">{{ $task_owner[0]->taskowner}}</option>
                                    @foreach($taskowners as $taskowner)
                                    <option value="{{ $taskowner->id }}">{{ $taskowner->email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        
                            <div class="form-group">
                                <label for="task_sprint">Task Sprint</label>
                                <select name="task_sprint" id="task_sprint" class="form-control selectpicker select2" data-live-search="true" @if ($task[0]->task_status == 2) disabled @endif>
                                                                      
                                @foreach($sprints as $sprint)
                                    <option value="{{ $sprint->id }}" @if ($sprint->id == $task[0]->sprint_id) selected @endif>{{ $sprint->name }}</option>    
                                    @endforeach
                                </select>
                            </div>


                            <div class="form-group datepicker">
                                <label for="report_date">Report Date<span>*</span></label>
                                <input type="text" name="report_date" id="report_date" class="form-control" @if ($task[0]->task_status == 2) disabled @endif value="{{ $task[0]->report_date}}">
                            </div>

                            <div class="form-group datepicker">
                                <label for="due_date">Due Date<span>*</span></label>
                                <input type="text" name="due_date" id="due_date" class="form-control" value="{{ $task[0]->due_date}}" @if ($task[0]->task_status == 2) disabled @endif>
                            </div>
                               
                        </div>
                    </div>
                  </div>
                              
                    <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control" @if ($task[0]->task_status == 2) disabled @endif>{!! html_entity_decode($task[0]->description) !!}</textarea>
                    </div>
                    <div id="comments-container">
                            @if(isset($comments) && count($comments) > 0)
                                @foreach($comments as $comment)
                                    <div class="row">
                                        <div class="comment">
                                            <span class="commenter-name">{{ $comment->commenter }}</span>
                                            <span class="comment-content">{!! $comment->comment !!}</span>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                    </div>
                   
                
                    
                    <div class="form-group comment" id="new-comment">
                        <textarea name="newcomment" id="newcomment" class="form-control mb-3"></textarea>
                        <span class="comment-content"><button type="button" onclick="performCustomAction()" id="add-comment-btn" @if ($task[0]->task_status == 2) disabled @endif>Add Comment</button></span>
                    </div>
                   
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group text-center">
                                <button type="submit" id="ani_button" class="btn btn-info btn-block" onclick="return confirm('Are you sure you want to update this task?')" @if ($task[0]->task_status == 2) disabled @endif>
                                    <i class="fas fa-edit"></i> Update Task
                                </button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>

<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> -->





<script>
        function performCustomAction() {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const comment = $('#newcomment').val();
        const task_id = $('#taskid').val();
        if(!comment.trim()){
            alert("comment cannot be empty");
            return;
        }

        const maxCommentLength = 250;
        if (comment.trim().split(/\s+/).length > maxCommentLength) {
            alert("Comment should not exceed 250 words.");
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{route('add_comment')}}",
            data: {
                _token: csrfToken,
                comment: comment.replace(/\n/g, '<br>'),
                task_id: task_id
            },
            success: function(data) {
                var commentsContainer = $('#comments-container');
                var newCommentInput = $('#newcomment');

                newCommentInput.val('');

                commentsContainer.empty();

                data.forEach(function(comment) {
                    var commentHtml = `
                        <div class="comment">
                            <span class="commenter-name">${comment.commenter}:</span>
                            <span class="comment-content">${comment.comment}</span>
                        </div>
                    `;
                    commentsContainer.append(commentHtml);
                });
            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert("An error occurred: " + errorThrown);
            }
        });
    }



    $("#due_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0
    });

    $("#report_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0
    });

    $(document).ready(function() {
        setTimeout(function() {
            $('#success-message').fadeOut('fast');
        }, 5000);
        $('.select2').select2()
        function updateEmailOwner() {
            console.log('hello');
            
            var email = $('select#task_owner option:selected').text();
            console.log(email, 'aagyi');
            $('#emailowner').val(email);
        }
        $('#task_owner').change(updateEmailOwner);
        updateEmailOwner();
        
    }); 
</script>
<script>

$(document).ready(function() {
    const checkbox = $('#toggleCheckbox');

    checkbox.on('change', function() {
        const task_id = $('#taskid').val(); 
        const visibility = $(this).is(':checked') ? 1 : 0;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            type: 'GET',
            url: "{{ route('task-visibility') }}", 
            data: {
                _token: csrfToken,
                task_id: task_id,
                visibility: visibility,
            },
            success: function(response) {
                console.log('Checkbox state updated successfully.');
                
            },
            error: function(xhr, status, error) {
                console.error('Error updating checkbox state: ' + error);
            },
        });
    });
});

</script>
<script>
  tinymce.init({
  selector: '#description',
  height: 500,
  plugins: [
    'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
    'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
    'insertdatetime', 'media', 'table', 'help', 'wordcount'
  ],
  toolbar: 'undo redo | blocks | ' +
  'bold italic backcolor | alignleft aligncenter ' +
  'alignright alignjustify | bullist numlist outdent indent | ' +
  'removeformat | help',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
});
</script>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#ani_button').on('click', function() {
            $('#loadingOverlay').css('display', 'flex');
        });
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const button = document.getElementById('request-review-button');
        const selectContainer = document.getElementById('select-menu-container');
        const selectedReporterInput = document.getElementById('selected_reporter');
        const reviewForm = document.getElementById('review-form');

        button.addEventListener('click', function (e) {
            e.preventDefault();

            if (selectContainer.style.display === 'none') {
                selectContainer.style.display = 'block';
            } else {
                selectContainer.style.display = 'none';
                const reportedBy = document.getElementById('reported_by');
                const selectedReporter = reportedBy.options[reportedBy.selectedIndex].text;
                selectedReporterInput.value = selectedReporter;
                reviewForm.submit();
            }
        });
    });
</script>



@endsection