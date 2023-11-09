<?php
include '../../_dbconnect.php';

if (isset($_POST['deleteSelected'])) {
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        $questionsToDelete = $_POST['delete'];
        $questionsToDeleteString = implode(',', $questionsToDelete);
        $sql = "DELETE FROM `codingquestions` WHERE `code_id` IN ($questionsToDeleteString)";
        
        $result = mysqli_query($conn, $sql);
        
        if ($result) {
            $test_id = $_GET['test_id'];
            header('location:codingQuestion.php?test_id=' . $test_id . '&deleteQuestion=true');
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>