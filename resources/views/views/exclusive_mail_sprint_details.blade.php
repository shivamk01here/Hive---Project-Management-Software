<!DOCTYPE html>
<html>
<head>
    <title>Sprint Tasks's List</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>
    
    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Task</th>
                <th>Due Date</th>
                <th>Sprint</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($task_details as $key => $task)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td><a href="http://91.203.133.103:8081/task-view/{{ $task->task_id }}">{{ $task->title}}</a></td>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->sprint_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p>Thank you!</p>
</body>
</html>
