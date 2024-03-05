
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
</style>

@if(session('success'))
<div id="success-message" class="alert alert-success" style="position: fixed; right: 10px; z-index: 1000;">
        {{ session('success') }}
    </div>
@endif
<div class="row">
    <div class="col-md-12">
        <div class="card mt-2">
            <div class="card-header"><h4>Create Sprint</h4></div>

            <div class="card-body mt-3">
                <form method="POST" action="{{ route('sprintcreate') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title">Sprint Name<span>*</span></label>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" class="form-control @if ($errors->has('name')) is-invalid @endif">
                                @if ($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="task_owner"style="display: block;">Sprint Task Owner</label>
                                <select name="task_owner" id="task_owner" class="form-control select2">
                                    @foreach($taskowners as $taskowner)
                                        <option value="{{ $taskowner->id }}" {{ old('task_owner') == $taskowner->email ? 'selected' : '' }}>
                                            {{ $taskowner->email }}
                                        </option>
                                    @endforeach
                                </select>
                            </div> 
                       </div>
                        <div class="col-md-6">

                        <div class="form-group">
                            <label for="report_date">Sprint Start Date<span>*</span></label>
                            <input type="date" name="start_date" id="start_date" value="{{ old('start_date') }}" class="form-control @if ($errors->has('start_date')) is-invalid @endif" autocomplete="off">
                            @if ($errors->has('start_date'))
                                <span class="text-danger">{{ $errors->first('start_date') }}</span>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="due_date">Sprint End Date<span>*</span></label>
                            <input type="date" name="end_date" id="end_date" value="{{ old('start_date') }}" class="form-control @if ($errors->has('end_date')) is-invalid @endif" autocomplete="off" disabled>
                            @if ($errors->has('end_date'))
                                <span class="text-danger">{{ $errors->first('end_date') }}</span>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <!-- Full-width submit button -->
                            <div class="form-group text-center">
                                <button type="submit" id="button" class="btn btn-primary btn-block">Create Sprint</button>
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
<!-- <script src="{{asset('dist/css/adminlte.min.css')}}"></script> -->



<!-- <script src="http://me.ixambee.in/editordemo/jscripts/tiny_mce/plugins/asciimath/js/ASCIIMathMLwFallback.js" type="text/javascript" charset="utf-8" ></script> -->
   
<script>
    document.getElementById('end_date').addEventListener('change', function() {
        var startDate = new Date(document.getElementById('start_date').value);
        var endDate = new Date(this.value);

        if (endDate < startDate) {
            alert('End date cannot be earlier than start date.');
            this.value = ''; 
        }
    });
    const startDateInput = document.getElementById('start_date');
    const endDateInput = document.getElementById('end_date');

    const today = new Date().toISOString().split('T')[0];
    startDateInput.min = today;
    endDateInput.min = today;

    
    startDateInput.addEventListener('change', function () {
        endDateInput.disabled = false;
        endDateInput.min = startDateInput.value;
    });

</script>

<script>
      
      $(document).ready(function() {
            setTimeout(function() {
                $('#success-message').fadeOut('fast');
            }, 4000);

            $('.select2').select2()

            $('#task_owner').change(function(){
            console.log('hello');

        var email = $('select#task_owner option:selected').text();
        console.log(email, 'aagyi');
        $('#emailowner').val(email);
        
        });

        });
     
             

</script>

@endsection