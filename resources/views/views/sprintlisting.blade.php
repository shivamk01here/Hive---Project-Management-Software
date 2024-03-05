@extends('layouts.app')

@section('content')
<style>
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
            <div class="card-header" style="display:flex; justify-content: space-between; align-items: center;">
              <h4>Reports Listing</h4>
                <div style="margin-left: auto;">
                    <a href="{{ route('sprint-view') }}" class="btn btn-info">
                        <i class="fas fa-plus"></i> Add Sprint
                    </a>
                </div>
            </div>

           
            <table id="myTable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Startdate</th>
                        <th>DueDate</th>
                        <th>Total Tasks in Sprint</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($sprints as $key =>$sprint)
                     <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$sprint->name}}</td>
                        <td>{{$sprint->start_date}}</td>
                        <td>{{$sprint->end_date}}</td>
                        <td>{{ $sprint->task_count }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/FileSaver.js/2.0.5/FileSaver.min.js"></script>

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
        csvContent += "Number,Title,Type,Priority,Project Type,Startdate,Duedate\n";

        for (var i = 0; i < data.length; i++) {
            var number = i + 1;
            var title = $(data[i][1]).find('span.badge-sub').remove().end().text();
            var type = $(data[i][2]).text();
            var priority = $(data[i][3]).text().replace(/\n/g, ' '); 
            var projectType = $(data[i][4]).text();
            var Startdate = $(data[i][5]).text();
            var Duedate = $(data[i][6]).text();

            title = title.replace(/\s+/g, ' ').trim();

            csvContent += number + ',"' + title + '",' + type + ',"' + priority + '",' + projectType + ',"' + Startdate + '","' + Duedate + '"\n';
        }
        var blob = new Blob([csvContent], { type: "text/csv;charset=utf-8" });
        saveAs(blob, "tasks.csv");
    });
});

    
</script>
@endsection