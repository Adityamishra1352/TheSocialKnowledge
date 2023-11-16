<?php 
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $test_id=$_POST['test_id'];
    $numberofQuestions=$_POST['timefortest'];
    if($startTime!=null){
        $startTimeSql="UPDATE `codingtest` SET `heldfrom`='$startTime' WHERE `test_id`='$test_id'";
        $startTimeResult=mysqli_query($conn,$startTimeSql);
    }
    if($endTime!=null){
        $endTimeSql="UPDATE `codingtest` SET `heldtill`='$endTime' WHERE `test_id`='$test_id'";
        $endTimeResult=mysqli_query($conn,$endTimeSql);
    }
    if($numberofQuestions!=null){
        $questionsSql="UPDATE `codingtest` SET `timefortest`='$timefortest' WHERE `test_id`='$test_id'";
        $questionsResult=mysqli_query($conn,$questionsSql);
    }
    header('location:codingQuestion.php?test_id='.$test_id.'&timeUpdate=true');
    exit;
}
?>