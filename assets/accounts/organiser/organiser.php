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
    <link rel="stylesheet" href="../../css/admin1.css">
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
    <div class="container my-2">
        <ul>
            <li><h4>Quizes Posted By You!!</h4></li>
        </ul>
        <div class="container">
            <div class="row">
                <?php
                include '../../_dbconnect.php';
                $organiser_id = $_SESSION['user_id'];
                $quizfetch_sql = "SELECT * FROM `test` WHERE `organiser_id`='$organiser_id'";
                $fetch_result = mysqli_query($conn, $quizfetch_sql);
                while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                    $test_id = $rowQuiz['test_id'];
                    $heading = $rowQuiz['heading'];
                    $timeDate = $rowQuiz['time'];
                    $description = $rowQuiz['description'];
                    echo '<div class="col"><div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">' . $timeDate . '</p>
                  <p class="card-text">' . $description . '</p>
                  <a href="quiz.php?testid=' . $test_id . '" class="btn btn-outline-success">Attend Test</a>
                </div>
              </div></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <ul><li><h4>Add A Quiz!!</h4></li></ul>
        <div class="p-2" style="width: 40%;">
            <form action="createQuiz.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Topic for the Quiz:</label>
                    <input type="text" name="heading" class="form-control" id="exampleInputEmail1">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description:</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" name="description">
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Time:</label>
                    <input type="date" class="form-control" id="exampleInputEmail1" name="time">
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>