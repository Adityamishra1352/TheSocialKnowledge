<?php
session_start();
include '../../_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $questions = [];
    $test_id = $_POST['test_id'];
    function generateOptionsArray($options) {
        $result = [];
        for ($i = 1; $i <= 4; $i++) {
            $result[] = $options[$i] ?? null;
        }
        return $result;
    }

    foreach ($_POST as $key => $value) {
        if (strpos($key, "question-") === 0) {
            $questionText = $value;
            $questionText = str_replace("   ", "<br>", $questionText);
            $questionObj = [
                'question' => $questionText,
                'options' => [],
                'answer' => null,
            ];
            $questions[] = $questionObj;
        } elseif (strpos($key, "option-") === 0) {
            list(, $questionNum, $optionNum) = explode("-", $key);
            $questionIndex = $questionNum - 1;
            if ($optionNum > 4) {
                continue;
            }
            if (!empty($value)) {
                $questions[$questionIndex]['options'][$optionNum] = $value;
            }
        } elseif (strpos($key, "answer-") === 0) {
            $questionIndex = count($questions) - 1;
            $questions[$questionIndex]['answer'] = $value;
        }
    }

    foreach ($questions as $questionData) {
        $questionText = $questionData['question'];
        $options = generateOptionsArray($questionData['options']);
        $answer = $questionData['answer'];
        $optionsJSON = json_encode($options);

        $sql = "INSERT INTO `questions` (`question`, `options`, `answer`, `test_id`) VALUES ('$questionText', '$optionsJSON', '$answer', '$test_id')";
        $result = mysqli_query($conn, $sql);

        if (!$result) {
            echo mysqli_error($conn);
            exit;
        }
    }
    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
        header('location:editCourse.php?course_id=' . $_GET['course_id'] . '&deleteContent=true');
    }
    if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
        header('location:addQuestions.php?test_id=' . $test_id . '&uploadQuestions=true');
    }
}
?>
