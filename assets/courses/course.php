<?php 
// if($_SERVER['REQUEST_METHOD']=="POST"){
    $course_id=$_GET['course_id'];
    $page_no=$_GET['page_no'];
    include '../_dbconnect.php';
        $course_sql="SELECT * FROM `courses` WHERE `course_id`='$course_id'";
        $course_result=mysqli_query($conn,$course_sql);
        while($rowCourse=mysqli_fetch_assoc($course_result)){
            $courseHeading=$rowCourse['heading'];
        }
// }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: <?php echo $courseHeading;?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/c++course.css">
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
        <h2><?php echo $courseHeading;?></h2>
        <ul>
            <?php 
            $content_sql="SELECT * FROM `course_content` WHERE `course_id`='$course_id'";
            $content_result=mysqli_query($conn,$content_sql);
            while($rowContent=mysqli_fetch_assoc($content_result)){
                $navContent=$rowContent['nav_content'];
                $pageNoContent=$rowContent['page_no'];
                echo '<li><a class="nav-item" href="course.php?course_id='.$course_id.'&page_no='.$pageNoContent.'">'.$navContent.'</a></li>';
            }
            ?>
        </ul>

    </nav>
    <div class="container">
        <main id="documentation">
            <article>
                <?php
                include '../_dbconnect.php';
                $page_no = $_GET['page_no'];
                $fetch_topic = "SELECT * FROM `course_content` WHERE `page_no`='$page_no'";
                $result = mysqli_query($conn, $fetch_topic);
                while ($row = mysqli_fetch_assoc($result)) {
                    $heading = $row['heading'];
                    $description = $row['description'];
                    echo '<h2>' . $heading . '</h2>';
                    echo '<section>' . $description . '</section>';
                    echo '<div class="d-flex"><a class="btn btn-outline-success" href="course.php?course_id='.$course_id.'&page_no='.($page_no+1).'" style="width:30%">Next</a></div>';
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