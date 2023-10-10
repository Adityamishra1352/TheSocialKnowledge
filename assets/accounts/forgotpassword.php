<?php 
$verification=0;
include '../_dbconnect.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
$email=null;
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $email=$_POST['email'];
    $sql="SELECT * FROM `users` WHERE `email`='$email'";
    $result=mysqli_query($conn,$sql);
    $numRows=mysqli_num_rows($result);
    if($numRows>0){
        $token = sprintf("%04d", mt_rand(0, 9999));
        $row=mysqli_fetch_assoc($result);
        $name=$row['fname']." ".$row['lname'];
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
            $mail->addAddress($_POST['email']);
            $emailTemplate = file_get_contents('forgot_template.html');
            $emailTemplate = str_replace('[NAME]', $name, $emailTemplate);
            $emailTemplate = str_replace('[TOKEN]', $token, $emailTemplate);
            $mail->isHTML(true);
            $mail->Subject = "Email Verification";
            $mail->Body = $emailTemplate;
            $mail->send();
            $insert_sql="INSERT INTO `forgotpass`(`email`,`token`)VALUES('$email','$token')";
            $insert_result=mysqli_query($conn,$insert_sql);
            if($insert_result){
                header('location:forgotpassword.php?email='.$email);
            }
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
<?php 
if(isset($_GET['email'])){
    $verification=1;
}
else{
    $verification=0;
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
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
                    <a href="signup.php" class="d-flex btn btn-outline-success">Join Us</a>
                </div>
            </div>
        </nav>
        <div class="account-info p-3">
            <h4>Forgot Password</h4>
            <form id="login_form" method="post" class="my-2" action="forgotpassword.php">
                <div class="input-field">
                    <input type="email" class="item3 m-2 p-2" id="email" placeholder="Email" name="email">
                </div>
                <div class="buttons">
                    <button class="btn btn-outline-success my-2">Verify</button>
                </div>
            </form>
        </div>
        <div class="verify-info p-3" style="display: none;">
            <h4>Enter Your Verification Code</h4>
            <form id="login_form" method="post" class="my-2" action="verifyCode.php">
                <div class="input-field">
                    <input type="text" class="item3 m-2 p-2" id="code" placeholder="Verification Code" name="code">
                    <input type="hidden" name="email" value="<?php echo $_GET['email'];?>">
                </div>
                <div class="buttons">
                    <button class="btn btn-outline-success my-2">Verify</button>
                </div>
            </form>
        </div>
    </div>
    <script>
        const account_container=document.querySelector(".account-info");
        const verify_container=document.querySelector(".verify-info");
    </script>
    <?php 
    if($verification==1){
        echo '<script>
        account_container.style.display="none";
        verify_container.style.display="block";
        </script>';
    }else{
        echo '<script>
        account_container.style.display="block";
        verify_container.style.display="none";
        </script>';
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>