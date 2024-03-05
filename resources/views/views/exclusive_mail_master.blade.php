<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment: {{$title}}</title>
    <style>
        /* Add your CSS styles here for the email design */
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
        }

        h1 {
            color: #333;
        }

        h2 {
            color: #444;
        }

        p {
            color: #666;
        }

        img {
            max-width: 100%;
            height: auto;
        }

        .logo {
            max-width: 150px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div>
        <!-- <h1>Task Assignment</h1> -->
        <h3>You have been Assigned a task <strong><i>{{$title}}</strong></h3>
        <td><a href="http://91.203.133.103:8081/task-view/{{$task_id }}">{{$title}}</a></td>
        <!-- <h2>Task Title: {{$title}}</h2> -->
        <p>Due Date: {{$due_date}}</p>
        <h3>Task Description:</h3>
        <p>{{$description}}</p>
        <img src="https://static.ixambee.com/logo.png" alt="Embedded Image">

    </div>
</body>
</html>

