<?php
session_start();
include '../_dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../403.php');
}
$currentTimestamp = strtotime('now');
$currentDateTime = date('Y-m-d H:i:s', $currentTimestamp);
$updateSQL = "UPDATE `test` SET `displayed` = 0 WHERE `heldtill` <= '$currentDateTime'";
$updateStartSQL = "UPDATE `test` SET `displayed` = 1 WHERE `time` <= '$currentDateTime'";
$updateresult = mysqli_query($conn, $updateSQL);
$updateStartresult = mysqli_query($conn, $updateStartSQL);
$updateStartSQL = "UPDATE `test` SET `displayed` = 1 WHERE `time` <= '$currentDateTime'";
$updateresult = mysqli_query($conn, $updateSQL);
$updateStartresult = mysqli_query($conn, $updateStartSQL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Tests</title>
    <link rel="stylesheet" href="../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">The Social Knowledge</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../../index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../contactus.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <?php
                    // echo $_SESSION['user_id'];
                    if (!isset($_SESSION['loggedin']) || $_SESSION['user_id'] == NULL) {
                        echo '<button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../accounts/login.php`)">Login</button>';
                    } else {
                        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                            echo '<button class="btn btn-outline-danger me-2"
                            onclick="window.location.href=(`../accounts/admin/admin.php`)">Admin Controls</button>';
                        } elseif (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                            echo '<button class="btn btn-outline-danger me-2"
                            onclick="window.location.href=(`../accounts/organiser/organiser.php`)">Organiser Controls</button>';
                        } else {
                            echo '<button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../accounts/dashboard.php`)">Dashboard</button>';
                        }
                    }
                    ?>

                </div>
            </div>
        </div>
    </nav>
    <div class="container my-2">
        <div class="row">
            <?php
            $user_id = $_SESSION['user_id'];
            $user_id = mysqli_real_escape_string($conn, $user_id);
            $userSql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
            $userSql_result = mysqli_query($conn, $userSql);
            $rowUser = mysqli_fetch_assoc($userSql_result);
            $email = $rowUser['email'];
            $adminUser = "SELECT * FROM `adminusers` WHERE `email`='$email'";
            $adminUser_result = mysqli_query($conn, $adminUser);
            $adminUserRow = mysqli_fetch_assoc($adminUser_result);
            $adminUser_id = $adminUserRow['sno'];
            $sql = "SELECT * FROM test";
            $result = mysqli_query($conn, $sql);
            if (!$result) {
                die("Query failed: " . mysqli_error($conn));
            }
            $countQuizes=0;
            while ($rowTest = mysqli_fetch_assoc($result)) {
                $userfortest = json_decode($rowTest['userfortest'], true);
                if (is_array($userfortest) && in_array($adminUser_id, $userfortest)) {
                    $countQuizes++;
                    $test_id = $rowTest['test_id'];
                    $heading = $rowTest['heading'];
                    $timeDate = $rowTest['time'];
                    $timestamp = strtotime($timeDate);
                    $formattedDate = date('d F Y', $timestamp);
                    $formattedTime = date('H:i', $timestamp);
                    $description = $rowTest['description'];
                    $words = explode(' ', $description);
                    $limitedDescription = implode(' ', array_slice($words, 0, 15));
                    
                    if (count($words) > 15) {
                        $limitedDescription .= '...';
                    }
                    
                    echo '<div class="col"><div class="card" style="width: 18rem;height:16rem;">
                        <div class="card-header">
                            <h5 class="card-title">' . $heading . '</h5>
                            <p class="card-text text-secondary">' . $formattedDate . ' ' . $formattedTime . '</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">' . $limitedDescription . '</p>
                        </div>
                        <div class="card-footer">
                            <a href="quizFeaturetry.php?testid=' . $test_id . '" class="btn btn-outline-success">Take Test</a>
                        </div>
                    </div></div>';
                }
            }
            if($countQuizes==0){
                echo '<div class="card" style="max-width:500px;">
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <p>You dont have any quizes.</p>
                        <footer class="blockquote-footer"><cite title="Source Title">The Social Knowledge</cite></footer>
                      </blockquote>
                    </div>
                  </div>';
            }
            ?>

        </div>
    </div>
    <div class="container my-2 row">
        <?php 
        $codingSQL="SELECT * FROM `codingtest`";
        $codingResult=mysqli_query($conn,$codingSQL);
        while($rowCoding = mysqli_fetch_assoc($codingResult)){
            echo '<div class="col"><div class="card" style="width: 18rem;height:16rem;">
                        <div class="card-header">
                            <h5 class="card-title">' . $rowCoding['heading'] . '</h5>
                            <p class="text-secondary card-text">Code Along</p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">' . $rowCoding['description'] . '</p>
                        </div>
                        <div class="card-footer">
                            <a href="codeTests/codeAlong.php?testid=' . $test_id . '" class="btn btn-outline-success">Take Test</a>
                        </div>
                    </div></div>';
        }
        ?>
    </div>
    <script src="../bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>