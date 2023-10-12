<?php
session_start();
$wrongPass = 0;
$doesntExist = 0;
include '../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM `users` WHERE `email`='$email'";
    $fetch_email = mysqli_query($conn, $sql);
    if ($num = mysqli_num_rows($fetch_email)) {
        $rowLogin = mysqli_fetch_assoc($fetch_email);
        if (password_verify($password, $rowLogin['password'])) {
            $user_id = $rowLogin['user_id'];

            if ($rowLogin['admin'] == 1) {
                $_SESSION['admin'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['loggedin'] = true;
                header('location:admin/admin.php');
                exit();
            } elseif ($rowLogin['organiser'] == 1) {
                $_SESSION['organiser'] = true;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['loggedin'] = true;
                header('location:organiser/organiser.php');
                exit();
            } else {
                $_SESSION['loggedin'] = true;
                $_SESSION['user_id'] = $user_id;
                header("location:dashboard.php?login=true");
                exit();
            }
        } else {
            $wrongPass = 1;
        }
    } else {
        $doesntExist = 1;
    }
}
?>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge:Login</title>
    <link rel="stylesheet" href="../css/login.css">
        <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
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
        <?php
        if ($wrongPass) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Wrong Password</strong> Try Again!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        if ($doesntExist) {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>User Doesnt Exist</strong> Try Again!!
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
        <div class="account-info p-3">
            <h4>Login Into Your Account</h4>
            <form id="login_form" method="post" class="my-2" action="login.php">
                <div class="input-field">
                    <input type="email" class="item3 m-2 p-2" id="email" placeholder="Email" name="email">
                    <input type="password" class="item4 m-2 p-2" id="password" placeholder="Password" name="password">
                </div>
                <div class="buttons">
                    <button class="btn btn-outline-success my-2">Login</button>
                </div>
            </form>
        </div>
        <!-- <div class="container">
            <a href="forgotpassword.php">Forgot Password</a>
        </div> -->
    </div>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>