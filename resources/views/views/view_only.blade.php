@extends('layouts.app')

@section('content')
<style>
    .cardboard {
        background-color: #fff;
        border-radius: 15px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        padding: 20px;
        text-align: center;
        margin: 0 auto;
        max-width: 600px;
    }

    .cardboard h4 {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .cardboard .badge {
        font-size: 16px;
        padding: 5px 10px;
    }

    .cardboard p {
        font-size: 14px;
        margin: 10px 0;
    }

    .section {
        display: flex;
        align-items: center;
        margin: 10px 0;
    }

    .section i {
        font-size: 16px;
        margin-right: 10px;
    }

    .section p {
        font-size: 14px;
        margin: 0;
    }

    .edit-button {
        text-align: center;
        margin-top: 20px;
    }

    .edit-button a {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
    }

    /* Replace the existing loader styles with the new animation styles */
    .loading-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.8);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .body {
        position: absolute;
        top: 50%;
        margin-left: -50px;
        left: 50%;
        animation: speeder .4s linear infinite;
    }

    .body > span {
        height: 5px;
        width: 35px;
        background: #000;
        position: absolute;
        top: -19px;
        left: 60px;
        border-radius: 2px 10px 1px 0;
    }

    .base span {
        position: absolute;
        width: 0;
        height: 0;
        border-top: 6px solid transparent;
        border-right: 100px solid #000;
        border-bottom: 6px solid transparent;
    }

    .base span:before {
        content: "";
        height: 22px;
        width: 22px;
        border-radius: 50%;
        background: #000;
        position: absolute;
        right: -110px;
        top: -16px;
    }

    .base span:after {
        content: "";
        position: absolute;
        width: 0;
        height: 0;
        border-top: 0 solid transparent;
        border-right: 55px solid #000;
        border-bottom: 16px solid transparent;
        top: -16px;
        right: -98px;
    }

    .face {
        position: absolute;
        height: 12px;
        width: 20px;
        background: #000;
        border-radius: 20px 20px 0 0;
        transform: rotate(-40deg);
        right: -125px;
        top: -15px;
    }

    .face:after {
        content: "";
        height: 12px;
        width: 12px;
        background: #000;
        right: 4px;
        top: 7px;
        position: absolute;
        transform: rotate(40deg);
        transform-origin: 50% 50%;
        border-radius: 0 0 0 2px;
    }

    .body > span > span:nth-child(1),
    .body > span > span:nth-child(2),
    .body > span > span:nth-child(3),
    .body > span > span:nth-child(4) {
        width: 30px;
        height: 1px;
        background: #000;
        position: absolute;
        animation: fazer1 .2s linear infinite;
    }

    .body > span > span:nth-child(2) {
        top: 3px;
        animation: fazer2 .4s linear infinite;
    }

    .body > span > span:nth-child(3) {
        top: 1px;
        animation: fazer3 .4s linear infinite;
        animation-delay: -1s;
    }

    .body > span > span:nth-child(4) {
        top: 4px;
        animation: fazer4 1s linear infinite;
        animation-delay: -1s;
    }

    @keyframes fazer1 {
        0% {
            left: 0;
        }
        100% {
            left: -80px;
            opacity: 0;
        }
    }

    @keyframes fazer2 {
        0% {
            left: 0;
        }
        100% {
            left: -100px;
            opacity: 0;
        }
    }

    @keyframes fazer3 {
        0% {
            left: 0;
        }
        100% {
            left: -50px;
            opacity: 0;
        }
    }

    @keyframes fazer4 {
        0% {
            left: 0;
        }
        100% {
            left: -150px;
            opacity: 0;
        }
    }

    @keyframes speeder {
        0% {
            transform: translate(2px, 1px) rotate(0deg);
        }
        10% {
            transform: translate(-1px, -3px) rotate(-1deg);
        }
        20% {
            transform: translate(-2px, 0px) rotate(1deg);
        }
        30% {
            transform: translate(1px, 2px) rotate(0deg);
        }
        40% {
            transform: translate(1px, -1px) rotate(1deg);
        }
        50% {
            transform: translate(-1px, 3px) rotate(-1deg);
        }
        60% {
            transform: translate(-1px, 1px) rotate(0deg);
        }
        70% {
            transform: translate(3px, 1px) rotate(-1deg);
        }
        80% {
            transform: translate(-2px, -1px) rotate(1deg);
        }
        90% {
            transform: translate(2px, 1px) rotate(0deg);
        }
        100% {
            transform: translate(1px, -2px) rotate(-1deg);
        }
    }

    .longfazers {
        position: absolute;
        width: 100%;
        height: 100%;
    }

    .longfazers span {
        position: absolute;
        height: 2px;
        width: 20%;
        background: #000;
    }

    .longfazers span:nth-child(1) {
        top: 20%;
        animation: lf .6s linear infinite;
        animation-delay: -5s;
    }

    .longfazers span:nth-child(2) {
        top: 40%;
        animation: lf2 .8s linear infinite;
        animation-delay: -1s;
    }

    .longfazers span:nth-child(3) {
        top: 60%;
        animation: lf3 .6s linear infinite;
    }

    .longfazers span:nth-child(4) {
        top: 80%;
        animation: lf4 .5s linear infinite;
        animation-delay: -3s;
    }

    @keyframes lf {
        0% {
            left: 200%;
        }
        100% {
            left: -200%;
            opacity: 0;
        }
    }

    @keyframes lf2 {
        0% {
            left: 200%;
        }
        100% {
            left: -200%;
            opacity: 0;
        }
    }

    @keyframes lf3 {
        0% {
            left: 200%;
        }
        100% {
            left: -100%;
            opacity: 0;
        }
    }

    @keyframes lf4 {
        0% {
            left: 200%;
        }
        100% {
            left: -100%;
            opacity: 0;
        }
    }
</style>

<div class="cardboard">
    <h4>
        @if (!is_null($task[0]->parent_task_id) && $task[0]->task_status == 2)
        <span class="badge badge-success"><i class="fas fa-trophy"></i> TASK COMPLETED</span>
        <span class="badge badge-warning">SUBTASK</span>
        @elseif ($task[0]->task_status == 2)
        <span class="badge badge-success"><i class="fas fa-trophy"></i> TASK COMPLETED</span>
        @elseif (!is_null($task[0]->parent_task_id))
        <span class="badge badge-warning">SUBTASK</span>
        @endif
    </h4>
    <div class="title">{{ $task[0]->title }}</div>

    <div class="section">
        <i class="fas fa-tag"></i>
        <p><strong>Type:</strong> {{ $task[0]->type }}</p>
    </div>

    <div class="section">
        <i class="fas fa-user"></i>
        <p><strong>Reported By:</strong> {{ $task[0]->reported_by }}</p>
    </div>

    <div class="section">
        <i class="fas fa-cube"></i>
        <p><strong>Medium:</strong> {{ $task[0]->medium }}</p>
    </div>

    <div class="section">
        <i class="fas fa-project-diagram"></i>
        <p><strong>Project Type:</strong> {{ $task[0]->project_type }}</p>
    </div>

    <div class="section">
        <i class="fas fa-chart-line"></i>
        <p><strong>Stage:</strong> {{ $task[0]->stage }}</p>
    </div>

    <div class="section">
        <i class="fas fa-flag"></i>
        <p><strong>Task Priority:</strong> {{ $task[0]->priority_name }}</p>
    </div>

    <div class="section">
        <i class="fas fa-snowflake"></i>
        <p><strong>Task Sprint:</strong> {{ $task[0]->task_sprint }}</p>
    </div>

    <div class="section">
        <i class="far fa-calendar-alt"></i>
        <p><strong>Report Date:</strong> {{ $task[0]->report_date }}</p>
    </div>

    <div class="section">
        <i class="fas fa-calendar-times"></i>
        <p><strong>Due Date:</strong> {{ $task[0]->due_date }}</p>
    </div>

    <div class="section">
        <i class="fas fa-align-left"></i>
        <p><strong>Description:</strong></p>
        <p>{!! html_entity_decode($task[0]->description) !!}</p>
    </div>

    <div class="edit-button">
    <a href="{{ url('/task-view/'.$task[0]->id) }}">EDIT</a>
</div>

</div>
<div class="loading-overlay" id="loadingOverlay">
    <div class="body">
        <span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </span>
        <div class="base">
            <span></span>
            <div class="face"></div>
        </div>
    </div>
    <div class="longfazers">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <h1></h1>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.edit-button a').on('click', function() {
            // Show the loading overlay
            $('#loadingOverlay').css('display', 'flex');
        });
    });
</script>

@endsection
