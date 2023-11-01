<?php
session_start();
include '../../_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['test_id'])) {
    $test_id = $_POST['test_id'];

    if ($_FILES['csv_file']['error'] == 0) {
        $file = $_FILES['csv_file']['tmp_name'];
        $optionsDelimiter = ',';

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $optionsDelimiter)) !== FALSE) {
                $question = $data[0];
                $answer = $data[1];
                $options = array_slice($data, 2);
                // foreach ($options as &$option) {
                //     $option = '"' . $option . '"';
                // }
                $question = str_replace('   ', '<br>', $question);
                $sql = "INSERT INTO questions (question, options, answer, test_id) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $optionsJSON = json_encode($options);
                $stmt->bind_param("sssi", $question, $optionsJSON, $answer, $test_id);
                if ($stmt->execute()) {
                    echo "done";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                header('location:editCourse.php?course_id=' . $_GET['course_id'] . '&uploadContent=true');
            }
            if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                header('location:addQuestions.php?test_id=' . $test_id . '&uploadQuestions=true');
            }
            fclose($handle);
        }
    } else {
        header('location:addQuestions.php?test_id=' . $test_id);
    }
}
?>
