<?php
session_start();
include '../_dbconnect.php'; 
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    $sql="SELECT * FROM `forgotpass` WHERE `email`='$email'";
    $result=mysqli_query($conn,$sql);
    $row=mysqli_fetch_assoc($result);
    echo var_dump($row);
    echo $email;
    echo $_POST['code'];
    echo $row['token'];
    if($_POST['code']==$row['token']){
        $delete_sql="DELETE FROM `forgotpass` WHERE `forgotpass`.`email` = '$email'";
        $delete_result=mysqli_query($conn,$delete_sql);
        $user_sql="SELECT * FROM `users` WHERE `email`='$email'";
        $user_result=mysqli_query($conn,$user_sql);
        $rowUser=mysqli_fetch_assoc($user_result);
        $user_id=$rowUser['user_id'];
        if ($rowUser['admin'] == 1) {
            $_SESSION['admin'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['loggedin'] = true;
            header('location:dashboard.php?forgotpass=true');
            exit();
        } elseif ($rowUser['organiser'] == 1) {
            $_SESSION['organiser'] = true;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['loggedin'] = true;
            header('location:dashboard.php?forgotpass=true');
            exit();
        } else {
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user_id;
            header("location:dashboard.php?forgotpass=true");
            exit();
        }
    }
}
?>