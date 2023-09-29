<?php 
session_start();
include '../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
    $fname=$_POST['firstName'];
    $lname=$_POST['lastName'];
    $email=$_POST['emailAddress'];
    $password=$_POST['passWord'];
    $fetch_email="SELECT * FROM `users` WHERE `email`='$email'";
    $fetch_result=mysqli_query($conn, $fetch_email);
    $num = mysqli_num_rows($fetch_result);
    if($num>=1){
        echo "email already exists";
    }
    else{
    $hash=password_hash($password,PASSWORD_DEFAULT);
    $signup_sql="INSERT INTO `users` ( `fname`, `lname`, `email`, `password`) VALUES ('$fname', '$lname', '$email', '$hash');";
    $result_signup=mysqli_query($conn,$signup_sql);
    if($result_signup){
        $_SESSION['user_email']=$email;
        echo "successfully signed up";
    }
}
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
    
</head>

<body>
    <div class="page">
        <nav>
            <p><b>The Social Knowledge</b></p>
            <a href="/index.php">Home</a>
            <a href="login.php">LogIN</a>
            <br>
            <br>
        </nav>
        <div class="account-info">
            <form id="signup_form">
                <h4>START FOR FREE</h4>
                <h1>Create new account.</h1>
                <h4>Already A Member?<a href="login.php">Log In</a></h4>
            </form>
        </div>
        <div class="input-field">
            <form action="signup.php" method="post">
                <input type="text" class="item1" id="firstName" placeholder="First Name" name="firstName">
                <input type="text" class="item2" id="lastName" placeholder="Last Name" name="lastName">
                <input type="email" class="item3" id="email" placeholder="Email" name="emailAddress">
                <input type="password" class="item4" id="passWord" placeholder="Password" name="passWord">
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
            <button>Create Account</button>
            </form>
        </div>
        <!-- <div class="buttons"> -->
            <!-- <button>Create Account</button> -->
        <!-- </div> -->
    </div>
    </div>
</body>

</html>