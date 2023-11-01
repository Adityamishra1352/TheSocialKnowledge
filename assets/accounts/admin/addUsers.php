<?php
session_start();
include '../../_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_FILES['csv_file']['error'] == 0) {
        $file = $_FILES['csv_file']['tmp_name'];
        $optionsDelimiter = ',';

        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, $optionsDelimiter)) !== FALSE) {
                $email = $data[0];
                $enrollment = $data[1];
                $batch=$data[2];
                $year=$data[3];
                echo $enrollment;
                $sql = "INSERT INTO adminusers (`email`, `enrollment`, `batch`, `year`) VALUES (?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("ssss", $email, $enrollment, $batch, $year);
                if ($stmt->execute()) {
                    echo "done";
                } else {
                    echo "Error: " . $stmt->error;
                }
            }
            if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                header('location:admin.php?uploadUsers=true');
            }
            fclose($handle);
        }
    } else {
        header('location:addQuestions.php?test_id=' . $test_id);
    }
}
?>
