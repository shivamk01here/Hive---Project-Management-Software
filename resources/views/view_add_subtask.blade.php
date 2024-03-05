
@extends('layouts.app')

@section('content')
<style>
    .is-invalid {
    border-color: red;
    color: red;
}
.select2-selection--multiple{
        float:left;
        width: 100%;
    }
</style>

@if(session('success'))
<div id="success-message" class="alert alert-success" style="position: fixed; right: 10px; z-index: 1000;">
        {{ session('success') }}
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header text-center"><h4><strong>Create SubTask for @foreach($parent_task_name as $parentTask)
                {{ $parentTask->title }}
            @endforeach
            </strong></h4></div>

            <div class="card-body">
                <form method="POST" action="{{ route('post-add-subtask') }}">
                    @csrf
                     
                    <input type="hidden" name="parent_task_id" value="{{ $parent_task_id }}">

                    <div class="row">
                        <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title">Title</label><span>*</span>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}" class="form-control @if ($errors->has('title')) is-invalid @endif">
                                    @if ($errors->has('title'))
                                            <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>
                        
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <select name="type_id" id="type" class="form-control selectpicker select2" data-live-search="true">
                                        <option value="{{ $task[0]->type_id}}">{{ $task[0]->type}}</option>
                                        @foreach($types as $type)
                                        <option value="{{ $type->id }}">{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                        

                                <div class="form-group">
                                    <label for="reported_by">Reported By</label>
                                    <select name="reported_by" id="reported_by" class="form-control selectpicker select2" data-live-search="true">
                                        <option value="{{ $task[0]->reported_by_id}}">{{ $task[0]->reported_by}}</option>
                                        @foreach($reporters as $reporter)
                                        <option value="{{ $reporter->id}}">{{ $reporter->email }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="medium">Medium</label>
                                    <select name="medium_id" id="medium" class="form-control selectpicker select2" data-live-search="true">
                                        <option value="{{ $task[0]->medium_id}}">{{ $task[0]->medium}}</option>
                                        @foreach($mediums as $medium)
                                        <option value="{{ $medium->id }}">{{ $medium->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="project_type">Project Type</label>
                                    <select name="project_type_id" id="project_type" class="form-control selectpicker select2" data-live-search="true">
                                        <option value="{{ $task[0]->project_type_id}}">{{ $task[0]->project_type}}</option>
                                        @foreach($project_types as $project_type)
                                        <option value="{{ $project_type->id }}">{{ $project_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="stage">Stage</label>
                                    <select name="stage_id" id="stage" class="form-control selectpicker select2" data-live-search="true">
                                    @foreach($stages as $stage)
                                        <option value="{{  $stage->id }}" {{ old('stage') == $stage->id ? 'selected' : '' }}>
                                    {{ $stage->name }}
                                    </option>
                                    @endforeach
                                    </select>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-6">

                                <input type='hidden' id = emailowner name='owneremail'>

                                <div class="form-group">
                                    <label for="task_owner">Task Owner</label>
                                    <select name="task_owner" id="task_owner" class="form-control selectpicker select2" data-live-search="true">
                                    <option value="{{ $task[0]->task_owner_id}}">{{ $task[0]->task_owner_email}}</option>
                                        @foreach($taskowners as $taskowner)
                                         <option value="{{ $taskowner->id }}">{{ $taskowner->email }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group datepicker">
                                    <label for="report_date">Report Date<span>*</span></label>
                                    <input type="text" name="report_date" id="report_date" class="form-control" value="{{ $task[0]->report_date}}">
                                </div>

                                <div class="form-group datepicker">
                                    <label for="due_date">Due Date<span>*</span></label>
                                    <input type="text" name="due_date" id="due_date" class="form-control" value="{{ $task[0]->due_date}}">
                                </div>
                           

                                <div class="form-group">
                                    <label for="task_priority">Task Priority</label>
                                    <select name="task_priority" id="task_priority" class="form-control select2">
                                    @foreach($task_priorities as $task_priority)
                                    <option value="{{ $task_priority->id }}" {{ old('task_priority') == $task_priority->id ? 'selected' : '' }}>
                                    {{ $task_priority->name }}
                                    </option>
                                    @endforeach
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="task_sprint">Task Sprint</label>
                                    <select name="task_sprint" id="task_sprint" class="form-control selectpicker select2" data-live-search="true">
                                    <option value="{{ $task[0]->sprint_id }}" >{{ $task[0]->task_sprint }}</option>    
                                      
                                    @foreach($sprints as $sprint)
                                        <option value="{{ $sprint->id }}" >{{ $sprint->name }}</option>    
                                        @endforeach
                                    </select>
                                </div>


                           
                                

                                <div class="form-group">
                                <label for="task_owner" style="display: block;">Task Collaborator</label>
                                <select name="task_owner_collab[]" id="task_owner_collab" class="form-control select2" multiple>
                                <option value="">Select Collaborators</option>
                                    @foreach($taskowners as $taskowner)
                                        <option value="{{ $taskowner->id }}" {{ old('task_owner') == $taskowner->id ? 'selected' : '' }}>
                                            {{ $taskowner->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                        <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea id="description" name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                                </div>
                            <!-- Full-width submit button -->
                            <div class="form-group text-center">
                                <button type="submit" id="button" class="btn btn-primary btn-block">Create Subtask</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://cdn.datatables.net/1.11.10/js/jquery.dataTables.min.js"></script>
<!-- Include TinyMCE via CDN -->
<script src="https://cdn.tiny.cloud/1/your-api-key/tinymce/5/tinymce.min.js"></script>

  
<script>
      $("#due_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0 
      });
      $("#report_date").datepicker({
        dateFormat: "yy-mm-dd",
        minDate: 0 
      });
      $(document).ready(function() {
            // Automatically hide the success message after 5 seconds (5000 milliseconds)
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