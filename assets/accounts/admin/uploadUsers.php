<?php
include '../../_dbconnect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $questions = $_POST['questions'];

    for ($i = 0; $i < count($questions); $i++) {
        $email = $questions[$i];
        $batch = $_POST['batch-' . $i];
        $year = $_POST['year-' . $i];
        $enrollment = $_POST['enroll-' . $i];
        echo $email;
        echo $batch;
        echo $enrollment;
        echo $year;
        $sql = "INSERT INTO adminusers (email, enrollment, batch, year)
                VALUES ('$email', '$enrollment', '$batch', '$year')";

        if ($conn->query($sql) !== TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }

    $conn->close();
    $response = ['status' => 'success', 'message' => 'Data uploaded successfully'];
    echo json_encode($response);
} else {
    echo "Invalid request method";
}
?>