<?php
include '../_dbconnect.php';
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON);

if ($data && isset($data->userScore)) {
    $userScore = $data->userScore;
    $user_id = $data->user_id;
    $test_id = $data->test_id;
    $enrollment = $data->enrollment;
    $errors = $data->errors;
    if (isset($data->answers)) {
        $answers = $data->answers;
        $answersJSON = json_encode($answers);
    } else {
        $answersJSON = "[]";
    }
    
    $sql = "INSERT INTO `testscores`(`score`, `test_id`, `user_id`, `enrollment`, `errors`, `answers`) 
            VALUES ('$userScore', '$test_id', '$user_id', '$enrollment', '$errors', '$answersJSON')";
    $result = mysqli_query($conn, $sql);
    
    if ($result) {
        echo json_encode(["message" => "Score and answers stored successfully"]);
    } else {
        echo json_encode(["error" => "Score and answers were not stored"]);
    }
} else {
    echo json_encode(["error" => "Invalid data"]);
}
?>
