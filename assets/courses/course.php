<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $course_id = $_GET['course_id'];
    $page_no = $_GET['page_no'];
    include '../_dbconnect.php';
    if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true && !isset($_SESSION['admin']) && !isset($_SESSION['organiser'])) {
        $user_id = $_SESSION['user_id'];
        $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
        $user_result = mysqli_query($conn, $user_sql);
        if ($rowUser = mysqli_fetch_assoc($user_result)) {
            $courses = json_decode($rowUser['courses_array'], true);
            if (!is_array($courses)) {
                $courses = array();
            }
            if (!in_array($course_id, $courses)) {
                $courses[] = $course_id;
                $updated_courses = json_encode($courses);
                $update_sql = "UPDATE `users` SET `courses_array`='$updated_courses' WHERE `user_id`='$user_id'";
                $result = mysqli_query($conn, $update_sql);
            }
        }
    }
    $course_sql = "SELECT * FROM `courses` WHERE `course_id`='$course_id'";
    $course_result = mysqli_query($conn, $course_sql);
    while ($rowCourse = mysqli_fetch_assoc($course_result)) {
        $courseHeading = $rowCourse['heading'];
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge:
        <?php echo $courseHeading; ?>
    </title>
    <link rel="stylesheet" href="../css/c++course.css">
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <?php 
                    if(isset($_SESSION['admin']) && $_SESSION['admin']==true){
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../accounts/admin/admin.php">Admin Panel</a>
                    </li>';
                    }
                    elseif(isset($_SESSION['organiser']) && $_SESSION['organiser']==true){
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../accounts/organiser/organiser.php">Organiser Panel</a>
                    </li>';
                    }
                    else{
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../accounts/dashboard.php">Dashboard</a>
                    </li>';
                    }
                    ?>
                </ul>
                <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100"
                    aria-valuemin="0" aria-valuemax="100" style="width:20%">
                    <div class="progress-bar bg-danger" style="width: 0%"></div>
                </div>
            </div>
        </div>
    </nav>
    <nav id="sidebar" class="my-2 container" style="height:100vh">
        <h2>
            <?php echo $courseHeading; ?>
        </h2>
        <ul>
            <?php
            $content_sql = "SELECT * FROM `course_content` WHERE `course_id`='$course_id' AND `displayed`=1";
            $content_result = mysqli_query($conn, $content_sql);
            while ($rowContent = mysqli_fetch_assoc($content_result)) {
                $navContent = $rowContent['nav_content'];
                $pageNoContent = $rowContent['page_no'];
                echo '<li><a class="nav-item" href="course.php?course_id=' . $course_id . '&page_no=' . $pageNoContent . '">' . $navContent . '</a></li>';
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
                $fetch_topic = "SELECT * FROM `course_content` WHERE `page_no`='$page_no' AND `course_id`='$course_id' AND `displayed`=1";
                $result = mysqli_query($conn, $fetch_topic);
                while ($row = mysqli_fetch_assoc($result)) {
                    $heading = $row['heading'];
                    $description = $row['description'];
                    echo '<h2>' . $heading . '</h2>';
                    echo '<section>' . $description . '</section>';
                    echo '<div class="d-flex"><a class="btn btn-outline-success" href="course.php?course_id=' . $course_id . '&page_no=' . ($page_no + 1) . '" style="width:30%;display:none;" id="nextButton">Next</a></div>';
                }
                ?>
            </article>
        </main>
    </div>
    <script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        var startTime = new Date().getTime();
        var wordCount = 0;
        var totalTime = 0;
        var timeToRead = 0.008 * wordCount;

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
            timeToRead = 0.008 * wordCount + 60;
            checkTimeToRead();
            console.log(timeToRead);
        });

        function checkTimeToRead() {
            var currentTime = new Date().getTime();
            var timeSpentInSeconds = Math.floor((currentTime - startTime) / 1000);
            totalTime += timeSpentInSeconds;
            console.log("Time spent on this page: " + totalTime + " seconds");

            if (totalTime >= timeToRead) {
                // Enable the "Next" button
                var nextButton = document.getElementById('nextButton');
                if (nextButton) {
                    nextButton.style.display = 'block';
                }
            }
        }
        setInterval(checkTimeToRead, 1000);

    </script>
</body>

</html>