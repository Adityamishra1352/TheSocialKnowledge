<?php
session_start();
include '../../_dbconnect.php';
$organiser_id=$_SESSION['user_id'];
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['test_id']) && isset($_POST['questions'])) {
        $test_id = $_POST['test_id'];
        $questions = $_POST['questions'];

        for ($i = 0; $i < count($questions); $i++) {
            $questionText = $questions[$i];
            if (isset($_POST['input_' . $i]) && is_array($_POST['input_' . $i]) && isset($_POST['expected_output_' . $i]) && is_array($_POST['expected_output_' . $i])) {
                $inputs = $_POST['input_' . $i];
                $expectedOutputs = $_POST['expected_output_' . $i];
                $inputExpectedPairs = [];
                for ($j = 0; $j < count($inputs); $j++) {
                    $input = $inputs[$j];
                    $expectedOutput = $expectedOutputs[$j];
                    $inputExpectedPairs[] = [
                        'input' => $input,
                        'expected_output' => $expectedOutput
                    ];
                }
                $inputExpectedPairsJSON = json_encode($inputExpectedPairs);
            } else {
                $inputExpectedPairsJSON = null;
            }
            echo $questionText;
            echo $inputExpectedPairsJSON;
            $sql = "INSERT INTO codingQuestions (question, inputOutput, test_id,organiser_id) VALUES (?, ?, ?,?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssii", $questionText, $inputExpectedPairsJSON, $test_id, $organiser_id);

            if ($stmt->execute()) {
                if (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                    header('location:codingQuestion.php?test_id=' . $test_id . '&uploadQuestions=true');
                }
            } else {
                echo "Error: " . $stmt->error;
            }
        }
    }
}
?>
