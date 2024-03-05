<!DOCTYPE html>
<html>
<head>
    <title>Sprint Tasks List</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
        }
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 12px;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        a {
            text-decoration: none;
            color: #333;
        }
        a:hover {
            color: #0074cc;
        }
        p {
            text-align: center;
            margin: 20px;
            font-weight: bold;
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
                    <a href="<?php echo base_url() . '/task-view/' . $task_id; ?>" class="enroll-now">Click here to view task</a>
                    <td>{{ $task->due_date }}</td>
                    <td>{{ $task->sprint_name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p>Thank you!</p>
</body>
</html>
