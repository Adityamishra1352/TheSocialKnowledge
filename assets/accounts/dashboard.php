<?php
session_start();
include '../_dbconnect.php';
$user_id = $_SESSION['user_id'];
$uploadDir = '../uploads/';
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_FILES['profileImage'])) {
        $file = $_FILES['profileImage'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $uniqueName = uniqid() . $user_id . '_' . $fileName;
        $destination = $uploadDir . $uniqueName;
        if (move_uploaded_file($fileTmp, $destination)) {
            $sql = "UPDATE `users`SET `profileImage`='$destination' WHERE `users`.`user_id`='$user_id'";
            $resultprofile = mysqli_query($conn, $sql);
        } else {
            echo "Error uploading the image.";
        }
    }
    $usersql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $usersqlresult = mysqli_query($conn, $usersql);
    $row = mysqli_fetch_assoc($usersqlresult);
    $description = $_POST['description'];
    $location = $_POST['location'];
    if ($description != null) {
        $update_sql = "UPDATE `users` SET `description` = '$description' WHERE `users`.`user_id` = '$user_id'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
    if ($location != null) {
        $update_sql = "UPDATE `users` SET `location` = '$location' WHERE `users`.`user_id` = '$user_id'";
        $updateresult = mysqli_query($conn, $update_sql);
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>The Social Knowledge: Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                </ul>
                <button class="d-flex btn btn-outline-success mx-1" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal">
                    Edit Your Profile
                </button>
                <button class="d-flex btn btn-outline-success mx-1" data-bs-toggle="modal"
                    data-bs-target="#changePassword">
                    Change Password
                </button>
            </div>
        </div>
    </nav>
    <?php
        if (isset($_GET["password"]) && $_GET["password"] == "true") {
            echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your password has been changed!!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        ?>
    <div class="modal fade" id="changePassword" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Your Password:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="changePassword.php" method="post">
                        <div class="mb-3">
                            <label for="npassword" class="form-label">New Password:</label>
                            <input type="password" class="form-control" id="npassword" name="npassword">
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpassword" name="cpassword">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Your Profile:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="dashboard.php" enctype="multipart/form-data" method="post">
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Description:</label>
                            <textarea name="description" class="form-control" id="exampleFormControlTextarea1"
                                rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="profileImage" class="form-label">Change Profile Picture:</label>
                            <input type="file" class="form-control" id="profileImage" name="profileImage">
                        </div>
                        <div class="mb-3">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" class="form-control" id="location" name="location">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-2">
        <?php
        include '../_dbconnect.php';
        $pic = null;
        $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
        $user_result = mysqli_query($conn, $user_sql);
        while ($rowUser = mysqli_fetch_assoc($user_result)) {
            $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
            $description = $rowUser['description'];
            $location = $rowUser['location'];
            $profileImage = $rowUser['profileImage'];
            if ($profileImage == NULL) {
                $pic = '../uploads/default.jpg';
            } else {
                $pic = $rowUser['profileImage'];
            }
            echo '<div class="card mb-3" style="max-width: 800px;">
            <div class="row g-0">
                <div class="col-md-4">
                    <img src="' . $pic . '" class="img-fluid rounded-start" alt="Profile Image">
                </div>
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title">' . $name . '</h5>
                        <p class="card-text">' . $description . '</p>
                        <p class="card-text"><small class="text-body-secondary">' . $location . '</small></p>
                    </div>
                </div>
            </div>
        </div>';
        }
        ?>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
</body>

</html>