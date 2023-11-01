<?php 
include '../../_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $test_id=$_POST['test_id'];
    $numberofQuestions=$_POST['numberofQuestions'];
    $timeforeach=$_POST['timeforeach'];
    if($startTime!=null){
        $startTimeSql="UPDATE `test` SET `time`='$startTime' WHERE `test_id`='$test_id'";
        $startTimeResult=mysqli_query($conn,$startTimeSql);
    }
    if($endTime!=null){
        $endTimeSql="UPDATE `test` SET `heldtill`='$endTime' WHERE `test_id`='$test_id'";
        $endTimeResult=mysqli_query($conn,$endTimeSql);
    }
    if($numberofQuestions!=null){
        $questionsSql="UPDATE `test` SET `questionsforeach`='$numberofQuestions' WHERE `test_id`='$test_id'";
        $questionsResult=mysqli_query($conn,$questionsSql);
    }
    if($timeforeach!=null){
        $timeEachSql="UPDATE `test` SET `timeforeach`='$timeforeach' WHERE `test_id`='$test_id'";
        $timeEachResult=mysqli_query($conn,$timeEachSql);
    }
    header('location:addQuestions.php?test_id='.$test_id.'&timeUpdate=true');
    exit;
}
?>