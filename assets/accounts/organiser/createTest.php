<?php
session_start();
$user_id=$_SESSION['user_id'];
include '../../_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $heading=$_POST['heading'];
    $description=$_POST['description'];
    $timefortest=$_POST['timefortest'];
    $heldfrom=$_POST['time'];
    $heldtill=$_POST['heldtill'];
    $sql="INSERT INTO `testBlock` (`heading`, `description`, `timefortest`, `organiser_id`, `heldfrom`, `heldtill`) VALUES ('$heading', '$description', '$timefortest', '$user_id','$heldfrom','$heldtill')";
    $sql_result=mysqli_query($conn, $sql);
    if($sql_result){
        header('location:organiser.php?addTest=true');
    }
}
?>