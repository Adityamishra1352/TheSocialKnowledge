<?php 
include '../_dbconnect.php';
session_start();
$user_id=$_SESSION['user_id'];
if($_SERVER['REQUEST_METHOD']=="POST"){
    $npassword=$_POST['npassword'];
    $cpassword=$_POST['cpassword'];
    if($npassword==$cpassword){
        $hash=password_hash($npassword,PASSWORD_DEFAULT);
        $sql="UPDATE`users` SET `password`='$hash' WHERE `user_id`='$user_id'";
        $result=mysqli_query($conn,$sql);
        if($result){
            header('location:dashboard.php?password=true');
            exit();
        }
    }
    else{
        header('location:dashboard.php?passwordmatch=true');
    }
}
?>