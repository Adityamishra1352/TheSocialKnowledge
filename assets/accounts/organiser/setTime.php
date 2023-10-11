<?php 
include '../../_dbconnect.php';
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $startTime=$_POST['startTime'];
    $endTime=$_POST['endTime'];
    $test_id=$_POST['test_id'];
    $sql="UPDATE `test` SET `time`='$startTime',`heldtill`='$endTime' WHERE `test_id`='$test_id'";
    $result=mysqli_query($conn,$sql);
    if($result){
        header('location:addQuestions.php?testid='.$test_id.'&timeUpdate=true');
    }
}
?>