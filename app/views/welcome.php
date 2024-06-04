<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xenon MVC Framework</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            flex-direction: column;
        }

        .main-content {
            flex: 1;
        }

        #wrapper {
            margin: 10px auto;
            width: 90%;
        }

        .environment_data_class {
            background-color: #d6d6d7;
            padding: 11px 5px;
            font-size: 18px;
            font-weight: 600;
            text-align: left;
        }

        .environment_data_class span {
            color: #867676;
            font-style: italic;
        }

        .footer {
            background-color: #f8f9fa;
            padding: 10px 0;
        }
    </style>
</head>
<body>
<div class="container main-content text-center my-5">

    <div id="wrapper">
        <h1 class="display-4">Welcome to Xenon MVC Framework</h1>
        <div class="row">
                <div class="col-md-12">
                    <p class="lead">This is a simple and minimalistic MVC framework built with PHP and Bootstrap 5.</p>
                </div>
            <div class="col-md-6">
                <h4 class="alert-heading">Script Info</h4>
                <p class="environment_data_class">MVC Version : <span>v1.0.0-alpha</span></p>
                <p class="environment_data_class">Script Root : <span><?= $_SERVER['PHP_SELF']; ?></span></p>
                <p class="environment_data_class">This page is under class <span>app\Controllers\Home.php</span></p>
                <p class="environment_data_class">This page is viewing from <span>app\views\welcome.php</span></p>
            </div>
             <div class="col-md-6">
                <h4 class="alert-heading">Environment Info</h4>
                <p class="environment_data_class">PHP Version : <span><?= phpversion(); ?></span></p>
                <p class="environment_data_class">Server : <span><?= $_SERVER['SERVER_SOFTWARE']; ?></span></p>
                <p class="environment_data_class">Domain : <span><?= $_SERVER['SERVER_NAME']; ?></span></p>
                <p class="environment_data_class">Server Timezone : <span><?= date_default_timezone_get(); ?></span></p>

            </div>

        </div>
        <hr class="my-4">
        <p>Get started by exploring the documentation and creating your first controller and view.</p>
        <a class="btn btn-primary btn-sm" href="https://github.com/arif98741" role="button">Learn more</a>
        <footer class="footer text-center mt-4">
            <div class="container">
                <span class="text-muted">&copy; <?= \Illuminate\Support\Carbon::now(); ?> My MVC Framework. All rights reserved.</span>
            </div>
        </footer>
    </div>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
