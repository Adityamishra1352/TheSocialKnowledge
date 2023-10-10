<?php
session_start();
include '../../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $questions = [];
    $test_id = $_POST['test_id'];
    foreach ($_POST as $key => $value) {
        if (strpos($key, "question-") === 0) {
            $questionText = $value;
            $questionObj = [];
            $questionObj['question'] = $questionText;
            $questions[] = $questionObj;
        }
        if (strpos($key, "option-") === 0) {
            list(, $questionNum, $optionNum) = explode("-", $key);
            $questionIndex = $questionNum - 1;
            $options = $questions[$questionIndex]['options'] ?? [];
            if (!isset($options[$optionNum])) {
                $options[$optionNum] = $value;
            }
            $questions[$questionIndex]['options'] = $options;
        }
        if (strpos($key, "answer-") === 0) {
            $answer = $value;
            $lastQuestionIndex = count($questions) - 1;
            if ($lastQuestionIndex >= 0) {
                $questions[$lastQuestionIndex]['answer'] = $answer;
            }
        }
    }
    foreach ($questions as $questionData) {

        $questionText = $questionData['question'];
        $options = [
            $questionData['options'][1] ?? null,
            $questionData['options'][2] ?? null,
            $questionData['options'][3] ?? null,
            $questionData['options'][4] ?? null
        ];
        $answer = $questionData['answer'];

        $optionsJSON = json_encode($options);

        $sql = "INSERT INTO `questions` (`question`, `options`, `answer`, `test_id`) VALUES ('$questionText', '$optionsJSON', '$answer', '$test_id')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                header('location:editCourse.php?course_id=' . $_GET['course_id'] . '&deleteContent=true');
            }
            if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                header('location:addQuestions.php?test_id='.$test_id.'&uploadQuestions=true');
            }
        } else {
            echo mysqli_connect_error();
        }
    }
}
?>
