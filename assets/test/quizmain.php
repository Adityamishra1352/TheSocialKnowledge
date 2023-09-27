<?php
session_start();
include '../_dbconnect.php';
$test_id = $_GET['testid'];
$quiz_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
$quiz_result = mysqli_query($conn, $quiz_sql);
$heading = null;
while ($quizRow = mysqli_fetch_assoc($quiz_result)) {
    $heading = $quizRow['heading'];
}
$questions_sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
$result = mysqli_query($conn, $questions_sql);
// $questionsArray = array();
// while ($rowQuestion = mysqli_fetch_assoc($result)) {
//     $question = $rowQuestion['question'];
//     $answer = $rowQuestion['answer'];
//     $options = array(
//         $rowQuestion['option1'],
//         $rowQuestion['option2'],
//         $rowQuestion['option3'],
//         $rowQuestion['option4']
//     );
//     $questionData = array(
//         'question' => $question,
//         'answer' => $answer,
//         'options' => $options
//     );
//     $questionsArray[] = $questionData;
// }
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                        <a class="nav-link active" aria-current="page" href="../sorting_visualizer/index.php">Sorting
                            Visualizer</a>
                    </li>
                    <!-- when logged in will show dashboard or signup login -->
                    <!-- <li class="nav-item">
          <a class="nav-link" href="#"></a>
        </li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Dropdown
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li><a class="dropdown-item" href="#">Another action</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    <div class="container my-2 p-1" style="width: 60%;">
        <nav class="navbar bg-body-tertiary rounded-top">
            <div class="container-fluid">
                <span class="navbar-brand">
                    <?php echo $heading; ?>
                </span>
                <div class="d-flex">
                    <!-- <div class="timer mx-2" style="width:100%;">
                        <div class="time_left">Time left</div>
                        <div class="time_sec">30</div>
                    </div>
                    <div class="time_line"></div> -->
                    <?php
                    if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
                        echo '<button class="btn btn-outline-success" onclick="window.location.href=(`../accounts/login.php`)" style="width:fit-content;">Sign In</button>';
                    } else {
                        echo '<button class="btn btn-outline-danger" onclick="window.location.href=(`../accounts/logout.php`)" style="width:100%;">Log Out</button>';
                    }
                    ?>
                </div>
            </div>
        </nav>
        <div class="container bg-light">
            <div class="progress" role="progressbar" aria-label="Example 1px high" aria-valuenow="25" aria-valuemin="0"
                aria-valuemax="100" style="height: 5px; width:100%;">
                <div class="progress-bar bg-danger" style="width: 25%"></div>
            </div>
        </div>
        <div class="container p-2">
            <form action="uploadAnswers.php" method="post">
                <?php
                $count = 1;
                while ($rowResult = mysqli_fetch_assoc($result)) {
                    echo '<div class="container my-2">
                <span class="text fs-5 bold">' . $count . '. ' . $rowResult['question'] . '</span>
                <input type="hidden" value="' . $rowResult['question_id'] . '" name="question_id[]"> <!-- Use [] to create an array -->
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option[' . $rowResult['question_id'] . ']" id="flexRadioDefault1">
                    <label class="form-check-label fs-6" for="flexRadioDefault1">
                        ' . $rowResult['option1'] . '
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option[' . $rowResult['question_id'] . ']" id="flexRadioDefault2">
                    <label class="form-check-label fs-6" for="flexRadioDefault2">
                        ' . $rowResult['option2'] . '
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option[' . $rowResult['question_id'] . ']" id="flexRadioDefault3">
                    <label class="form-check-label fs-6" for="flexRadioDefault3">
                        ' . $rowResult['option3'] . '
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="option[' . $rowResult['question_id'] . ']" id="flexRadioDefault4">
                    <label class="form-check-label fs-6" for="flexRadioDefault4">
                        ' . $rowResult['option4'] . '
                    </label>
                </div>
            </div>';
                    $count = $count + 1;
                }
                ?>
                <input type="submit" value="Submit">
            </form>

            <div class="container-fluid">
                <div class="d-flex">
                    <button class="btn btn-outline-success my-2">Submit</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <!-- <script>
        const timeCount = document.querySelector(".timer .time_sec");
        const timeLine = document.querySelector(".time_line");
    </script> -->
</body>

</html>