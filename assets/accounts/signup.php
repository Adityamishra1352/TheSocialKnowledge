<?php
session_start();
include '../_dbconnect.php';
// use PHPMailer\PHPMailer\PHPMailer;
// use PHPMailer\PHPMailer\Exception;

// require 'phpmailer/src/Exception.php';
// require 'phpmailer/src/PHPMailer.php';
// require 'phpmailer/src/SMTP.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $fname = $_POST['firstName'];
    $lname = $_POST['lastName'];
    $email = $_POST['emailAddress'];
    $password = $_POST['passWord'];
    $enroll=$_POST['enrollment'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header('location:signup.php?wrongEmail=true');
    } elseif (strlen($password) < 8) {
        header('location:signup.php?passwordLess=true');
    }elseif(strlen($enroll)>8){
        header('location:signup.php?enroll=true');
    }
     else {
        $fetch_email = "SELECT * FROM `users` WHERE `email`='$email'";
        $fetch_result = mysqli_query($conn, $fetch_email);
        $num = mysqli_num_rows($fetch_result);
        if ($num >= 1) {
            header('location:signup.php?emailExists=true');
        } else {
            // $token = sprintf("%04d", mt_rand(0, 9999));
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $signup_sql = "INSERT INTO `users` ( `fname`, `lname`, `email`, `password`,`enrollment`) VALUES ('$fname', '$lname', '$email', '$hash','$enroll');";
            $result_signup = mysqli_query($conn, $signup_sql);
            // $_SESSION['loggedin']=true;
            // $_SESSION['user_id']=;
            if ($result_signup) {
                // $tokenSql = "INSERT INTO `verification`(`token`,`email`)VALUES('$token','$email')";
                // $tokenResult = mysqli_query($conn, $tokenSql);
                // if ($tokenResult) {
                //     $message = 1;
                //     $mail = new PHPMailer(true);
                //     try {
                //         $mail->isSMTP();
                //         $mail->Host = 'smtp.gmail.com';
                //         $mail->SMTPAuth = true;
                //         $mail->Username = 'socialknowledge38@gmail.com';
                //         $mail->Password = 'imcdramgpiuaswii';
                //         $mail->SMTPSecure = 'ssl';
                //         $mail->Port = 465;
                //         $mail->setFrom('socialknowledge38@gmail.com');
                //         $mail->addAddress($_POST['emailAddress']);
                //         $emailTemplate = file_get_contents('verification_email.html');
                //         $emailTemplate = str_replace('[NAME]', $fname, $emailTemplate);
                //         $emailTemplate = str_replace('[TOKEN]', $token, $emailTemplate);
                //         $mail->isHTML(true);
                //         $mail->Subject = "Email Verification";
                //         $mail->Body = $emailTemplate;
                //         $mail->send();
                //     } catch (Exception $e) {
                //         echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                //     }
                // }
                header('location:signup.php?success=true');
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
    <title>The Social Knowledge: Signup</title>
    <link rel="stylesheet" href="/TheSocialKnowledge/assets/css/signup.css">
    <!-- <script type="text/javascript">
      document.addEventListener("contextmenu", function(e) {
        e.preventDefault();
        window.alert("Right-click is not allowed on this page!");
      }, false);
    </script> -->
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
        if(isset($_GET['success']) && $_GET['success']==true){
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Successfully Signed Up!!</strong> Please Login.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if(isset($_GET['emailExists']) && $_GET['emailExists']==true){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Email already exists!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if(isset($_GET['wrongEmail']) && $_GET['wrongEmail']==true){
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Please give correct email!!</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if (isset($_GET['passwordLess']) && $_GET['passwordLess']==true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Password must be greater than 8 digits!!</strong> You should use another password.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        } 
        if (isset($_GET['enroll']) && $_GET['enroll']==true) {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Wrong Enrollment Number!!</strong> Please enter the correct enrollment number.
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
                <input type="text" class="item1 m-2 p-2" required id="firstName" placeholder="First Name*" name="firstName">
                <input type="text" class="item2 m-2 p-2" id="lastName" placeholder="Last Name" name="lastName">
                <input type="text" class="item2 m-2 p-2" required id="enrollment" placeholder="Enrollment Number*" name="enrollment">
                <input type="email" class="item3 m-2 p-2" required id="email" placeholder="Email*" name="emailAddress">
                <input type="password" class="item4 m-2 p-2" required id="passWord" placeholder="Password*" name="passWord">
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
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>