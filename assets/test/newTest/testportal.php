<?php
include '../../_dbconnect.php';
// if(!isset($_SESSION['loggedin'])||$_SESSION['loggedin']!=true){
//     header('location:../../403.php');
// }
if (isset($_GET['test_id'])) {
    $test_id = $_GET['test_id'];
}
$testsql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
$testresult = mysqli_query($conn, $testsql);
$testRow = mysqli_fetch_assoc($testresult);
$heading = $testRow['heading'];
$timeforeach = $testRow['timeforeach'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Tests</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="../../css/testportal.css">
    <link rel="stylesheet" href="../../modules/fontawesome-free-5.15.4-web/css/all.min.css">
</head>

<body>
    <!-- timer modal  -->
    <div class="modal fade timerModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">The Social Knowledge</h1>
                </div>
                <div class="modal-body">
                    The time for the test has ended!! Please go back.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="timer_btn" onclick="window.location=('../test.php')">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <!-- result modal  -->
    <div class="modal fade" id="resultModal" tabindex="-1" aria-labelledby="resultModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="resultModalLabel">Test Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="resultModalBody">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- full screen modal -->
    <div class="modal fade fullScreenModal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">The Social Knowledge</h1>
                </div>
                <div class="modal-body">
                    The Test can only be given in FullScreen mode!!!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="fullScreen_btn">Understood</button>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar" style="background-color:#001f52;">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../index.php">
                <span class="text-light">The Social Knowledge</span>
            </a>
            <div class="p-2 timer">
                <span>Time Left:</span>
                <span id="total-time"></span>
            </div>
        </div>
    </nav>
    <nav class="navbar bg-light row" style="width:100%">
        <div class="testType col-md-4">
            <span>
                <?php echo $heading; ?>
            </span>
        </div>
        <div class="naviagtion col-md-4" id="navigation-container"></div>
        <div class="nextprevious col-md-4">
            <button class="btn btn-outline-primary" id="previousQuestion">Previous</button>
            <button class="btn btn-outline-primary" id="nextQuestion">Next</button>
        </div>
    </nav>
    <button class="btn btn-primary leftArrow" id="previousQuestionArrow"><i class="fas fa-arrow-left"></i></button>
    <button class="btn btn-primary rightArrow" id="nextQuestionArrow"><i class="fas fa-arrow-right"></i></button>
    <div class="container">
        <div class="row mt-2">
            <div class="col-md-6 border border-rounded" id="question-container"
                style="width:50%;height:400px;padding:20px">
            </div>
            <div class="col-md-6 border border-rounded" id="options-container"
                style="width:50%;height:400px;padding:20px">
            </div>
        </div>
    </div>
    <div class="footer">
        <button id="submitTest" data-bs-toggle="modal" data-bs-target="#resultModal">
            Submit Test
        </button>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script src="../../javascript/testportal.js"></script>
    <script>
        const totalTimeElement = document.getElementById('total-time');
        let totalSecondsLeft;



        function fetchQuestions(testId) {
            fetch(`getQuestions.php?testid=${testId}`)
                .then(response => response.json())
                .then(data => {
                    shuffleArray(data);
                    questions = data;
                    displayQuestion(currentQuestionIndex);
                    displayNavigationButtons();
                    console.log(questions);
                    totalTimefortest = timeforeachquestion * questions.length;
                    totalSecondsLeft = totalTimefortest;
                    setInterval(updateTimer, 1000);
                })
                .catch(error => {
                    console.error('Error fetching questions:', error);
                });
        }
        const testId = <?php echo $test_id ?>;
        let questions = [];
        let currentQuestionIndex = 0;
        const timeforeachquestion = <?php echo $timeforeach; ?>;
        let totalTimefortest;
        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }

        console.log("total time", totalTimefortest);

        fetchQuestions(testId);
    </script>
</body>

</html>