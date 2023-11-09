<?php
session_start();
include '../../_dbconnect.php';
if (
    !(isset($_SESSION['organiser']) && $_SESSION['organiser'] === true) &&
    !(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
) {
    header('location: ../../403.php');
}
$test_id = $_GET['test_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link rel="stylesheet" href="../../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="../../chart.js/dist/chart.umd.js"></script>
    <link rel="stylesheet" href="../../datatables.net-dt/css/jquery.dataTables.css">
    <style>
        .carousel-item img {
            width: 970px;
            height: 375px;
        }
    </style>
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
                        <a class="nav-link" href="organiser.php">Organiser Panel</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-light bg-light">
        <form class="container-fluid justify-content-start">
            <button class="btn btn-outline-success me-2" type="button" id="setString">Authentication Code</button>
            <button class="btn btn-outline-success me-2" type="button" id="setTime_btn">Edit Features</button>
            <button class="btn btn-outline-success me-2" type="button" id="editQuestions_btn">Edit/Add
                Questions</button>
            <button class="btn btn-outline-success me-2" type="button" id="setUsers_btn">Add Students</button>
            <button class="btn btn-outline-success me-2" type="button" id="users_btn">Responses</button>
        </form>
    </nav>
    <?php
    if (isset($_GET['uploadQuestions']) && $_GET['uploadQuestions'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Questions have been added successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['timeUpdate']) && $_GET['timeUpdate'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The constraints for the test has been changed successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['startString']) && $_GET['startString'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The start string for the test has been added successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['scoreRelease']) && $_GET['scoreRelease'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The score is now being displayed</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['allowRestart']) && $_GET['allowRestart'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The user can now restart the test.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['addUsers']) && $_GET['addUsers'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The users for the test have been added successfully.</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }

    ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Multiple Choice Feature under maintainence.</strong> Some functions might not work.
    </div>
    <?php
    $recent_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
    $recent_result = mysqli_query($conn, $recent_sql);
    $recentRow = mysqli_fetch_assoc($recent_result);
    $startTime = $recentRow['time'];
    $questionsEach = $recentRow['questionsforeach'];
    $timeforeach = $recentRow['timeforeach'];
    $timeEnd = $recentRow['heldtill'];
    $startString = $recentRow['startString'];
    ?>
    <div class="first_container container">
        <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner" style="width:100%;">
                <div class="carousel-item active">
                    <img src="../../images/5.jpeg" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../images/ISRO1.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../images/1.jpg" class="d-block w-100" alt="...">
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
    <div class="container startString_container my-3 card p-2" style="display: none;width:30%;">
        <h4>Set Authentication String:</h4>
        <?php
        if ($startString != null) {
            echo '<ul><li><h6 class="text-secondary">Current: <b>' . $startString . '</b></h6></li></ul>';
        }
        ?>

        <div class="container p-1">
            <form action="startString.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="startString" placeholder="Enter the Start String">
                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                </div>
                <button type="submit" class="btn btn-outline-success my-2">Submit</button>
            </form>
        </div>
    </div>
    <div class="editQuestions_container container" style="display:none;">
        <div class="container my-2 p-1 ">
            <ul>
                <li>
                    <h4>Add Questions:</h4>
                </li>
            </ul>
            <div class="changethequestions_box p-2">
                <ul>
                    <li>
                        <h6>Add Questions Individually:</h6>
                    </li>
                </ul>
                <div class="container p-2">
                    <label for="questionType">
                        <h6>Select the Type of question:</h6>
                    </label>
                    <select name="questionType" class="form-select" id="questionType" style="width:40%;">
                        <option value="singleAnswer">Single Answer</option>
                        <option value="multipleAnswer">Multiple Answer</option>
                    </select>
                </div>
                <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> Give three spaces
                    for a line break.</span><span class="fst-italic text-secondary"> Select the Answers by clicking on
                    the radio button.</span>
                <div class="container my-2">
                    <form id="question-form" action="uploadQuestions.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                        <input type="hidden" name="answer_type" id="answerType">
                        <div id="questions">
                        </div>
                        <button type="button" class="btn btn-primary m-2" id="add-question">Add Question</button>
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                    </form>
                </div>
                <ul>
                    <li>
                        <h6>Add questions via CSV file:</h6>
                    </li>
                </ul>
                <span class="fw-bold fst-italic">Note: </span><span class="fst-italic text-secondary">If the question or
                    answer has " , " please enclose the question/answer in "".</span>
                <div class="container my-2">
                    <form id="question-form" action="uploadQuestions3.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                        <div id="questions">
                        </div>
                        <input type="file" name="csv_file" accept=".csv" required>
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container my-2">
            <form action="deleteQuestions.php?test_id=<?php echo $test_id; ?>" method="post">
                <ul>
                    <li>
                        <h4>Present Questions:</h4>
                    </li>
                </ul>
                <table class="table my-2 table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Question</th>
                            <th scope="col">Options</th>
                            <th scope="col">Answer</th>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delete
                                    </label>
                                </div>
                                <!-- <input type="checkbox" id="selectAll"><span>Delete</span> -->
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $questionId = $row['question_id'];
                            $question = $row['question'];
                            $optionsJSON = $row['options'];
                            $options = json_decode($optionsJSON, true);
                            $answer = $row['answer'];
                            $questionImage = $row['image'];
                            echo "<tr>
                        <th scope='row'>$count</th>
                        <td>";
                            if ($questionImage != NULL) {
                                echo $question;
                                echo '<img src="../../images/questions/' . $questionImage . '">';
                            } else {
                                echo $question;
                            }
                            echo "</td>
                        <td>";
                            $countOption = 1;
                            foreach ($options as $option) {
                                echo "$countOption. $option<br>";
                                $countOption += 1;
                            }

                            echo "</td>
                        <td>$answer</td>
                        <td><input type='checkbox' name='delete[]' value='$questionId' class='form-check-input'></td>
                        </tr>";
                            $count += 1;
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-danger my-2 me-2" name="deleteSelected">Delete
                    Selected</button>
            </form>
        </div>
    </div>
    <div class="setTime_container container p-1 my-2" style="display:none;width:30%">
        <form action="setTime.php" method="post">
            <div class="mb-3">
                <label for="startTime" class="form-label">Time To Start:</label>
                <input type="datetime-local" class="form-control" id="startTime" name="startTime"
                    placeholder="<?php echo $startTime; ?>">
            </div>
            <div class="mb-3">
                <label for="numberofQuestions" class="form-label">Number of Questions:</label>
                <input type="number" placeholder="<?php echo $questionsEach; ?>" class="form-control"
                    id="numberofQuestions" name="numberofQuestions">
            </div>
            <div class="mb-3">
                <label for="timeforeach" class="form-label">Time for each question(in seconds):</label>
                <input type="number" class="form-control" placeholder="<?php echo $timeforeach; ?>" id="timeforeach"
                    name="timeforeach">
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">Time To End:</label>
                <input type="datetime-local" class="form-control" id="endTime" placeholder="<?php echo $timeEnd; ?>"
                    name="endTime">
                <input type="hidden" name="test_id" value=<?php echo $test_id; ?>>
            </div>
            <button type="submit" class="btn btn-outline-success">Submit</button>
        </form>
    </div>
    <div class="container users_container my-2 p-1" style="display:none;">
        <nav class="navbar">
            <form class="container-fluid justify-content-start">
                <div class="d-flex">
                    <button class="btn btn-outline-success me-2" type="button" id="exportExcel">Export Excel
                        Sheet</button>
                    <button class="btn btn-outline-success me-2" type="button" id="scoreRelease" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Release Score</button>
                    <button class="btn btn-outline-success me-2" type="button" id="graphical" data-bs-toggle="modal"
                        data-bs-target="#graphModal">Questions Analysis</button>
                </div>
            </form>
        </nav>
        <!-- Score Release Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Release Score for this quiz:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <ul><li><h4>Choose when to release the score:</h4></li></ul>
                        <div class="container m-1">
                            <ul><li><h6>Set when to release:</h6></li></ul>
                            <form method="post" action="scoreReleaseDate.php">
                                <div class="mb-3">
                                    <input type="datetime-local" class="form-control" name="dateRealease">
                                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                                </div>
                            </form>
                        </div> -->
                        <div class="container m-1">
                            <ul>
                                <li>
                                    <h6>Release Now:</h6>
                                </li>
                            </ul>
                            <form action="scoreReleaseNow.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                                    <button class="btn btn-outline-success">Release Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="graphModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Graphical Analysis for this quiz:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <canvas id="myPieChart" width="100%"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <?php
        $question_idsUser = [];
        $scoreSQL = "SELECT answers FROM `testscores` WHERE `test_id` = '$test_id'";
        $scoreResult = mysqli_query($conn, $scoreSQL);
        while ($scoreRow = mysqli_fetch_array($scoreResult)) {
            $answers = json_decode($scoreRow["answers"], true);
            foreach ($answers as $answer) {
                if (isset($answer['question_id'])) {
                    $question_idsUser[] = $answer['question_id'];
                }
            }
        }
        $attempts = [];
        $sql = "SELECT question_id FROM questions WHERE test_id = '$test_id'";
        $result = mysqli_query($conn, $sql);
        while ($row = mysqli_fetch_assoc($result)) {
            $questionId = $row['question_id'];
            $attempts[$questionId] = 0;
        }
        foreach ($question_idsUser as $userQuestion) {
            if (isset($attempts[$userQuestion])) {
                $attempts[$userQuestion]++;
            }
        }
        $questionLabels = [];
        $attemptCounts = [];
        foreach ($attempts as $questionId => $count) {
            $sql = "SELECT question FROM questions WHERE question_id = $questionId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $questionLabels[] = $row['question'];
            $attemptCounts[] = $count;
        }
        ?>
        <div class="container my-2" style="display:grid;grid-template-columns:1fr 1fr;">
            <div class="card mb-3 p-2" style="width:500px;height:400px;">
                <canvas id="myChart"></canvas>
            </div>
            <div style="width:100%;height:100%;">
                <div class="card mb-3" style="max-width: 500px;">
                    <div class="row g-0">
                        <div class="col-md-8">
                            <div class="card-body">
                                <p class="card-text"><b>Number of Questions: </b>
                                    <?php echo $questionsEach; ?>
                                </p>
                                <p class="card-text"><b>Time For Each Question: </b>
                                    <?php echo $timeforeach; ?>
                                </p>
                                <p class="card-text"><b>Ends At:</b>
                                    <?php $timestamp = strtotime($timeEnd);
                                    $formattedDate = date('d F Y', $timestamp);
                                    echo $formattedDate; ?>
                                </p>
                                <p class="card-text"><b>Start String: </b>
                                    <?php echo $startString; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <form action="allowRestart.php?test_id=<?php echo $test_id ?>" method="post">
                <table class="table my-2 table-hover" id="attendedUserTable">
                    <thead>
                        <tr>
                            <th class="sortable">S.no</th>
                            <th class="sortable">Name</th>
                            <th class="sortable">Email</th>
                            <th class="sortable">Enrollment</th>
                            <th class="sortable">Score</th>

                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" id="attemptedAll" type="checkbox" value="">
                                    <label for="attemptedAll" class="form-check-label">Restart</label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../_dbconnect.php';
                        $dataArray = array();
                        $pic = null;
                        $countUser = 1;
                        $count = 0;
                        $user_sql = "SELECT * FROM users WHERE test_array LIKE '%\"$test_id\"%'";
                        $user_result = mysqli_query($conn, $user_sql);
                        while ($rowUser = mysqli_fetch_assoc($user_result)) {
                            $count = $count + 1;
                            $user_id = $rowUser['user_id'];
                            $score_sql = "SELECT * FROM `testscores` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
                            $score_result = mysqli_query($conn, $score_sql);
                            $scoreRow = mysqli_fetch_assoc($score_result);
                            $score = $scoreRow['score'];
                            $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
                            $email = $rowUser['email'];
                            $enrollment = $rowUser['enrollment'];
                            $userData = array(
                                "user_id" => $user_id,
                                "name" => $name,
                                "score" => $score,
                                "email" => $email,
                                "enrollment" => $enrollment
                            );
                            $dataArray[] = $userData;
                            $highestScore = 0;
                            $lowestScore = PHP_INT_MAX;
                            $totalScore = 0;
                            $scoreCount = count($dataArray);
                            $highestScoringUsers = [];
                            $lowestScoringUsers = [];
                            $averageScoringUsers = [];
                            foreach ($dataArray as $userData) {
                                $score = $userData['score'];
                                $totalScore += $score;
                                $scoreCount++;

                                if ($score > $highestScore) {
                                    $highestScore = $score;
                                }

                                if ($score < $lowestScore) {
                                    $lowestScore = $score;
                                }
                            }
                            $averageScore = $scoreCount > 0 ? $totalScore / $scoreCount : 0;
                            $averageScore = ceil($averageScore);
                            $highestScoringUsers = [];
                            $lowestScoringUsers = [];
                            $averageScoringUsers = [];
                            foreach ($dataArray as $userData) {
                                $score = $userData['score'];
                                if ($score === $highestScore) {
                                    $highestScoringUsers[] = $userData['name'];
                                } elseif ($score === $lowestScore) {
                                    $lowestScoringUsers[] = $userData['name'];
                                } elseif ($score === $averageScore) {
                                    $averageScoringUsers[] = $userData['name'];
                                }
                            }

                            echo '<tr>
                <th scope="row">' . $countUser . '</th>
                <td><a href="viewUserAnswers.php?user_id=' . $user_id . '&test_id=' . $test_id . '">' . $name . '</a></td>
                <td>' . $email . '</td>
                <td>' . $enrollment . '</td>
                <td class="sort-ascending">' . $score . '</td>
                <td><input type="checkbox" name="allowRestart[]" value="' . $user_id . '" class="form-check-input"></td>
                </tr>';
                            $countUser = $countUser + 1;
                        }
                        if ($count == 0) {
                            echo '<div class="card">
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>No one has attempted the quiz yet.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">The Social Knowledge</cite></footer>
                  </blockquote>
                </div>
              </div>';
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="allowRestart_btn" class="btn btn-outline-success my-2">
                    Allow Restart
                </button>
            </form>
        </div>
    </div>
    <div class="container setUsers_container my-2 p-1" style="display:none;">
        <!-- <nav class="navbar">
            <form class="container-fluid justify-content-start">
                <div class="d-flex">
                    <button class="btn btn-outline-success me-2" data-bs-toggle="modal"
                        data-bs-target="#currentUserModal" type="button" id="exportExcel">Current Users</button>
                </div>
            </form>
        </nav> -->
        <!-- <div class="modal fade" id="currentUserModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Current Users:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table my-2 table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">Sno</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Enrollment</th>
                                    <th scope="col">
                                        <div class="form-check">
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Select
                                            </label>
                                            <input class="form-check-input" type="checkbox" value=""">
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div> -->
        <form id="filter-form">
            <div class="row">
                <div class="form-group col" style="width:40%;">
                    <label for="year" class="form-label"><b>Year:</b></label>
                    <select class="form-control" id="year" name="year">

                    </select>
                </div>
                <div class="form-group col" style="width:40%;">
                    <label for="batch" class="form-label"><b>Batch:</b></label>
                    <select class="form-control" id="batch" name="batch">

                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success my-2" style="width: 10%;" id="filter_btn">Filter</button>
        </form>
        <form action="userForTest.php?test_id=<?php echo $test_id; ?>" method="post" class="tableFilterUser"
            style="display:none;">
            <table class="table my-2 table-hover" id="selectUsersTable">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Email</th>
                        <th scope="col">Enrollment</th>
                        <th scope="col">
                            <div class="form-check">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="allowAll">
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="user-list">
                </tbody>
            </table>
            <button type="submit" class="btn btn-outline-success my-2 me-2" name="allowSelected">Allow Selected</button>
    </div>
    </form>
    <script src="../../jquery/dist/jquery.min.js"></script>
    <script src="../../datatables.net/js/jquery.dataTables.js"></script>
    <script>
        //data tables for searching ascending and decreasing order processes
        $(document).ready( function () {
    $('#attendedUserTable').DataTable();
    $('#mytable').DataTable();
} );

    </script>

    <script>
        //filter user functionality
        $(document).ready(function () {
            $('#filter-form').submit(function (e) {
                e.preventDefault();
                var year = $('#year').val();
                var batch = $('#batch').val();
                $.ajax({
                    type: 'POST',
                    url: 'filter-users.php',
                    data: { year: year, batch: batch },
                    success: function (response) {
                        $('#user-list').html(response);
                    }
                });
            });
        });
    </script>
    <script>
        //Highest, average and lowest score chart
        const ctx = document.querySelector("#myChart");
        const highestScore = <?php echo $highestScore; ?>;
        const lowestScore = <?php echo $lowestScore; ?>;
        const averageScore = <?php echo $averageScore; ?>;
        const highestScoringUsers = <?php echo json_encode($highestScoringUsers); ?>;
        const lowestScoringUsers = <?php echo json_encode($lowestScoringUsers); ?>;
        const averageScoringUsers = <?php echo json_encode($averageScoringUsers); ?>;

        function getTooltipText(context) {
            const datasetIndex = context.datasetIndex;
            switch (datasetIndex) {
                case 0:
                    return "Score:" + highestScore + " Users with Highest Marks: " + highestScoringUsers.join(', ');
                case 1:
                    return "Score:" + averageScore + " Users with Average Marks: " + averageScoringUsers.join(', ');
                case 2:
                    return "Score:" + lowestScore + " Users with Lowest Marks: " + lowestScoringUsers.join(', ');
                default:
                    return '';
            }
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Score'],
                datasets: [
                    {
                        label: 'Highest',
                        data: [highestScore],
                        borderWidth: 1,
                        backgroundColor: '#7FFF00'
                    },
                    {
                        label: 'Average',
                        data: [averageScore],
                        borderWidth: 1,
                        backgroundColor: '#F0E68C'
                    },
                    {
                        label: 'Lowest',
                        data: [lowestScore],
                        borderWidth: 1,
                        backgroundColor: '#FF0000'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return getTooltipText(context);
                            }
                        }
                    }
                }
            }
        });
        //pie Chart
        var cta = document.getElementById('myPieChart').getContext('2d');
        var myPieChart = new Chart(cta, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($questionLabels); ?>,
                datasets: [{
                    data: <?php echo json_encode($attemptCounts); ?>,
                    backgroundColor: [
                        'red',
                        'blue',
                        'green',
                        'orange',
                        'purple',
                        'maroon',
                        'crimson',
                        'lightgreen',
                        'lightblue',
                        'brown',
                        'coral',
                        'chocolate'

                    ],
                }],
            },
        });
    </script>
    <script src="../../xlsx/dist/xlsx.full.min.js"></script>
    <script>
        //excel sheet export functionality
        document.getElementById("exportExcel").addEventListener("click", function () {
            const data = [
                ["User ID", "Name", "Email", "Score", "Enrollment Number"]
            ];
            <?php
            foreach ($dataArray as $userData) {
                echo "data.push(['" . $userData['user_id'] . "', '" . $userData['name'] . "', '" . $userData['email'] . "', '" . $userData['score'] . "','" . $userData['enrollment'] . "']);\n";
            }
            ?>
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(workbook, worksheet, "UserData");
            const arrayBuffer = XLSX.write(workbook, { bookType: "xlsx", type: "array" });
            const blob = new Blob([arrayBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "user_data.xlsx";
            a.click();
            window.URL.revokeObjectURL(url);
        });
    </script>>
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/addQuestions.js"></script>
</body>

</html>