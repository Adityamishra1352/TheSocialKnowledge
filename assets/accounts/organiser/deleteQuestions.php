<?php 
include '../../_dbconnect.php';
if(isset($_GET['question_id'])){
    $sno=$_GET['question_id'];
    $test_id=$_GET['test_id'];
    $sql="DELETE FROM `questions` WHERE `question_id`='$sno'";
    $result=mysqli_query($conn,$sql);
    if($result){
      header('location:addQuestions.php?testid='.$test_id.'');
    }
  }
?>