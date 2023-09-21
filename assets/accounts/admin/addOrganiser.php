<?php
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    $addOrganiser="UPDATE `users` SET `organiser` = '1' WHERE `email` = '$email'";
    $addOrganiser_result=mysqli_query($conn,$addOrganiser);
    if($addOrganiser_result){
        header('location:admin.php');
    }
}
?>