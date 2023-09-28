<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../403.php');
}
include '../_dbconnect.php';
$test_id = $_GET['testid'];
$quiz_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
$quiz_result = mysqli_query($conn, $quiz_sql);
$heading = null;
while ($quizRow = mysqli_fetch_assoc($quiz_result)) {
    $heading = $quizRow['heading'];
}
$fname = null;
$lname = null;
$user_id = $_SESSION['user_id'];
$user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
$user_result = mysqli_query($conn, $user_sql);
while ($rowUser = mysqli_fetch_assoc($user_result)) {
    $fname = $rowUser['fname'];
    $lname = $rowUser['lname'];
}
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/quizFeature.css">
    <script src="certificategenerator/certificate-gen.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <script>
        const questions = [];
        function fetchQuestions(testId) {
            fetch(`getQuestions.php?testid=${testId}`)
                .then(response => response.json())
                .then(data => {
                    for (let i = 0; i < data.length; i++) {
                        const question = data[i];
                        const newQuestion = {
                            numb: i + 1,
                            question: question.question_text,
                            answer: question.correct_answer,
                            options: question.options
                        };
                        // console.log(`Question ${i + 1}: ${newQuestion.question}`);
                        // console.log(`Options: ${newQuestion.options.join(', ')}`);
                        // console.log(`Correct Answer: ${newQuestion.answer}`);
                        questions.push(newQuestion);
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
        const testId = <?php echo $test_id ?>;
        fetchQuestions(testId);

    </script>
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
    <div class="container my-2 content">
        <div class="info_box">
            <div class="info-title"><span>Some Rules of this Quiz</span></div>
            <div class="info-list">
                <div class="info">1. You will have only <span>15 seconds</span> per each question.</div>
                <div class="info">2. Once you select your answer, it can't be undone.</div>
                <div class="info">3. You can't select any option once time goes off.</div>
                <div class="info">4. You can't exit from the Quiz while you're playing.</div>
                <div class="info">5. You'll get points on the basis of your correct answers.</div>
            </div>
            <div class="buttons">
                <button class="quit">Exit Quiz</button>
                <button class="restart">Continue</button>
            </div>
        </div>

        <div class="quiz_box">
            <header>
                <div class="title">
                    <?php echo $heading; ?>
                </div>
                <div class="timer">
                    <div class="time_left_txt">Time Left</div>
                    <div class="timer_sec">15</div>
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
                    <label>Tap on the button to get your certificate:</label> <br>
                    <button class="certification btn btn-outline-success">Get Certificate</button>
                    <button id="gobacktoresult" class="btn btn-outline-success">Go Back to the Reusult Page</button>
                    <button onclick="window.location.href='../../index.php'" class="btn btn-outline-success">Home</button>
                </div>
                <iframe src="" id="certificatepdf" frameborder="0" style="width: 400px;height:400px;"></iframe>
            </div>
        </div>
    </div>
    <script src="../javascript/test.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
        crossorigin="anonymous"></script>
    <script src="https://unpkg.com/pdf-lib/dist/pdf-lib.min.js"></script>
    <script src="https://unpkg.com/@pdf-lib/fontkit@0.0.4"></script>
    <!-- <script>
        const timeCount = document.querySelector(".timer .time_sec");
        const timeLine = document.querySelector(".time_line");
    </script> -->
</body>

</html>