@extends('layouts.app')
@section('content')

    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <head>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.14.0/Sortable.min.js"></script>

        <style>
        /* Your custom styles can go here */
        .scrumboard {
            display: flex;
            justify-content: space-between;
            padding-top: 1.6rem;
            padding-right: 2rem;
            padding-left: 0;
        }

        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125),0 2px 2px rgba(0,0,0,.2);
        }

        .layout-fixed .main-sidebar {
            background-color:#032a6a;
        }

        /* Add unique background colors for each column header */
        .column .card-title { 
            color: #032a6a; 
            text-transform: capitalize; 
            text-align:left
        }

        .content-wrapper > .content {
            background-color: #c9ddff;
        }

        .column {
            flex: 1;
            background-color: #f8f9fa;
            margin: 0 10px;
            padding: 15px;
            width:200px;
        }

        .portlet {
            background-color: #ffffff;
            margin-bottom: 15px;
            border-radius:0.8rem
        }


        .card-header {
            border-bottom:0;
        }
   

        .card-title {
            text-align: center;
            height: 40px;
            margin-bottom: 15px;
            color: #fff;
            font-weight: bold; 
            border-radius: 5px; 
            line-height: 40px; 
        }
        
        .portlet-header a{
            color: #2b2b2b;
            font-size: 0.8rem;
            line-height: 22px;
        }
         
        .column {
            border-radius:0.8rem
        }



    </style>
    </head>

    <body>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <div class="scrumboard container">
        @foreach($stages as $stage)
        <div class="sortable-list " data-id="{{ $stage->id }}">
            <div class="column card">
            <h6 class="card-title columncard">{{ $stage->name }}</h6>
            @foreach($tasks as $task)
                @if($task->stage_id === $stage->id)
                <div class ="chacha">
                <div class="portlet card mb-3 newport" data-id="{{ $task->id }}">
                    <div class="portlet-header card-header">
                    <a href="{{ url('/task-view/'.$task->id) }}">{{ $task->title }}</a>
                    </div>
                    <!-- <div class="portlet-content card-body"></div> -->
                </div>
               </div>
                @endif
            @endforeach
            </div>
        </div>
        @endforeach
    </div>
    </body>

    
    <script>
        $(document).ready(function () {
            const columns = document.querySelectorAll('.chacha');
            columns.forEach((column) => {
                new Sortable(column, {
                    group: 'column card',
                    animation: 150,
                    onEnd: function (evt) {
                        var task_id = evt.item.getAttribute('data-id');
                        var newStage_id = evt.to.closest('.sortable-list').getAttribute('data-id');

                        evt.from.style.backgroundColor = ''; 

                        $.ajax({
                            type: "POST",
                            url: "/update-task-stage",
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content'),
                                task_id: task_id,
                                stage_id: newStage_id
                            },
                            success: function (data) {
                                console.log("Task moved successfully");
                            },
                            error: function (error) {
                                console.log("An error occurred during the Ajax request");
                            }
                        });
                    },
                });
            });
        });
    </script>
@endsection