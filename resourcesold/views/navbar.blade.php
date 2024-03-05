<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" /> -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

    <!-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script> -->

    <title>Reports Listing</title>
    <style>
        .__next {
            display: flex;
        }

        .navbar-vertical {
            /* Set the desired width for the navbar */
            width: 250px;
            /* Add any additional styling for the navbar */
            background-color: #fff;
            /* Example background color */
        }

        .page-content {
            /* Add any additional styling for the page content */
            flex: 1;

            padding: 20px;
            margin-left: 250px;
        }

        .navbar {
            background-color: #333;
            color: #fff;
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            width: 250px;
            overflow-y: auto;
            padding: 1rem;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        .vertical-nav {
            display: flex;
            flex-direction: column;
        }

        .nav-item {
            margin-bottom: 1rem;
        }

        .nav-link {
            color: #fff;
            text-decoration: none;
            transition: color 0.3s;
        }

        .nav-link:hover {
            color: #ff9900;
        }

        /* Add a little space to the right of the navbar content */
        .container {
            margin-left: 260px;
            /* Adjust as needed */
            padding: 1rem;
        }
    </style>
</head>

<body>
    <nav class="navbar">

        <ul class="navbar-nav vertical-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('new-task') }}">Create new Task</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('kaamdekh-list') }}">Task listing</a>
            </li>
            <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('new-task') }}">Services</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('new-task') }}">Contact</a>
                </li> -->
        </ul>

    </nav>

</body>

</html>