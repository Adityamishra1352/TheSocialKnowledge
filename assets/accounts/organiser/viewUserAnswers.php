<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Admin</title>
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
        $scoreSQL = "SELECT * FROM `testscores` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
        $scoreResult = mysqli_query($conn, $scoreSQL);
        $scoreRow = mysqli_fetch_assoc($scoreResult);
        $score = $scoreRow['score'];
        $timesubmit = $scoreRow['date'];
        $timestamp = strtotime($timesubmit);
        $formattedDate = date('d F Y', $timestamp);
        $formattedTime = date('H:i', $timestamp);
        $answersJSON = $scoreRow['answers'];
        $pattern = '/"answer":"\[(.*?)\]"/';
        if (preg_match($pattern, $answersJSON)) {
            $answersJSON = preg_replace($pattern, '"answer":[$1]', $answersJSON);
            $answersJSON = preg_replace('/"correctAnswer":"\[(.*?)\]"/', '"correctAnswer":[$1]', $answersJSON);
        }
        $answers = json_decode($answersJSON, true);
            foreach ($answers as &$answer) {
                if (isset($answer['answer']) && is_string($answer['answer'])) {
                    $decodedAnswer = json_decode($answer['answer'], true);
                    if (json_last_error() == JSON_ERROR_NONE) {
                        $answer['answer'] = $decodedAnswer;
                    }
                }
                if (isset($answer['correctAnswer']) && is_string($answer['correctAnswer'])) {
                    $decodedCorrectAnswer = json_decode($answer['correctAnswer'], true);
                    if (json_last_error() == JSON_ERROR_NONE) {
                        $answer['correctAnswer'] = $decodedCorrectAnswer;
                    }
                }
    
                if (isset($answer['question_id'])) {
                    $question_idsUser[] = $answer['question_id'];
                }
            }
            unset($answer);
        $testSQL = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
        $testResult = mysqli_query($conn, $testSQL);
        $testRow = mysqli_fetch_assoc($testResult);
        $numberofQuestions = $testRow['questionsforeach'];
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
                        <p class="card-text"><b>Number of Questions:</b> ' . $numberofQuestions . '</p>
                    </div>
                </div>
            </div>
        </div>
        </div>';
        ?>
        <table class="table table-hover my-2">
            <thead>
                <tr>
                    <th scope="col">Sno.</th>
                    <th scope="col">Question</th>
                    <th scope="col">Selected Answer</th>
                    <th scope="col">Correct Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $count = 1;
                foreach ($answers as $answer) {
                    $question = $answer['question'];
                    $image = $answer['image'];
                    $questionShow = null;
                    if ($question == null) {
                        $questionShow = '<img src="../../images/questions/' . $image . '">';
                    } else {
                        $questionShow = $question;
                    }
                    if (is_array($answer['answer'])) {
                        $selectedAnswer = implode(', ', $answer['answer']);;
                    } else {
                        $selectedAnswer = $answer['answer'];
                    }
                    if (is_array($answer['correctAnswer'])) {
                        $correctAnswer = implode(', ', $answer['correctAnswer']);;
                    } else {
                        $correctAnswer = $answer['correctAnswer'];
                    }
                    echo '<tr>
                    <td>' . $count . '</td>
                    <td>' . $questionShow . '</td>
                    <td>' . $selectedAnswer . '</td>
                    <td>' . $correctAnswer . '</td>
                    </tr>';
                    $count++;
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
</body>

</html>