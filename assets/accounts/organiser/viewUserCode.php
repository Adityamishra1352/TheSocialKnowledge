<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: View Score</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
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
                        <a class="nav-link" href="../../../contactus.php">Contact Us</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2 p-1">
        <?php
        include '../../_dbconnect.php';
        $test_id = $_GET['test_id'];
        $user_id = $_GET['user_id'];
        $scoreSQL = "SELECT * FROM `codinganswers` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
        $scoreResult = mysqli_query($conn, $scoreSQL);
        $scoreRow = mysqli_fetch_assoc($scoreResult);
        $score = $scoreRow['correct'];
        $timesubmit = $scoreRow['date'];
        $timestamp = strtotime($timesubmit);
        $formattedDate = date('d F Y', $timestamp);
        $formattedTime = date('H:i', $timestamp);
        $filepaths = $scoreRow['filename'];
        $files = json_decode($filepaths, true);
        $testSQL = "SELECT * FROM `codingtest` WHERE `test_id`='$test_id'";
        $testResult = mysqli_query($conn, $testSQL);
        $testRow = mysqli_fetch_assoc($testResult);
        $timefortest = $testRow['timefortest'];
        $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
        $user_result = mysqli_query($conn, $user_sql);
        $user_row = mysqli_fetch_assoc($user_result);
        echo '<div class="container my-2 p-1" style="display:grid;grid-template-columns:1fr 1fr">
        <div class="card mb-3" style="max-width: 500px;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <p class="card-text"><b>Name:</b> ' . $user_row['fname'] . ' ' . $user_row['lname'] . '</p>
                        <p class="card-text"><b>Email:</b> ' . $user_row['email'] . '</p>
                        <p class="card-text"><b>Enrollment:</b> ' . $user_row['enrollment'] . '</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="card mb-3" style="max-width: 500px;">
            <div class="row g-0">
                <div class="col-md-11">
                    <div class="card-body">
                    <ul>
                        <p class="card-text"><b>Score:</b> ' . $score . '</p>
                        <p class="card-text"><b>Time of Submission:</b> ' . $formattedTime . ' ' . $formattedDate . '</p>
                        <p class="card-text"><b>Time for the test:</b> ' . $timefortest . '</p>
                    </div>
                </div>
            </div>
        </div>
        </div>';
        ?>
    </div>
    <div class="container">
        <div class="row">

            <?php
            $numbers = [];
            $basePath = "../../test/codeTests";
            foreach ($files as $filename) {
                $number = 0;
                if (preg_match("/answers\/(\d+)php/", $filename, $matches)) {
                    $number = $matches[1];
                }else if (preg_match("/answers\/(\d+)js/", $filename, $matches)) {
                    $number = $matches[1];
                }else if (preg_match("/answers\/(\d+)cpp/", $filename, $matches)) {
                    $number = $matches[1];
                }else if (preg_match("/answers\/(\d+)python/", $filename, $matches)) {
                    $number = $matches[1];
                }
                $question_sql = "SELECT * FROM `codingquestions` WHERE `code_id`='$number'";
                $questions_result = mysqli_query($conn, $question_sql);
                $questionsRow = mysqli_fetch_assoc($questions_result);
                $questionText = $questionsRow['question'];
                $filePath = $basePath . '/' . $filename;
                $fileContent = file_get_contents($filePath);
                $previewContent = substr($fileContent, 0, 100);
                $downloadLink=$filePath;
                echo '<div class="col"><div class="card p-2" style="width: 18rem;">
            <pre class="card-text">' . htmlspecialchars($previewContent) . '</pre>
            <div class="card-body">
            <h6 class="card-title">' . $questionText . '</h6>
            <a href="' . $downloadLink . '" class="btn btn-primary" download>Download File</a>
            </div>
            </div></div>';
            }
            ?>

        </div>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>

</html>