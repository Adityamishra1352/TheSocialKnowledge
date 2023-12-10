<?php
session_start();
include '../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['emailAddress'];
    $password = $_POST['passWord'];
    $enroll = $_POST['enrollment'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location:signup.php?wrongEmail=true');
    } elseif (strlen($password) < 8) {
        header('location:signup.php?passwordLess=true');
    } elseif (strlen($enroll) > 8) {
        header('location:signup.php?enroll=true');
    } else {
        $fetch_email = "SELECT * FROM `users` WHERE `email`='$email'";
        $fetch_result = mysqli_query($conn, $fetch_email);
        $num = mysqli_num_rows($fetch_result);
        if ($num >= 1) {
            header('location:signup.php?emailExists=true');
        } else {
            $adminAllowed = "SELECT email FROM adminusers WHERE `email`='$email'";
            $adminAllowed_result = mysqli_query($conn, $adminAllowed);
            $adminNum = mysqli_num_rows($adminAllowed_result);
            if ($adminNum<1) {
                header('location:signup.php?notAllowed=true');
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $signup_sql = "INSERT INTO `users` ( `fname`, `lname`, `email`, `password`,`enrollment`) VALUES ('$fname', '$lname', '$email', '$hash','$enroll');";
                $result_signup = mysqli_query($conn, $signup_sql);
                if ($result_signup) {
                    $_SESSION['loggedin']=true;
                    header('location:dashboard.php?signup=true&email='.$email);
                }
            }
        }
    }
}
?>
