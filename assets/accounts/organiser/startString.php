<?php 
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $startString=$_POST['startString'];
    $test_id=$_POST['test_id'];
    $sql="UPDATE `test` SET `startString`='$startString' WHERE `test_id`='$test_id'";
    $result=mysqli_query($conn, $sql);
    if($result){
        header('location:addQuestions.php?test_id='.$test_id.'&startString=true');
    }
}
?>