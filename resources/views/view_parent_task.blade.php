@extends('layouts.app')
@section('content')


<div>
    <h1 style= "text-align: center ;"><i>MAIN TASK DETAILS</i></h1>
</div>
<div>
     <table class="task-table">
        <thead>
            <tr>
                <th>#</th>
                <th>MAIN Task</th>
                <th>Due Date</th>
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
                <tr class="{{ $isOverdue ? 'overdue-row' : '' }}">
                    <td>{{$key+1}}</td>
                    <td>
                        <a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">
                            @if ($isSubtask)
                                <span class="badge badge-info sub-badge">Sub</span>
                            @endif
                            {{ $task->title }}
                        </a>
                    </td>
                    <td><a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">{{ \carbon\carbon::parse($task->due_date)->format('j F Y') }}</a></td>
                    <td>
                        <a href="{{ url('/kaamdekh-task-view/'.$task->id) }}">
                            @if ($task->task_status == 1)
                            <span class="badge badge-success">Active</span>
                            @elseif ($task->task_status == 2)
                                <span class="badge badge-info">
                                <i class="fas fa-check"></i> Completed</span>
                            @elseif ($task->task_status == 3)
                                <span class="badge badge-danger">Deleted</span>    
                            @else
                                <span class="badge badge-secondary">Other Status</span>
                            @endif
                        </a>
                    </td>
                </tr>
                @endif
            @endforeach
        </tbody>
    </table>
</div>

<style>
    .task-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    .task-table th, .task-table td {
        padding: 10px;
        text-align: left;
    }

    .task-table th {
        background-color: #f2f2f2;
    }

    .overdue-row {
        background-color: #f8d7da;
    }

    .sub-badge {
        background-color: orange;
        color: #fff;
        padding: 2px 6px;
        border-radius: 3px;
        margin-right: 5px;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-info {
        background-color: #17a2b8;
    }

    .badge-danger {
        background-color: #dc3545;
    }

    .badge-secondary {
        background-color: #6c757d;
    }
</style>

@endsection
