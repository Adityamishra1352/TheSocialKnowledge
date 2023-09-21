<?php 
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=='GET'){
    $orgainser_id=$_GET['orgainser_id'];
    $delete_sql="UPDATE `users` SET `organiser` = '0' WHERE `user_id` = '$orgainser_id'";
    $delteResult=mysqli_query($conn,$delete_sql);
    if($delteResult){
        header('location:admin.php');
    }
}
?>