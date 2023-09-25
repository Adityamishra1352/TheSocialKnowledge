<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('location:../../403.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Admin</title>
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
    <div class="container my-3">
        <ul><li><h4>Organisers:</h4></li></ul>
        <div class="row my-2">
            <?php
            include '../../_dbconnect.php';
            $viewOrganisers = "SELECT * FROM `users` WHERE `organiser`=1";
            $viewOrganiser_result = mysqli_query($conn, $viewOrganisers);
            while ($rowOrganiser = mysqli_fetch_assoc($viewOrganiser_result)) {
                $name = $rowOrganiser['fname'] . " " . $rowOrganiser['lname'];
                $email = $rowOrganiser['email'];
                $orgainser_id = $rowOrganiser['user_id'];
                echo '<div class="col">
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $name . '</h5>
                  <p class="card-text">' . $email . '</p>
                  <a href="deleteOrganiser.php?orgainser_id=' . $orgainser_id . '" class="btn btn-outline-danger">Delete Orgainser</a>
                </div>
              </div>
              </div>';
            }
            ?>
        </div>
    </div>
    <div class="container addOrgainsers my-3">
        <ul><li><h4>Add Another Organiser:</h4></li></ul>
        <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> The new organiser must be
            the user of the website.</span>
            <form method="post" action="addOrganiser.php" style="width: 40%;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="email">
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
    </div>
    <div class="container my-3">
        <ul>
            <li><h4>Quizes Visible On The Website!!</h4></li>
        </ul>
        <div class="container">
            <div class="row">
                <?php
                include '../../_dbconnect.php';
                $nameOrganiser=null;
                $organiser_id = $_SESSION['user_id'];
                $organiserFetch="SELECT * FROM `users` WHERE `user_id`='$organiser_id'";
                $organiserFetch_result=mysqli_query($conn,$organiserFetch);
                while($rowFetchOrganiser=mysqli_fetch_assoc($organiserFetch_result)){
                    $nameOrganiser=$rowFetchOrganiser['fname']." ". $rowFetchOrganiser['lname'];
                }
                $quizfetch_sql = "SELECT * FROM `test` WHERE `displayed`=1";
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
                  <p class="card-text text-secondary">' . $nameOrganiser . '</p>
                  <a href="../organiser/addQuestions.php?testid=' . $test_id . '" class="btn btn-outline-success">Read Questions</a>
                  <a href="../organiser/deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
                </div>
              </div></div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <ul>
            <li><h4>Quizes Not Visible On The Website!!</h4></li>
        </ul>
        <div class="container">
            <div class="row">
                <?php
                include '../../_dbconnect.php';
                $nameOrganiser=null;
                $organiser_id = $_SESSION['user_id'];
                $organiserFetch="SELECT * FROM `users` WHERE `user_id`='$organiser_id'";
                $organiserFetch_result=mysqli_query($conn,$organiserFetch);
                while($rowFetchOrganiser=mysqli_fetch_assoc($organiserFetch_result)){
                    $nameOrganiser=$rowFetchOrganiser['fname']." ". $rowFetchOrganiser['lname'];
                }
                $quizfetch_sql = "SELECT * FROM `test` WHERE `displayed`=0";
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
                  <p class="card-text text-secondary">' . $nameOrganiser . '</p>
                  <a href="../organiser/addQuestions.php?testid=' . $test_id . '" class="btn btn-outline-success">Read Questions</a>
                </div>
              </div></div>';
                }
                ?>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <ul><li><h4>Manage Course Tests:</h4></li></ul>
        <div class="container">
            <?php 
            $coursequizfetch_sql = "SELECT * FROM `coursetests`";
            $coursefetch_result = mysqli_query($conn, $coursequizfetch_sql);
            while ($rowCourseQuiz = mysqli_fetch_assoc($coursefetch_result)) {
                $test_id = $rowCourseQuiz['coursetest_id'];
                $heading = $rowCourseQuiz['coursetest_name'];
                $description = $rowCourseQuiz['coursetest_description'];
                echo '<div class="col"><div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">' . $heading . '</h5>
              <p class="card-text">' . $description . '</p>
              <p class="card-text text-secondary">' . $nameOrganiser . '</p>
              <a href="../organiser/addQuestions.php?testid=' . $test_id . '" class="btn btn-outline-success">Read Questions</a>
              <a href="../organiser/deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
            </div>
          </div></div>';
            }
            ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>