<?php
session_start();
$test_id = 0;
$user_id = $_SESSION['user_id'];
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../403.php');
} else {
    include '../_dbconnect.php';
    $test_id = $_GET['testid'];
    $quiz_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
    $quiz_result = mysqli_query($conn, $quiz_sql);
    $heading = null;
    $timeforeach = null;
    $questionsforeach = null;
    $startTime = null;
    $endTime = null;
    $startString = null;
    while ($quizRow = mysqli_fetch_assoc($quiz_result)) {
        $heading = $quizRow['heading'];
        $timeforeach = $quizRow['timeforeach'];
        $questionsforeach = $quizRow['questionsforeach'];
        $startTime = $quizRow['time'];
        $endTime = $quizRow['heldtill'];
        $startString = $quizRow['startString'];
    }
    $fname = null;
    $lname = null;
    $enroll = null;
    $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $user_result = mysqli_query($conn, $user_sql);
    $test_array = 0;
    while ($rowUser = mysqli_fetch_assoc($user_result)) {
        $fname = $rowUser['fname'];
        $lname = $rowUser['lname'];
        $test_array = $rowUser['test_array'];
        $enroll = $rowUser['enrollment'];
    }

    $decodedArray = json_decode($test_array);
    $alreadyAppeared = 0;
    if (is_array($decodedArray)) {
        if (in_array($test_id, $decodedArray)) {
            $alreadyAppeared = 1;
        }
    } else {
        $decodedArray = [];
    }

    $certificate_id = null;
    $certificate_sql = "SELECT * FROM `certificates` ORDER BY `certificate_id` DESC LIMIT 1";
    $certificate_result = mysqli_query($conn, $certificate_sql);
    while ($rowCertificate = mysqli_fetch_assoc($certificate_result)) {
        $certificate_id = $rowCertificate['certificate_id'];
    }
}
?>
<?php 
$showTest=0;
if(isset($_GET['string']) && $_GET['string']==$test_id.$user_id){
    $showTest=1;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Test</title>
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/quizFeature.css">
    <script src="certificategenerator/certificate-gen.js"></script>
    <link rel="stylesheet" href="../modules/fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <script>
        const showTest=<?php echo $showTest;?>;
        const startString = "<?php echo $startString; ?>";
        var alreadyAppeared = <?php echo $alreadyAppeared; ?>;
        const questionsforeach = <?php echo $questionsforeach; ?>;
        const testStart = <?php echo json_encode($startTime); ?>;
        const decodedArray = <?php echo json_encode($decodedArray); ?>;
        const test_id = <?php echo json_encode($test_id); ?>;
        const enrollment = <?php echo json_encode($enroll); ?>;
        const endTime = <?php echo json_encode($endTime); ?>;
        // console.log(questionsforeach);
        const questions = [];
        // console.log(showTest);
        function fetchQuestions(testId) {
            fetch(`getQuestions.php?testid=${testId}`)
                .then(response => response.json())
                .then(data => {
                    shuffleArray(data);

                    if (data.length <= questionsforeach) {
                        questions.push(...data);
                    } else {
                        questions.push(...data.slice(0, questionsforeach));
                    }
                    shuffleArray(questions);
                })
                .catch(error => {
                    console.error('Error fetching questions:', error);
                });
        }

        function shuffleArray(array) {
            for (let i = array.length - 1; i > 0; i--) {
                const j = Math.floor(Math.random() * (i + 1));
                [array[i], array[j]] = [array[j], array[i]];
            }
        }
        console.log(questions);
        const fname = "<?php echo $fname; ?>";
        const lname = "<?php echo $lname; ?>";
        const testId = <?php echo $test_id; ?>;
        const certificate_id = <?php echo $certificate_id; ?>;
        const user_id = <?php echo $user_id; ?>;
        fetchQuestions(testId);
    </script>
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
        </div>
    </nav>

    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="display:none;">
        <strong>Hey!!</strong> You have already attended the test.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <div class="string_box">
        <div class="end_info">Enter the code for the test:</div>
        <form action="stringStart.php" method="post">
            <div class="my-2">
                <input type="text" class="form-control" name="startString" required>
                <input type="hidden" name="test_id" value="<?php echo $test_id;?>">
            </div>
            <button class="btn btn-outline-success my-2 mx-0">Submit</button>
        </form>
    </div>
    <div class="end_box">
        <div class="end_info"><b>Quiz has ended!!</b></div>
        <div class="button">
            <button class="btn btn-outline-success" onclick="window.location.href=('test.php')">Go Back</button>
        </div>
    </div>
    <div class="time_box">
        <div class="time_info"></div>
        <div class="button">
            <button class="btn btn-outline-success" onclick="window.location.href=('test.php')">Go Back</button>
        </div>
    </div>
    <div class="container my-2 content">
        <div class="warning-box">
            <div class="warning_info">Please don't exit Full Screen Mode</div>
            <button class="btn btn-outline-primary my-2" id="warning_btn">Continue</button>
        </div>
        <div class="info_box" style="display:none;">
            <div class="info-title"><span>Some Rules of this Quiz</span></div>
            <div class="info-list">
                <div class="info">1. You will have only <span>
                        <?php echo $timeforeach; ?>
                    </span> seconds per each question.</div>
                <div class="info">2. Once you select your answer, it can't be undone.</div>
                <div class="info">3. You can't select any option once time goes off.</div>
                <div class="info">4. You can't exit from the Quiz while you're playing.</div>
                <div class="info">5. You'll get points on the basis of your correct answers.</div>
                <div class="info">6. You'll not be able to continue if you exit fullscreen mode.</div>
            </div>
            <div class="buttons">
                <button class="quit" onclick="window.location.href=(`../../index.php`)">Exit Quiz</button>
                <button class="restart">Continue</button>
            </div>
        </div>

        <div class="quiz_box">
            <header>
                <div class="title">
                    <?php echo $heading; ?>: Quiz
                </div>
                <div class="timer">
                    <div class="time_left_txt">Time Left</div>
                    <div class="timer_sec">
                        <?php echo $timeforeach; ?>
                    </div>
                </div>
                <div class="time_line"></div>
            </header>
            <section>
                <div class="que_text">
                </div>
                <div class="que_image">
                </div>
                <div class="option_list">
                </div>
            </section>
            <footer class="footer">
                <div class="total_que">
                </div>
                <div class="d-flex">
                    <button class="btn btn-outline-danger skip_btn" id="skipQuestion">Skip Question</button>
                    <button class="next_btn">Next Que</button>

                </div>
            </footer>
            <div class="skip-box container">
                <div class="skip-question">Do you really wanna skip this question?</div>
                <button class="btn btn-danger my-2" id="confirmSkip">Skip Question</button>
            </div>
        </div>
        <div class="result_box">
            <div class="icon">
                <i class="fas fa-crown"></i>
            </div>
            <div class="complete_text">You've completed the Quiz!</div>
            <div class="buttons">
                <button class="quit">Quit Quiz</button>
            </div>
        </div>

    </div>
    <script>
        if (alreadyAppeared == 1) {
            document.querySelector(".alert").style.display = "block";
            document.querySelector(".info_box .restart").disabled = true;
            document.querySelector(".info_box .restart").style.background = "red";
            document.querySelector(".info_box .restart").style.border = "red";
        }
    </script>
    <script>
        const timeforeach = <?php echo json_encode($timeforeach); ?>;
    </script>
    <script src="../javascript/test.js"></script>
    <script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../modules/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="../modules/@pdf-lib/fontkit/dist/fontkit.umd.min.js"></script>

    <!-- <script>
        const timeCount = document.querySelector(".timer .time_sec");
        const timeLine = document.querySelector(".time_line");
    </script> -->
</body>

</html>