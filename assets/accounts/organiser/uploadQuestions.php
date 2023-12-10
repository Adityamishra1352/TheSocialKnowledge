<?php
session_start();
include '../../_dbconnect.php';
$imageDirectory = '../../images/questions/';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['test_id']) && isset($_POST['questions'])) {
        $test_id = $_POST['test_id'];
        $questions = $_POST['questions'];
        $questionImages = $_FILES['question-images'];

        function addLineBreaks($text)
        {
            return preg_replace('/ {3}/', '<br>', $text);
        }

        if (isset($_POST['answer_type']) && $_POST['answer_type'] == 'singleAnswer') {
            for ($i = 0; $i < count($questions); $i++) {
                $questionText = addLineBreaks($questions[$i]);
                $questionImage = $questionImages['tmp_name'][$i];
                if (!empty($questionImage)) {
                    $imageFileName = $_FILES['question-images']['name'][$i];
                    move_uploaded_file($questionImage, $imageDirectory . $imageFileName);
                } else {
                    $imageFileName = null;
                }
                if (!empty($questionText)) {
                    $questionScript = $questionText;
                } else {
                    $questionScript = null;
                }
                $selectedAnswer = $_POST['correct-answer-' . $i];
                if (preg_match('/options_(\d+)\[(\d+)\]/', $selectedAnswer, $matches)) {
                    $questionIndex = $matches[1];
                    $optionIndex = $matches[2];
                    $selectedAnswerValue = $_POST['options_' . $questionIndex][$optionIndex];
                }
                $options = json_encode($_POST['options_' . $i]);
                echo $selectedAnswerValue;
                echo var_dump($options);
            }
            $sql = "INSERT INTO questions (question, image, options, answer, test_id) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssssi", $questionScript, $imageFileName, $options, $selectedAnswerValue, $test_id);
            if ($stmt->execute()) {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                    // header('location:editCourse.php?course_id=' . $_GET['course_id'] . '&uploadContent=true');
                }
                if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                    // header('location:addQuestions.php?test_id=' . $test_id . '&uploadQuestions=true');
                }
            } else {
                echo "Error: " . $stmt->error;
            }
        }
        if (isset($_POST['answer_type']) && $_POST['answer_type'] == 'multipleAnswer') {
            for ($i = 0; $i < count($questions); $i++) {
                $questionText = addLineBreaks($questions[$i]);
                $questionImage = $questionImages['tmp_name'][$i];
                if (!empty($questionImage)) {
                    $imageFileName = $_FILES['question-images']['name'][$i];
                    move_uploaded_file($questionImage, $imageDirectory . $imageFileName);
                } else {
                    $imageFileName = null;
                }
                if (!empty($questionText)) {
                    $questionScript = $questionText;
                } else {
                    $questionScript = null;
                }

                $selectedAnswers = $_POST['correct-answer-' . $i];
                echo var_dump($selectedAnswers);
                $selectedAnswerValues = array();

                if (is_array($selectedAnswers)) {
                    foreach ($selectedAnswers as $selectedAnswer) {
                        if (preg_match('/options_(\d+)\[(\d+)\]/', $selectedAnswer, $matches)) {
                            $questionIndex = $matches[1];
                            $optionIndex = $matches[2];
                            $selectedAnswerValues[] = $_POST['options_' . $questionIndex][$optionIndex];
                        }
                    }
                }

                $options = json_encode($_POST['options_' . $i]);
                echo var_dump($selectedAnswerValues);
                echo var_dump($options);
                $one=1;
                $sql = "INSERT INTO questions (question, image, options, answer, test_id,ismultiplechoice) VALUES (?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $options = json_encode($_POST['options_' . $i]);
                $selectedAnswerValues = json_encode($selectedAnswerValues);
                $stmt->bind_param("ssssii", $questionScript, $imageFileName, $options, $selectedAnswerValues, $test_id, $one);

                if ($stmt->execute()) {
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                        header('location:editCourse.php?course_id=' . $_GET['course_id'] . '&uploadContent=true');
                    }
                    if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                        header('location:addQuestions.php?test_id=' . $test_id . '&uploadQuestions=true');
                    }
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
        }
    }
}
?>