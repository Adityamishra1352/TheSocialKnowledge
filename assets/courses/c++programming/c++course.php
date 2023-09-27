<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: C++ Programming</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../../css/c++course.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Link</a>
                    </li>
                </ul>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100" style="width:20%">
                    <div class="progress-bar bg-danger" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </nav>
    <nav id="sidebar">
        <h2>C++ Programming</h2>
        <ul>
            <li><a class="nav-item" href="c++course.php?page_id=1">Introduction</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=2">C++ Syntax</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=3">C++ Output</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=4">C++ Variables</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=5">C++ User Input</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=6">C++ Data Types</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=7">C++ Operators</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=8">C++ Strings</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=9">C++ Math</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=10">C++ Booleans</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=11">C++ Conditions</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=12">C++ Switch</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=13">C++ Loops</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=14">C++ Break/Continue</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=15">C++ Array</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=16">C++ Structures</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=17">C++ Pointers</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=24">C++ Functions</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=18">C++ Function Parameters</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=19">C++ Function Overloading</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=20">C++ Recursion</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=25">C++ OOP</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=21">C++ Classes/Objects</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=22">C++ Class Methods</a></li>
            <li><a class="nav-item" href="c++course.php?page_id=23">C++ Constructors</a></li>
        </ul>

    </nav>
    <div class="container">
        <main id="documentation">
            <article>
                <?php
                include '../../_dbconnect.php';
                $page_id = $_GET['page_id'];
                $fetch_topic = "SELECT * FROM `c++course` WHERE `page_id`='$page_id'";
                $result = mysqli_query($conn, $fetch_topic);
                while ($row = mysqli_fetch_assoc($result)) {
                    $heading = $row['heading'];
                    $description = $row['description'];
                    $code = $row['code'];
                    echo '<h2>' . $heading . '</h2>';
                    echo '<section>' . $description . '</section>';
                    echo $code;
                }
                ?>
            </article>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        var startTime = new Date().getTime();
        var wordCount = 0;
        var progressBar = document.querySelector('.progress .progress-bar');
        var totalTime=0;

        function sendTimeSpent() {
            var endTime = new Date().getTime();
            var timeSpentInSeconds = Math.floor((endTime - startTime) / 1000);
            totalTime += timeSpentInSeconds;
            console.log("Time spent on this page: " + totalTime + " seconds");
        }

        window.addEventListener('beforeunload', sendTimeSpent);

        function countWords(elementId) {
            var element = document.getElementById(elementId);
            if (element) {
                var text = element.textContent || element.innerText;
                var wordCount = text.split(/\s+/).filter(Boolean).length;
                return wordCount;
            }
            return 0;
        }

        window.addEventListener('load', function () {
            wordCount = countWords('documentation');
        });
        var timeToRead=0.008*wordCount;
        if(timeToRead==totalTime){
            console.log("Progress increased");
        }
        else{
            console.log("Cheater huhhh");
        }
    </script>
</body>

</html>