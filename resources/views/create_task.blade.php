
@extends('layouts.app')

@section('content')
<style>
    .is-invalid {
    border-color: red;
    color: red;
    }
    .container {
        max-width: 100%;
    }

    .form-group {
        margin-bottom: 15px;
    }

    @media (max-width: 767px) {
        .form-group {
            margin-bottom: 10px;
        }
    }
    .select2{
        width: 100% !important;
    }
    body {
        font-size: 14px; 
    }
    .select2-selection--multiple{
        float:left;
        width: 100%;
    }
    .red-border {
    border-color: red !important;
}
.input-invalid {
    border: 1px solid red;
}

.input-valid {
    border: 1px solid green;
}
/* for loading */
.loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
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

@if(session('success'))
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

<div class="row">
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header"><h4>Create Task</h4></div>

            <div class="card-body mt-3">
                <form method="POST" action="{{ route('kaamdekh.create') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Title<span>*</span></label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @if ($errors->has('title')) is-invalid @endif">
                                @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                   
                            <div class="form-group">
                                <label for="type" style="display: block;">Type<span>*</span></label>
                                <select name="type_id" id="type" class="form-control select2 @if ($errors->has('type_id')) input-invalid @else input-valid @endif">
                                <option value="">Select Type</option>
                                    @foreach($types as $type)
                                        <option value="{{ $type->id }}" {{ old('type_id') == $type->id ? 'selected' : '' }}>{{ $type->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('type_id'))
                                    <span class="text-danger">{{ $errors->first('type_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="reported_by">Reported By<span>*</span></label>
                                <select name="reported_by" id="reported_by" class="form-control select2">
                                <option value="">Select Reported By</option>
                                @foreach($reporters as $reporter)
                                    <option value="{{ $reporter->id }}" {{ old('reported_by') == $reporter->id ? 'selected' : '' }}>
                                        {{ $reporter->email }}
                                    </option>
                                @endforeach
                                </select>
                                @if ($errors->has('reported_by'))
                                    <span class="text-danger">{{ $errors->first('reported_by') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="medium" style="display: block;">Medium<span>*</span></label>
                                <select name="medium_id" id="medium" class="form-control select2">
                                <option value="">Select Medium</option>
                                    @foreach($mediums as $medium)
                                        <option value="{{ $medium->id }}" {{ old('medium_id') == $medium->id ? 'selected' : '' }}>
                                            {{ $medium->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('medium_id'))
                                    <span class="text-danger">{{ $errors->first('medium_id') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="project_type">Project Type<span>*</span></label>
                                <select name="project_type_id" id="project_type" class="form-control select2">
                                <option value="">Select Project Type</option>
                                    @foreach($project_types as $project_type)
                                        <option value="{{ $project_type->id }}" {{ old('project_type_id') == $project_type->id ? 'selected' : '' }}>
                                            {{ $project_type->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('project_type_id'))
                                    <span class="text-danger">{{ $errors->first('project_type_id') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="task_owner" style="display: block;">Task Collaborator</label>
                                <select name="task_owner_collab[]" id="task_owner_collab" class="form-control select2" multiple>
                                    <option value="">Select Collaborators</option>
                                    @foreach($taskowners as $taskowner)
                                        <option value="{{ $taskowner->id }}" {{ in_array($taskowner->id, old('task_owner_collab', [])) ? 'selected' : '' }}>
                                            {{ $taskowner->email }}
                                        </option>
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
                                @if (isset($path))
                                    <img src="{{ asset('storage/' . $path) }}" alt="Uploaded Image">
                                @endif
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="stage" style="display: block;">Stage<span>*</span></label>
                                <select name="stage_id" id="stage" class="form-control select2">
                                <option value="">Select Stage</option>
                                    @foreach($stages as $stage)
                                        <option value="{{ $stage->id }}" {{ old('stage_id') == $stage->id ? 'selected' : '' }}>
                                            {{ $stage->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('stage_id'))
                                    <span class="text-danger">{{ $errors->first('stage_id') }}</span>
                                @endif
                            </div>

                            <input type='hidden' id = emailowner name='owneremail'>

                            <div class="form-group">
                                <label for="task_owner"style="display: block;">Task Owner<span>*</span></label>
                                <select name="task_owner" id="task_owner" class="form-control select2">
                                <option value="">Select Task Owner</option> 
                                    @foreach($taskowners as $taskowner)
                                        <option value="{{ $taskowner->id }}" {{ old('task_owner') == $taskowner->id ? 'selected' : '' }}>
                                            {{ $taskowner->email }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('task_owner'))
                                    <span class="text-danger">{{ $errors->first('task_owner') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="report_date">Report Date<span>*</span></label>
                                <input type="text" name="report_date" id="report_date"  value = "{{old('report_date')}}" class="form-control @if ($errors->has('title')) is-invalid @endif" autocomplete="off">
                                
                                @if ($errors->has('report_date'))
                                    <span class="text-danger">{{ $errors->first('report_date') }}</span>
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="due_date">Due Date<span>*</span></label>
                                <input type="text" name="due_date" id="due_date" value="{{old('due_date')}}" class="form-control @if ($errors->has('title')) is-invalid @endif" autocomplete="off">
                                
                                @if ($errors->has('due_date'))
                                    <span class="text-danger">{{ $errors->first('due_date') }}</span>
                                @endif
                            </div>
                           
                            <div class="form-group">
                                <label for="task_priority">Task Priority<span>*</span></label>
                                <select name="task_priority" id="task_priority" class="form-control select2">
                                <option value="">Select Task Priority</option>
                                @foreach($task_priorities as $task_priority)
                                <option value="{{ $task_priority->id }}" {{ old('task_priority') == $task_priority->id ? 'selected' : '' }}>
                                {{ $task_priority->name }}
                                </option>
                                @endforeach
                                </select>
                                @if ($errors->has('task_priority'))
                                    <span class="text-danger">{{ $errors->first('task_priority') }}</span>
                                @endif
                            </div>   
                            <div class="form-group">
                                <label for="task_sprint">Task Sprint<span>*</span></label>
                                <select name="task_sprint" id="task_sprint" class="form-control select2">
                                    
                                    <option value="">Select Sprint</option>
                                    @foreach($sprints as $sprint)
                                        <option value="{{ $sprint->id }}" {{ old('task_sprint') == $sprint->id ? 'selected' : '' }}>
                                            {{ $sprint->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('task_sprint'))
                                    <span class="text-danger">{{ $errors->first('task_sprint') }}</span>
                                @endif
                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                                <label for="description">Description</label>
                                <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <!-- Full-width submit button -->
                            <div class="form-group text-center">
                                <button type="submit" id="button" class="btn btn-primary btn-block">Create Task</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<!-- code for text editor  -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<!-- Include TinyMCE via CDN -->
<!-- <script src="{{asset('dist/css/adminlte.min.css')}}"></script> -->




<script>
   
      $("#due_date").datepicker({
        dateFormat: "yy-mm-dd",
        // maxDate: 0  
        // defaultDate: 0
        minDate: 0
      });
      $("#report_date").datepicker({
        dateFormat: "yy-mm-dd",
        
        defaultDate: 0
      });
      $(document).ready(function() {
                       setTimeout(function() {
                $('#success-message').fadeOut('fast');
            }, 5000); // Adjust the time as needed

            $('.select2').select2()

            $('#task_owner').change(function(){
            console.log('hello');

        var email = $('select#task_owner option:selected').text();
        console.log(email, 'aagyi');
        $('#emailowner').val(email);
        
        });

        });
     
             

</script>
<script>
    $(document).ready(function() {
        $('#task_owner_collab').select2();
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#button').on('click', function() {
            // alert("okoko");
            $('#loadingOverlay').css('display', 'flex');
        });
    });


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



@endsection