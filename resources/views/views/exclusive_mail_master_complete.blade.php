<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>your task {{$title}} Mark As Completed :) </title>
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
            <h2 style="text-align: center;">Task Details</h2>
            <h3><strong><i>Task Title</strong></h3>
            <h4><strong><i>{{$title}}</strong></h4>
            <p><a href="http://91.203.133.103:8081/task-view/{{$task_id}}">See It Here</a></td> 
            <p>{{$description}}</p>
            <!-- <img src="https://static.ixambee.com/logo.png" alt="Embedded Image"> -->

        </div>
    </body>
</html>

