<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            border-radius: 15px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
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

        /* Cardboard-like style */
        .comment-card {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 10px;
            margin-bottom: 10px;
            text-align: left;
            background-color: #fff;
        }

        .commenter-name {
            font-weight: bold;
            color: #007bff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Comments</h2>
        <p><a href="http://91.203.133.103:8081/task-view/{{$task_id}}">See It Here</a></td>  
        <div>
            @foreach($comments as $comment)
            <div class="comment-card">
                <div class="row">
                    <div class="comment">
                        <span class="commenter-name"><strong>{{ $comment->commenter }}</strong></span>
                        <p class="comment-content">{!! $comment->comment !!}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</body>
</html>

</html>

