<?php
session_start(); 
include '../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $startString=$_POST['startString'];
    $test_id=$_POST['test_id'];
    $stringSQL="SELECT startString FROM `test` WHERE `test_id`='$test_id'";
    $stringRESULT=mysqli_query($conn,$stringSQL);
    $stringRow=mysqli_fetch_assoc($stringRESULT);
    if($startString==$stringRow['startString']){
        header('location:quizFeaturetry.php?testid='.$test_id.'&string='.$test_id.$_SESSION['user_id']);
    }
    else{
        header('location:quizFeaturetry.php?testid='.$test_id.'&string=false');
    }
}
?>