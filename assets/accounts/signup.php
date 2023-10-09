<?php
session_start();
include '../_dbconnect.php';
$message = 0;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['emailAddress'];
    $password = $_POST['passWord'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 3;
    } elseif (strlen($password) < 8) {
        $message = 4;
    } else {
        $fetch_email = "SELECT * FROM `users` WHERE `email`='$email'";
        $fetch_result = mysqli_query($conn, $fetch_email);
        $num = mysqli_num_rows($fetch_result);
        if ($num >= 1) {
            $message = 2;
        } else {
            $token = sprintf("%04d", mt_rand(0, 9999));
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $signup_sql = "INSERT INTO `users` ( `fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$hash');";
            $result_signup = mysqli_query($conn, $signup_sql);
            if ($result_signup) {
                $tokenSql = "INSERT INTO `verification`(`token`,`email`)VALUES('$token','$email')";
                $tokenResult = mysqli_query($conn, $tokenSql);
                if ($tokenResult) {
                    $message = 1;
                    $mail = new PHPMailer(true);
                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->Username = 'socialknowledge38@gmail.com';
                        $mail->Password = 'imcdramgpiuaswii';
                        $mail->SMTPSecure = 'ssl';
                        $mail->Port = 465;
                        $mail->setFrom('socialknowledge38@gmail.com');
                        $mail->addAddress($_POST['emailAddress']);
                        $emailTemplate = file_get_contents('verification_email.html');
                        $emailTemplate = str_replace('[NAME]', $fname, $emailTemplate);
                        $emailTemplate = str_replace('[TOKEN]', $token, $emailTemplate);
                        $mail->isHTML(true);
                        $mail->Subject = "Email Verification";
                        $mail->Body = $emailTemplate;
                        $mail->send();
                    } catch (Exception $e) {
                        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                header('location:signup.php?message=' . $message);
            }
        }
    }
}

if (isset($_GET['message'])) {
    $message = $_GET['message'];
} else {
    $message = 0;
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge:Signup</title>
    <link rel="stylesheet" href="/TheSocialKnowledge/assets/css/signup.css">
    <!-- <script type="text/javascript">
      document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        window.alert("Right-click is not allowed on this page!");
      }, false);
    </script> -->
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="page">
        <nav class="navbar navbar-expand-lg" style="width:100%;">
            <div class="container-fluid">
                <a class="navbar-brand" href="../../index.php">The Social Knowledge</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                        </li>
                    </ul>
                    <a href="../../contactus.php" class="d-flex btn btn-primary mx-2">Contact Us</a>
                    <a href="login.php" class="d-flex btn btn-outline-success">Login</a>
                </div>
            </div>
        </nav>
        <?php
        if ($message == 1) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully Signed Up</strong> Verify Your account.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } elseif ($message == 2) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Email already exists</strong> You should use another email.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } elseif ($message == 3) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please give correct email!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } elseif ($message == 4) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password must be greater than 8 digits!!</strong> You should use another password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <div class="account-info">
            <div id="signup_form">
                <h1>Create new account.</h1>
                <h6>Already A Member?<a href="login.php">Log In</a></h6>
            </div>
        </div>
        <div class="input-field my-4">
            <form action="signup.php" method="post">
                <input type="text" class="item1 m-2 p-2" id="firstName" placeholder="First Name" name="firstName">
                <input type="text" class="item2 m-2 p-2" id="lastName" placeholder="Last Name" name="lastName">
                <input type="email" class="item3 m-2 p-2" id="email" placeholder="Email" name="emailAddress">
                <input type="password" class="item4 m-2 p-2" id="passWord" placeholder="Password" name="passWord">
                <!-- <div class="passwordmessage">
                <b>Password must contain:
                <ul>
                    <li>A LowerCase letter.</li>
                    <li>A Capital Letter</li>
                    <li>A number</li>
                    <li>Minimum 8 digits</li>
                </ul>
                </b>
            </div> -->
                <button class="btn btn-primary">Create Account</button>
            </form>
        </div>
        <!-- <div class="buttons"> -->
        <!-- <button>Create Account</button> -->
        <!-- </div> -->
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>