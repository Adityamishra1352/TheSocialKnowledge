<?php
session_start();
$user_id = $_SESSION['user_id'];
include '../../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $heading = $_POST['heading'];
    $description = $_POST['description'];
    $timefortest = $_POST['timefortest'];
    $heldfrom = $_POST['time'];
    $heldtill = $_POST['heldtill'];
    $sql = "INSERT INTO `codingTest` (`heading`, `description`, `timefortest`, `organiser_id`, `heldfrom`, `heldtill`) VALUES ('$heading', '$description', '$timefortest', '$user_id','$heldfrom','$heldtill')";
    $sql_result = mysqli_query($conn, $sql);
    $newSQL = "SELECT * FROM `codingTest` WHERE `heading`='$heading'";
    $newSQL_result = mysqli_query($conn, $newSQL);
    $newSQLRow = mysqli_fetch_assoc($newSQL_result);
    $test_id = $newSQLRow['test_id'];

    if($newSQL_result){
        header('location:codingQuestion.php?test_id=' . $test_id);
    }

}
?>