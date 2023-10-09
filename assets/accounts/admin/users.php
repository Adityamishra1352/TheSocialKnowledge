<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('location:../../403.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../../contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin.php">Admin Block</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2 p-1">
        <div class="row">
        <?php 
        include '../../_dbconnect.php';
        $users_sql="SELECT * FROM `users`";
        $users_result=mysqli_query($conn,$users_sql);
        $pic = null;
        $user_sql = "SELECT * FROM `users`";
        $user_result = mysqli_query($conn, $user_sql);
        while ($rowUser = mysqli_fetch_assoc($user_result)) {
            $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
            $email=$rowUser['email'];
            $description = $rowUser['description'];
            $location = $rowUser['location'];
            $profileImage = $rowUser['profileImage'];
            if ($profileImage == NULL) {
                $pic = '../../uploads/default.jpg';
            } else {
                $pic ='../../uploads/'. $profileImage;
            }
            echo '<div class="col"><div class="card" style="width: 18rem;">
            <img src="'.$pic.'" class="card-img-top" alt="..." style="width:100%;height:100%;">
            <div class="card-body">
              <h5 class="card-title">'.$name.'</h5>
              <p class="text-secondary">'.$email.'</p>
              <p class="text-secondary">'.$location.'</p>
              <p class="card-text">'.$description.'</p>
            </div>
          </div></div>';
        }
        ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>