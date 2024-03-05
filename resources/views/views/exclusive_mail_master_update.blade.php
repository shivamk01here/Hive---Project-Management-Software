<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Assignment: {{$title}}</title>
    <style>
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

        h1 {z
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
            <h2>Task Update</h2>
            <h3>You have a Update in Task <strong><i>{{$title}}</strong><a href="http://91.203.133.103:8081/task-view/{{ $task_id }}"><i>See Here</i></a></h3>
            <p>Due Date: {{$due_date}}</p>
            <h3>Task Description:</h3>
            <p>{{$description}}</p>
            <img src="https://static.ixambee.com/logo.png" alt="Embedded Image">

        </div>
    </body>
</html>

