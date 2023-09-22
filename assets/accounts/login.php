<?php
session_start();
include '../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `email`='$email'";
    $fetch_email = mysqli_query($conn, $sql);
    $num = mysqli_num_rows($fetch_email);
    if ($num == 1) {
        while ($rowLogin = mysqli_fetch_assoc($fetch_email)) {
            if (password_verify($password, $rowLogin['password'])) {
                $user_id = $rowLogin['user_id'];
                if($rowLogin['admin']==1){
                    $_SESSION['admin']=true;
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['loggedin'] = true;
                    header('location:admin/admin.php');
                    exit();
                }
                elseif($rowLogin['organiser']==1){
                    $_SESSION['organiser']=true;
                    $_SESSION['user_id']=$user_id;
                    $_SESSION['loggedin'] = true;
                    header('location:organiser/organiser.php');
                    exit();
                }
                else{
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                header("location:dashboard.php?user_id=.$user_id.");
            }
        }
            else{
                echo "wrong password";
            }
        }
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <!-- <script type="text/javascript">
      document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        window.alert("Right-click is not allowed on this page!");
      }, false);
    </script> -->
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <div class="page">
        <nav>
            <p><b>The Social Knowledge</b></p>
            <a href="/TheSocialKnowledge/index.php">Home</a>
            <a href="signup.php">Join Us</a>
            <br>
            <br>
        </nav>
        <div class="account-info">
            <form id="login_form" method="post" action="login.php">
                <br><br><br>
                <h2>Login Into Your Account</h2>
                <div class="input-field">
                    <input type="email" class="item3" id="email" placeholder="Email" name="email">
                    <input type="password" class="item4" id="password" placeholder="Password" name="password">
                    <a href="/Myaccountrelated/forgotpassword.html">Forgotten Password??</a>
                </div>
                <div class="buttons">
                    <button>Login</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>