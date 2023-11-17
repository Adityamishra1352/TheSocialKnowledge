<?php
session_start();
if (!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] != true) {
    header('location:../403.php');
}
$test_id = $_GET['test_id'];
include '../../_dbconnect.php';
$testSQL = "SELECT * FROM `codingtest` WHERE `test_id`='$test_id'";
$testResult = mysqli_query($conn, $testSQL);
$testRow = mysqli_fetch_assoc($testResult);
$timefortest = $testRow['timefortest'];
$attemptedQuestionIDs = [];
$inTest = 1;
$user_id = $_SESSION['user_id'];
$answersql = "SELECT * FROM `codinganswers` WHERE `test_id`='$test_id' AND `user_id`='$user_id'";
$answersresult = mysqli_query($conn, $answersql);
$answersrow = mysqli_fetch_assoc($answersresult);
$attemptedQuestionIDs[] = json_decode($answersrow['question_id'],true);
if (is_array($attemptedQuestionIDs) && !empty($attemptedQuestionIDs)) {
    $attemptedQuestionIDs = array_merge(...$attemptedQuestionIDs);
}
$filePaths = $answersrow["filename"];
$filePaths = json_decode($filePaths, true);
$numberoffiles = count($filePaths);
$completeTest = 1;
if (isset($_SESSION['startTime'])) {
    $startTime = $_SESSION['startTime'];
    $currentTime = time();
    $elapsedTime = $currentTime - $startTime;

    if ($elapsedTime > $timefortest) {
        $inTest = 1;
    }
} else {
    $inTest = 0;
    $_SESSION['timeLeft'] = $timefortest;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Code Along</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="../../modules/jquery/dist/jquery.min.js"></script>
    <link rel="stylesheet" href="../../modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand mx-auto" href="../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="navbarSupportedContent">
                <div class="container p-2 border border-danger" style="background-color:#ffbaba;border-radius:10px;">
                    <span>Time Left:</span>
                    <span id="timeRemaining"></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="100" aria-valuemin="0"
        aria-valuemax="100" style="width:100%;height:3px">
        <div class="progress-bar bg-danger" style="width: 0%" id="timeProgressBar"></div>
    </div>
    <div class="modal fade startingmodal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="backdrop-filter: blur(10px);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Information Box</h1>
                </div>
                <div class="modal-body">
                    <ul>
                        <li class="my-1">The timer for the test starts when you click the continue button.</li>
                        <li class="my-1">Choose the desired language from the dropdown column.</li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="window.location.href=(`../test.php`)">Go
                        Back</button>
                    <button type="button" class="btn btn-primary" id="continue_btn">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade resultModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="backdrop-filter: blur(10px);">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">The Social Knowledge</h1>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <center><i class="fas fa-crown my-2" style="font-size:64px;color:blue;"></i></center>
                        <center>
                            <span>You have successfully completed the test!!</span>
                            <span>You programs have been saved.</span>
                            <span>Please click on Exit to go back!!</span>
                        </center>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="exit_btn">Exit Button</button>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-2">
        <?php
        $questionSQL = "SELECT * FROM `codingquestions` WHERE `test_id`='$test_id'";
        $questionResult = mysqli_query($conn, $questionSQL);
        $countQuestion = 1;
        while ($row = mysqli_fetch_assoc($questionResult)) {
            $questionID = $row["code_id"];
            $question = $row["question"];
            $isAttempted = in_array((string)$questionID, $attemptedQuestionIDs);
            echo '<div class="card w-100 mb-3">
                <div class="card-body row">
                    <h5 class="card-title col-md-10">Question ' . $countQuestion . '.' . $question . '</h5>';
            if ($isAttempted) {
                echo '<span class="text-success">&#10003; Attempted</span>';
            } else {
                echo '<a href="codeAlong.php?test_id=' . $test_id . '&question_id=' . $questionID . '" class="btn btn-outline-primary col-md-2">Attempt</a>';
            }

            echo '</div></div>';

            $countQuestion += 1;
        }
        if ($numberoffiles == $countQuestion-1) {
            $completeTest = 1;
        } else {
            $completeTest = 0;
        }
        ?>
    </div>
    <script>
        var completeTest = <?php echo $completeTest; ?>;
    </script>
    <script>
        const exit_btn = document.querySelector("#exit_btn");
        exit_btn.onclick = () => {
            $.ajax({
                type: "POST",
                url: "unset_session.php",
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        window.location.href = (`../../../index.php`);
                    } else {
                    }
                },
                error: function () {
                    console.error("Error in AJAX request.");
                }
            });
        }
        var infoModal = new bootstrap.Modal(document.querySelector(".startingmodal"));
        var resultModal = new bootstrap.Modal(document.querySelector(".resultModal"));
        if (completeTest == 1) {
            infoModal.hide();
            resultModal.show();
        }
        var inTest = <?php echo $inTest; ?>;
        if (inTest == 0) {
            infoModal.show();
            var timefortest = <?php echo $timefortest * 60; ?>;
            document.querySelector("#continue_btn").onclick = () => {
                var timenow = Date.now();
                console.log(timenow);
                $.ajax({
                    url: 'updateStartTime.php',
                    type: 'POST',
                    data: { timeLeft: timenow },
                    success: function (response) {
                        console.log(response);
                        console.log("done");
                    },
                    error: function (error) {
                        console.error('Error updating time left:', error);
                    }
                });
                infoModal.hide();

                function updateRemainingTime() {
                    var currentTime = Date.now();
                    var elapsedTime = Math.round((currentTime - startTime) / 1000);
                    var remainingTime = Math.max(0, Math.round(timefortest - elapsedTime));
                    $.ajax({
                        url: 'updateTimeLeft.php',
                        type: 'POST',
                        data: { timeLeft: Math.round(timefortest - elapsedTime) },
                    });
                    var minutes = Math.floor(remainingTime / 60);
                    var seconds = remainingTime % 60;
                    var formattedTime = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
                    document.getElementById('timeRemaining').innerText = formattedTime;
                    if (remainingTime <= 0) {
                        clearInterval(intervalId);
                    }
                }

                var startTime = Date.now();
                var intervalId = setInterval(updateRemainingTime, 1000);
            }
        } else {
            var timefortest = <?php echo $_SESSION['timeLeft']; ?>;
            console.log(timefortest);

            var timenow = Date.now();
            console.log(timenow);
            infoModal.hide();

            function updateRemainingTime() {
                var currentTime = Date.now();
                var elapsedTime = Math.round((currentTime - startTime) / 1000);
                var remainingTime = Math.max(0, Math.round(timefortest - elapsedTime));
                $.ajax({
                    url: 'updateTimeLeft.php',
                    type: 'POST',
                    data: { timeLeft: Math.round(timefortest - elapsedTime) },
                });
                var minutes = Math.floor(remainingTime / 60);
                var seconds = remainingTime % 60;
                var formattedTime = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');
                document.getElementById('timeRemaining').innerText = formattedTime;
                if (remainingTime <= 0) {
                    clearInterval(intervalId);
                }
            }

            var startTime = Date.now();
            var intervalId = setInterval(updateRemainingTime, 1000);

        }


    </script>
</body>

</html>