<?php
session_start();
if (!isset($_SESSION['organiser']) || $_SESSION['organiser'] != true) {
    header('location:../../403.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-start">
            <button class="btn btn-outline-success me-2" type="button" id="postedQuiz_btn">Quizes Posted by You</button>
            <button class="btn btn-sm btn-outline-secondary" type="button" id="addQuiz_btn">Add A Quiz</button>
        </form>
    </nav>
    <div class="container my-2">
        <div class="container postedQuiz_container" style="display: none;grid-template-columns:1fr 1fr 1fr;">
            <?php
            include '../../_dbconnect.php';
            $questionsExist = "Add Questions";
            $organiser_id = $_SESSION['user_id'];
            $quizfetch_sql = "SELECT * FROM `test` WHERE `organiser_id`='$organiser_id' AND `displayed`=1";
            $fetch_result = mysqli_query($conn, $quizfetch_sql);
            while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                $test_id = $rowQuiz['test_id'];
                $questions_sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
                $questions_result = mysqli_query($conn, $questions_sql);
                if ($questions_result) {
                    $numRows = mysqli_num_rows($questions_result);
                    if ($numRows > 1) {
                        $questionsExist = "View Questions";
                    }
                }
                $heading = $rowQuiz['heading'];
                $timeDate = $rowQuiz['time'];
                $timestamp = strtotime($timeDate);
                $formattedDate = date('d F Y', $timestamp);
                $description = $rowQuiz['description'];
                echo '<div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">' . $formattedDate . '</p>
                  <p class="card-text">' . $description . '</p>
                  <a href="addQuestions.php?testid=' . $test_id . '" class="btn btn-outline-success">' . $questionsExist . '</a>
                  <a href="deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
                </div>
              </div>';
            }
            ?>
        </div>
    </div>
    </div>
    <div class="container my-3">
        <div class="p-2 container addQuiz_container" style="width: 40%;display:none">
            <form action="createQuiz.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Topic for the Quiz:</label>
                    <input type="text" name="heading" class="form-control">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description:</label>
                    <input type="text" class="form-control" name="description">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Time:</label>
                    <input type="date" class="form-control" name="time">
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script>
        const postedQuiz = document.querySelector("#postedQuiz_btn");
        const postedQuiz_container = document.querySelector(".postedQuiz_container");
        const addQuiz_btn = document.querySelector("#addQuiz_btn");
        const addQuiz_container = document.querySelector(".addQuiz_container");
        postedQuiz.onclick = () => {
            postedQuiz_container.style.display = "grid";
            addQuiz_container.style.display = "none";
        }
        addQuiz_btn.onclick = () => {
            postedQuiz_container.style.display = "none";
            addQuiz_container.style.display = "block";
        }
    </script>
</body>

</html>