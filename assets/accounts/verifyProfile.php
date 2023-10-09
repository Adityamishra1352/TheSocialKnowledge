<?php 
include '../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    echo $email;
    $verifyCode=$_POST['verifyCode'];
    $sql="SELECT * FROM `verification` WHERE `email`='$email'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    if($verifyCode==$row['token']){
        $user_sql="UPDATE `users` SET `verified` = '1' WHERE `users`.`email` = '$email'";
        $user_result=mysqli_query($conn, $user_sql);
        if($user_result){
            $token_delete="DELETE FROM `verification` WHERE `verification`.`email` = '$email'";
            $token_result=mysqli_query($conn,$token_delete);
            if($token_delete){
                header('location:dashboard.php?verify=true');
            }
        }
    }
    else{
        header('location:dashboard.php?wrongCode=true');
    }
}
?>