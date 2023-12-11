<?php
session_start();
$user_id=$_SESSION['user_id'];
include '../../_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $time=$_POST['time'];
    $timeforeach=$_POST['timeforeach'];
    $questionsforeach=$_POST['questionsforeach'];
    $heldtill=$_POST['heldtill'];
    $sql="INSERT INTO `test` (`heading`, `description`, `time`, `organiser_id`, `timeforeach`, `questionsforeach`,`heldtill`) VALUES ('$heading', '$description', '$time', '$user_id','$timeforeach','$questionsforeach','$heldtill')";
    $sql_result=mysqli_query($conn, $sql);
    if($sql_result){
        $quiz_sql="SELECT * FROM `test` WHERE `heading`='$heading' AND `organiser_id`='$user_id'";
        $quiz_result=mysqli_query($conn,$quiz_sql);
        $quizRow=mysqli_fetch_assoc($quiz_result);
        $testQuiz_id=$quizRow['test_id'];

        header('location:addQuestions.php?test_id='.$testQuiz_id);
    }
}
?>