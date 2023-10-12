<?php
session_start();
$test_id=0;
$user_id=$_SESSION['user_id'];
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../403.php');
} else {
    include '../_dbconnect.php';
    $test_id = $_GET['testid'];
    $quiz_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
    $quiz_result = mysqli_query($conn, $quiz_sql);
    $heading = null;
    $timeforeach=null;
    $questionsforeach=null;
    $startTime=null;
    while ($quizRow = mysqli_fetch_assoc($quiz_result)) {
        $heading = $quizRow['heading'];
        $timeforeach=$quizRow['timeforeach'];
        $questionsforeach=$quizRow['questionsforeach'];
        $startTime=$quizRow['time'];
    }
    $fname = null;
    $lname = null;
    $enroll= null;
    $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $user_result = mysqli_query($conn, $user_sql);
    $test_array = 0;
    while ($rowUser = mysqli_fetch_assoc($user_result)) {
        $fname = $rowUser['fname'];
        $lname = $rowUser['lname'];
        $test_array = $rowUser['test_array'];
        $enroll=$rowUser['enrollment'];
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
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Test</title>
        <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/quizFeature.css">
    <script src="certificategenerator/certificate-gen.js"></script>
    <link rel="stylesheet" href="../fontawesome-free-5.15.4-web/css/all.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <script>
    let alreadyAppeared = <?php echo $alreadyAppeared; ?>;
    const questionsforeach = <?php echo $questionsforeach; ?>;
    const testStart=<?php echo json_encode($startTime);?>;
    const decodedArray=<?php echo json_encode($decodedArray);?>;
    const test_id=<?php echo json_encode($test_id);?>;
    const enrollment=<?php echo json_encode($enroll);?>;
    console.log(questionsforeach);
    const questions = [];

    function fetchQuestions(testId) {
        fetch(`getQuestions.php?testid=${testId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length < questionsforeach) {
                    questions.push(...data);
                } else {
                    const randomIndices = [];
                    while (randomIndices.length < questionsforeach) {
                        const randomIndex = Math.floor(Math.random() * data.length);
                        if (!randomIndices.includes(randomIndex)) {
                            randomIndices.push(randomIndex);
                        }
                    }
                    randomIndices.forEach(index => {
                        const questionData = data[index];
                        const options = questionData.options;
                        shuffleArray(options);
                        const newQuestion = {
                            numb: questions.length + 1,
                            question: questionData.question_text,
                            answer: questionData.correct_answer,
                            options: options
                        };
                        questions.push(newQuestion);
                    });
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
        <div class="info_box">
            <div class="info-title"><span>Some Rules of this Quiz</span></div>
            <div class="info-list">
                <div class="info">1. You will have only <span><?php echo $timeforeach;?></span> seconds per each question.</div>
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
                    <div class="timer_sec"><?php echo $timeforeach;?></div>
                </div>
                <div class="time_line"></div>
            </header>
            <section>
                <div class="que_text">
                </div>
                <div class="option_list">
                </div>
            </section>
            <footer>
                <div class="total_que">
                </div>
                <button class="next_btn bd-outline-success">Next Que</button>
            </footer>
        </div>
        <div class="result_box">
            <div class="icon">
                <i class="fas fa-crown"></i>
            </div>
            <div class="complete_text">You've completed the Quiz!</div>
            <div class="score_text">
            </div>
            <div class="buttons">
                <button class="viewAnswers">View Answers</button>
                <button class="quit">Quit Quiz</button>
            </div>
            <button class="btn btn-outline-success getCertificate">Get Certificate</button>
        </div>
        <div class="answers_box">
            <section>
                <div class="currentQuestion">
                </div>
                <div class="answerMessage">
                </div>
            </section>
            <div class="buttons">
                <button class="nextAnswer">Next Answer</button>
            </div>
        </div>
        <div class="certificate_box">
            <div class="certificate_text">
                <!-- <label for="name"><b>Type Your Name</b></label> -->
                <!-- <input type="text" name="Name" id="name" placeholder="Enter your name" required> -->
                <div class="buttons container my-2">
                    <button class="certification btn btn-outline-success">Get Certificate</button>
                    <button id="gobacktoresult" class="btn btn-outline-success">Go Back to the Reusult Page</button>
                    <button onclick="window.location.href='../../index.php'"
                        class="btn btn-outline-success">Home</button>
                </div>
                <iframe src="" id="certificatepdf" frameborder="0" style="width: 400px;height:400px;"></iframe>
            </div>
        </div>
    </div>
    <script>
        if (alreadyAppeared == 1) {
            document.querySelector(".alert").style.display="block";
            document.querySelector(".info_box .restart").disabled=true;
            document.querySelector(".info_box .restart").style.background="red";
            document.querySelector(".info_box .restart").style.border="red";
        }
    </script>
    <script>
        const timeforeach=<?php echo json_encode($timeforeach);?>;
    </script>
    <script src="../javascript/test.js"></script>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="../@pdf-lib/fontkit/dist/fontkit.umd.min.js"></script>

    <!-- <script>
        const timeCount = document.querySelector(".timer .time_sec");
        const timeLine = document.querySelector(".time_line");
    </script> -->
</body>

</html>