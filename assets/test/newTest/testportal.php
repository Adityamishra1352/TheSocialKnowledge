<!DOCTYPE html>
<html lang="en">

<?php
include '../../_dbconnect.php';
if (isset($_GET['test_id'])) {
    $test_id = $_GET['test_id'];
}
$testsql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
$testresult = mysqli_query($conn, $testsql);
$testRow = mysqli_fetch_assoc($testresult);
// echo var_dump($testRow);
$heading = $testRow['heading'];
$timeforeach = $testRow['timeforeach'];
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Tests</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script>

    </script>
    <style>
        .center-buttons {
            display: flex;
            justify-content: center;
        }

        #question-container {
            margin-bottom: 20px;
            font-size: 23px;
            font-weight: 500;
        }

        #options-container {
            padding: 20px 0px;
            display: block;
        }

        .option {
            border: 1px solid black;
            border-radius: 5px;
            padding: 8px 15px;
            font-size: 17px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: flex-start;
        }

        .nextprevious {
            display: flex;
            justify-content: flex-end;
        }

        .testType span {
            margin-left: 15px;
            font-size: 23px;
            font-weight: 500;
        }
        .timer{
            background-color:lightgray;
            border-radius:10px;
            margin-right: 10px; 
            margin-left: auto;
        }
        .footer{
            width:100%;
            position:fixed;
            bottom:0;
            display:flex;
            justify-content:flex-end;
            padding:10px;
        }
    </style>
</head>

<body>
    <nav class="navbar bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../index.php">
                <img src="../../images/websitelogo.jpg" alt="Logo" width="30" height="30"
                    class="d-inline-block align-text-top">
                The Social Knowledge
            </a>
            <div class="p-2 border timer">
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
    <div class="footer bg-primary">
        <button id="submitTest" class="btn btn-secondary">Submit Test</button>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        const totalTimeElement = document.getElementById('total-time');
        let totalSecondsLeft;

        function updateTimer() {
            const minutes = Math.floor(totalSecondsLeft / 60);
            const seconds = totalSecondsLeft % 60;
            totalTimeElement.textContent = `${minutes}m ${seconds}s`;

            if (totalSecondsLeft > 0) {
                totalSecondsLeft--;
            } else {
                totalTimeElement.textContent = "Time's up!";
                clearInterval(timerInterval);
            }
        }

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
        function displayQuestion(index) {
            const questionContainer = document.getElementById('question-container');
            const currentQuestion = questions[index];

            if (currentQuestion) {
                questionContainer.innerHTML = '';
                const questionText = document.createElement('p');
                questionText.textContent = currentQuestion.question_text;
                questionContainer.appendChild(questionText);
                if (currentQuestion.image != null) {
                    const questionImage = document.createElement('img');
                    questionImage.setAttribute("src", "../../images/questions/" + currentQuestion.image);
                    questionContainer.appendChild(questionImage);
                }
                displayOptions();
            }
            else {
                console.log("All questions have been answered");
            }
        }


        function displayOptions() {
            const optionsContainer = document.getElementById('options-container');
            const currentQuestion = questions[currentQuestionIndex];

            if (currentQuestion) {
                optionsContainer.innerHTML = '';
                currentQuestion.options.forEach((option, optionIndex) => {
                    if (currentQuestion.ismultiplechoice == 0) {
                        const optionDiv = document.createElement('div');
                        optionDiv.setAttribute("class", "option");
                        const optionRadio = document.createElement('input');
                        optionRadio.setAttribute("type", "radio");
                        optionRadio.setAttribute("class", "form-check-input");
                        optionRadio.setAttribute("style", "margin-right:10px");
                        optionRadio.setAttribute("name", "options");
                        const optionText = document.createElement("span");
                        optionText.textContent = option;
                        optionDiv.appendChild(optionRadio);
                        optionDiv.appendChild(optionText);
                        optionDiv.addEventListener('click', () => {
                            console.log(`User selected option ${optionIndex + 1}`);
                        });
                        optionsContainer.appendChild(optionDiv);
                    } else {
                        const optionDiv = document.createElement('div');
                        optionDiv.setAttribute("class", "option");
                        const optionRadio = document.createElement('input');
                        optionRadio.setAttribute("type", "checkbox");
                        optionRadio.setAttribute("class", "form-check-input");
                        optionRadio.setAttribute("name", "options");
                        optionRadio.setAttribute("style", "margin-right:10px");
                        const optionText = document.createElement("span");
                        optionText.textContent = option;
                        optionDiv.appendChild(optionRadio);
                        optionDiv.appendChild(optionText);
                        optionDiv.addEventListener('click', () => {
                            console.log(`User selected option ${optionIndex + 1}`);
                        });
                        optionsContainer.appendChild(optionDiv);
                    }
                });
            }
        }
        function displayNavigationButtons() {
            const navigationContainer = document.getElementById('navigation-container');
            navigationContainer.innerHTML = ''; // Clear existing buttons

            questions.forEach((question, index) => {
                const button = document.createElement('button');
                button.setAttribute("class", "btn btn-outline-secondary m-1");
                button.textContent = `${index + 1}`;
                button.addEventListener('click', () => {
                    currentQuestionIndex = index;
                    displayQuestion(currentQuestionIndex);
                    highlightSelectedButton();
                });
                navigationContainer.appendChild(button);
            });
            highlightSelectedButton();
            navigationContainer.classList.add('center-buttons');
        }
        function highlightSelectedButton() {
            const buttons = document.querySelectorAll('#navigation-container button');
            buttons.forEach(button => {
                button.classList.remove('active');
            });
            buttons[currentQuestionIndex].classList.add('active');
        }
        document.getElementById('previousQuestion').addEventListener('click', () => {
            if (currentQuestionIndex > 0) {
                currentQuestionIndex--;
                displayQuestion(currentQuestionIndex);
                highlightSelectedButton();
            }
        });

        document.getElementById('nextQuestion').addEventListener('click', () => {
            if (currentQuestionIndex < questions.length - 1) {
                currentQuestionIndex++;
                displayQuestion(currentQuestionIndex);
                highlightSelectedButton();
            }
        });
        fetchQuestions(testId);
    </script>
</body>

</html>