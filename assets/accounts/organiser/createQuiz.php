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
    $sql="INSERT INTO `test` (`heading`, `description`, `time`, `organiser_id`, `timeforeach`, `questionsforeach`) VALUES ('$heading', '$description', '$time', '$user_id','$timeforeach','$questionsforeach')";
    $sql_result=mysqli_query($conn, $sql);
    if($sql_result){
        header('location:organiser.php');
    }
}
?>