<?php
session_start();
include '../../_dbconnect.php';
// echo "hii";
$imageDirectory = '../../images/questions/';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['test_id']) && isset($_POST['questions'])) {
        $test_id = $_POST['test_id'];
        $questions = $_POST['questions'];
        $answers = $_POST['answers'];
        for ($i = 0; $i < count($questions); $i++) {
            $sql = "INSERT INTO questions (question, options, answer, test_id) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $options = json_encode($_POST['options_' . $i]);
            $stmt->bind_param("ssssi", $questionScript, $imageFileName, $options, $selectedAnswerValue, $test_id);
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

        $stmt->close();
    } else {
        // Handle form data not set error
    }
}
?>

