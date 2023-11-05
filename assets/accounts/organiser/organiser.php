<?php
session_start();
if (!isset($_SESSION['organiser']) || $_SESSION['organiser'] != true) {
    header('location:../../403.php');
}
?>
<?php
include '../../_dbconnect.php';
$currentDateTime = date('Y-m-d H:i:s');
$updateSQL = "UPDATE `test` SET `displayed` = 0 WHERE `heldtill` <= '$currentDateTime'";
$updateresult = mysqli_query($conn, $updateSQL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link rel="stylesheet" href="../../bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Dashboard</a>
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
            <button class="btn btn-sm btn-outline-primary me-2" type="button" id="addQuiz_btn">Add A Quiz</button>
            <button class="btn btn-sm btn-outline-primary me-2" type="button" id="addTest_btn">Add A Test</button>
        </form>
    </nav>
    <?php
    if (isset($_GET['addQuiz']) && $_GET['addQuiz'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Quiz has been added successfully!!</strong> View From Quizes Posted by you for more options.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <div class="container container-fluid first_container">
        <div class="row">
            <div class="col-md-9">
                <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="../../images/A.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../../images/B.jpg" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="../../images/C.jpg" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card mb-3 d-flex">
                    <div class="card-header p-3 bg-transparent">
                        <h5>Upcoming Tests:</h5>
                    </div>
                    <div class="card-body p-1" data-bs-smooth-scroll="true">
                        <?php
                        $upcomingTestSql = "SELECT * FROM `test` WHERE `time` > NOW()";
                        $upcomingTest = mysqli_query($conn, $upcomingTestSql);
                        $count = 0;
                        while ($upcomingTestRow = mysqli_fetch_assoc($upcomingTest)) {
                            $timeDate = $upcomingTestRow['time'];
                            $timestamp = strtotime($timeDate);
                            $formattedDate = date('d F Y', $timestamp);
                            echo '<div class="container m-0 p-2 bg-transparent">
                                <div class="card-title"><h5>' . $upcomingTestRow['heading'] . '</h5></div>
                                <div class="card-text">' . $formattedDate . '</div>
                              </div>';
                            $count++;
                        }
                        if ($count == 0) {
                            echo '<div class="container m-0 p-2 bg-transparent border border-rounded border-rounded-secondary">
                        <div class="card-title">There are no upcoming tests.</div>
                      </div>';
                        }
                        ?>
                    </div>
                    <div class="card-footer p-3 bg-transparent"><cite>~The Social Knowledge</cite></div>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-2 postedQuiz_container" style="display:none;">
        <ul>
            <li>
                <h4 class="text">Ongoing Quizes:</h4>
            </li>
        </ul>
        <div class="container " style="display: grid;grid-template-columns:1fr 1fr 1fr;">
            <?php
            include '../../_dbconnect.php';
            $questionsExist = "Add Questions";
            $organiser_id = $_SESSION['user_id'];
            $quizfetch_sql = "SELECT * FROM `test` WHERE `organiser_id`='$organiser_id' AND `displayed`=1";
            $fetch_result = mysqli_query($conn, $quizfetch_sql);
            $count = 0;
            while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                $test_id = $rowQuiz['test_id'];
                $timeEnd = $rowQuiz['heldtill'];
                $questionsofeach = $rowQuiz['questionsforeach'];
                $timeforeach = $rowQuiz['timeforeach'];
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
                $formattedTime = date('H:i', $timestamp);
                $description = $rowQuiz['description'];
                echo '<div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">Starts On: ' . $formattedTime . ', ' . $formattedDate . '</p>
                  <p class="card-text">Question Count: ' . $questionsofeach . '</p>
                  <p class="card-text">Time for each question: ' . $timeforeach . '</p>
                  <a href="addQuestions.php?test_id=' . $test_id . '" class="btn btn-outline-success">' . $questionsExist . '</a>
                  <a href="deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
                </div>
              </div>';
                $count++;
            }
            if ($count == 0) {
                echo '<div class="card">
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>You have not posted any quizes. Post one now.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">Admin</cite></footer>
                    </blockquote>
                    </div>
                    </div>';
            }
            ?>
        </div>
        <ul class="my-2">
            <li>
                <h4>Quizes not visible:</h4>
            </li>
        </ul>
        <div class="container my-2" style="display: grid;grid-template-columns:1fr 1fr 1fr;">
            <?php
            include '../../_dbconnect.php';
            $questionsExist = "Add Questions";
            $organiser_id = $_SESSION['user_id'];
            $quizfetch_sql = "SELECT * FROM `test` WHERE `organiser_id`='$organiser_id' AND `displayed`=0";
            $fetch_result = mysqli_query($conn, $quizfetch_sql);
            $count = 0;
            while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                $test_id = $rowQuiz['test_id'];
                $timeEnd = $rowQuiz['heldtill'];
                $questionsofeach = $rowQuiz['questionsforeach'];
                $timeforeach = $rowQuiz['timeforeach'];
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
                $formattedTime = date('H:i', $timestamp);
                $description = $rowQuiz['description'];
                echo '<div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">Starts On: ' . $formattedTime . ', ' . $formattedDate . '</p>
                  <p class="card-text">Question Count: ' . $questionsofeach . '</p>
                  <p class="card-text">Time for each question: ' . $timeforeach . '</p>
                  <a href="addQuestions.php?test_id=' . $test_id . '" class="btn btn-outline-success">' . $questionsExist . '</a>
                  <a href="deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
                </div>
              </div>';
                $count++;
            }
            if ($count == 0) {
                echo '<div class="card">
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>You have not posted any quizes.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">Admin</cite></footer>
                    </blockquote>
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
                    <label for="exampleInputEmail1" class="form-label">Topic for the Quiz:*</label>
                    <input type="text" name="heading" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description:*</label>
                    <input type="text" class="form-control" name="description" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Time For Each Question(in seconds):</label>
                    <input type="text" class="form-control" name="timeforeach" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Number of Questions to show in Quiz:</label>
                    <input type="number" class="form-control" name="questionsforeach" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Held From:*</label>
                    <input type="datetime-local" class="form-control" name="time" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Quiz held till:</label>
                    <input type="datetime-local" class="form-control" name="heldtill" required>
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
    <div class="container my-3">
        <div class="p-2 container addTest_container" style="width: 40%;display:none">
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Feature not available yet.</strong> Some functions might not work.
            </div>
            <form action="createTest.php" method="post">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Topic for the Test:*</label>
                    <input type="text" name="heading" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Description:*</label>
                    <input type="text" class="form-control" name="description" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Time to attend:</label>
                    <input type="text" class="form-control" name="timefortest" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Held From:*</label>
                    <input type="datetime-local" class="form-control" name="time" required>
                </div>
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Quiz held till:</label>
                    <input type="datetime-local" class="form-control" name="heldtill" required>
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const postedQuiz = document.querySelector("#postedQuiz_btn");
        const postedQuiz_container = document.querySelector(".postedQuiz_container");
        const addQuiz_btn = document.querySelector("#addQuiz_btn");
        const addQuiz_container = document.querySelector(".addQuiz_container");
        const first_container = document.querySelector(".first_container");
        const addTest_btn=document.querySelector("#addTest_btn");
        const addTest_container=document.querySelector(".addTest_container");
        postedQuiz.onclick = () => {
            postedQuiz_container.style.display = "block";
            addQuiz_container.style.display = "none";
            first_container.style.display = "none";
            addTest_container.style.display="none";
        }
        addQuiz_btn.onclick = () => {
            addTest_container.style.display="none";
            first_container.style.display = "none";
            postedQuiz_container.style.display = "none";
            addQuiz_container.style.display = "block";
        }
        addTest_btn.onclick = () => {
            addTest_container.style.display="block";
            first_container.style.display = "none";
            postedQuiz_container.style.display = "none";
            addQuiz_container.style.display = "none";
        }
    </script>
</body>

</html>