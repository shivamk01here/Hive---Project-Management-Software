@extends('layouts.app')
@section('content')

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>SPRINT Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>task Owner</th>
                    <th>Total Task</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sprints as $sprint)
                <tr>
                    <td>{{ $sprint->id }}</td>
                    <td>{{ $sprint->name }}</td>
                    <td>{{ $sprint->start_date }}</td>
                    <td>{{ $sprint->end_date }}</td>
                    <td>{{ $sprint->task_owner }}</td>
                    <td>{{ $sprint->task_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>



@endsection
