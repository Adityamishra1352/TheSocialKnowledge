<?php
session_start();
include '../_dbconnect.php';
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] != true) {
    header('location:../403.php');
}
if(isset($_GET['signup'])&& $_GET['signup']==true){
    $signupEmail=$_GET['email'];
    $signupUser="SELECT * FROM `users` WHERE `email`='$signupEmail'";
    $signupUserResult=mysqli_query($conn,$signupUser);
    $signupUserRow=mysqli_fetch_assoc($signupUserResult);
    $signupUser_id=$signupUserRow['user_id'];
    $_SESSION['user_id']=$signupUser_id;
}
$user_id = $_SESSION['user_id'];
$uploadDir = '../uploads/';
$verified = 0;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $usersql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $usersqlresult = mysqli_query($conn, $usersql);
    $row = mysqli_fetch_assoc($usersqlresult);
    $currentProfileImage = $row['profileImage'];
    if (isset($_FILES['profileImage']) && $_FILES['profileImage']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['profileImage'];
        $fileName = $file['name'];
        $fileTmp = $file['tmp_name'];
        $fileError = $file['error'];
        $uniqueName = uniqid() . $user_id . '_' . $fileName;
        $destination = $uploadDir . $uniqueName;
        if (!empty($currentProfileImage) && file_exists($uploadDir . $currentProfileImage)) {
            unlink($uploadDir . $currentProfileImage);
        }
        if (move_uploaded_file($fileTmp, $destination)) {
            $sql = "UPDATE `users`SET `profileImage`='$uniqueName' WHERE `users`.`user_id`='$user_id'";
            $resultprofile = mysqli_query($conn, $sql);
        } else {
            echo "Error uploading the image.";
        }
    }
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
    <link rel="stylesheet" href="../modules/bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../images/websitelogo.jpg" type="image/png">
    <script src="../modules/jquery/dist/jquery.min.js"></script>
    <style>
        .gridStructure {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 5px;
        }
    </style>
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
                        <a class="nav-link active" aria-current="page" href="../test/test.php">Quiz</a>
                    </li>
                    <?php
                    if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="admin/admin.php">Admin Panel</a>
                    </li>';
                    } elseif (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
                        echo '<li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="organiser/organiser.php">Organiser Panel</a>
                    </li>';
                    }
                    ?>
                </ul>
                <button class="d-flex btn btn-outline-success mx-1" data-bs-toggle="modal"
                    data-bs-target="#editProfileModal">
                    Edit Your Profile
                </button>
                <button class="d-flex btn btn-outline-success mx-1" data-bs-toggle="modal"
                    data-bs-target="#changePassword">
                    Change Password
                </button>
                <button class="d-flex btn btn-outline-danger mx-1" onclick="window.location.href=('logout.php')">
                    Logout
                </button>
            </div>
        </div>
    </nav>
    <?php
    include '../_dbconnect.php';
    $user_sql = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $user_result = mysqli_query($conn, $user_sql);
    $rowUser = mysqli_fetch_assoc($user_result);
    $verified = $rowUser['verified'];
    $email = $rowUser['email'];
    $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
    $description = $rowUser['description'];
    $location = $rowUser['location'];
    $profileImage = $rowUser['profileImage'];
    $courses_array = $rowUser['courses_array'];
    if ($profileImage == NULL) {
        $pic = '../uploads/default.jpg';
    } else {
        $pic = '../uploads/' . $rowUser['profileImage'];
    }
    if (isset($_GET["password"]) && $_GET["password"] == "true") {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success!!</strong> Your password has been changed!!.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    }
    if (isset($_GET['login']) && $_GET['login'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hey ' . $name . '</strong> What are we doing today?.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if (isset($_GET['verify']) && $_GET['verify'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Hey ' . $name . '</strong> Your profile has been verified.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if (isset($_GET['wrongCode']) && $_GET['wrongCode'] == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hey ' . $name . '</strong> You have entered the wrong code.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if (isset($_GET['passwordmatch']) && $_GET['passwordmatch'] == true) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Hey ' . $name . '</strong> Passwords dont match, try again!.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <!-- <?php
    if ($verified == 0) {
        echo '<div class="toast show position-fixed top-2 end-0" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <img src="../images/websitelogo.jpg" class="rounded me-2" alt="..." width="10%">
                <strong class="me-auto">The Social Knowledge</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                <span class="text mb-3">Welcome ' . $name . ', Please verify your profile!! </span>
                <button class="btn btn-outline-success mx-1" data-bs-toggle="modal"
                    data-bs-target="#verifyProfile">
                    Verify
                </button>
            </div>
        </div>';
    }
    ?> -->
    <div class="modal fade" id="verifyProfile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Verify Your Profile:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="verifyProfile.php" method="post">
                        <div class="mb-3">
                            <label for="location" class="form-label">Enter Your Verification Code:</label>
                            <input type="text" class="form-control" id="verifyCode" name="verifyCode"
                                style="width:40%;">
                        </div>
                        <div class="mb-3">
                            <input type="hidden" name="email" id="email" value="<?php echo $email; ?>">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            <?php if (isset($_GET['forgotpass']) && $_GET['forgotpass'] == true) { ?>
                $('#changePassword').modal('show');
            <?php } ?>
        });
    </script>
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
                            <input type="password" class="form-control" id="npassword" name="npassword" required>
                        </div>
                        <div class="mb-3">
                            <label for="cpassword" class="form-label">Confirm Password:</label>
                            <input type="password" class="form-control" id="cpassword" required name="cpassword">
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
        <div class="container">
            <?php
            echo '<div class="card mb-3" style="max-width: 500px;">
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
            ?>
        </div>


        <!-- <div class="container p-2">
            <ul>
                <li>
                    <h4>Courses that you have enrolled in:</h4>
                </li>
            </ul>
            <div class="container gridStructure my-2 p-1">
                <?php
                $count = 0;
                if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
                    $decodedArray = json_decode($courses_array);

                    if (is_array($decodedArray)) {
                        foreach ($decodedArray as $element) {
                            $course_id = $element;
                            $count = $count + 1;
                            $course_sql = "SELECT * FROM `courses` WHERE `course_id`='$course_id'";
                            $course_result = mysqli_query($conn, $course_sql);
                            $rowCourse = mysqli_fetch_assoc($course_result);
                            $course_heading = $rowCourse['heading'];
                            echo '<div class="card mb-3" style="max-width: 400px;">
                <div class="row g-0">
                  <div class="col-md-7">
                    <div class="card-body">
                    <h5 class="card-title">' . $course_heading . '</h5>
                    </div>
                  </div>
                </div>
              </div>';
                        }
                    }
                }
                if ($count == 0) {
                    echo '<div class="card">
                    <div class="card-body">
                      <blockquote class="blockquote mb-0">
                        <p>You havent enrolled in any course.</p>
                        <footer class="blockquote-footer"><cite title="Source Title">The Social Knowledge</cite></footer>
                      </blockquote>
                    </div>
                  </div>';
                }
                ?>
            </div>
        </div>
    </div> -->
    <div class="container my-2">
        <ul>
            <li>
                <h4>Quizes you have attended:</h4>
            </li>
        </ul>
        <div class="container p-1 gridStructure">
            <?php
            $user_id = $_SESSION['user_id'];
            $user_sql = "SELECT test_array FROM users WHERE user_id = $user_id";
            $user_result = mysqli_query($conn, $user_sql);
            if ($user_result) {
                $user_data = mysqli_fetch_assoc($user_result);
                $test_array = json_decode($user_data['test_array'], true);
                if (!empty($test_array)) {
                    foreach ($test_array as $test_id) {
                        $score_sql = "SELECT * FROM `testscores` WHERE `test_id`='$test_id' AND `user_id`='$user_id'";
                        $score_result = mysqli_query($conn, $score_sql);
                        $quiz_sql = "SELECT * FROM test WHERE test_id = $test_id";
                        $quiz_result = mysqli_query($conn, $quiz_sql);
                        if ($score_result) {
                            $quiz_data = mysqli_fetch_assoc($quiz_result);
                            $score_data = mysqli_fetch_assoc($score_result);
                            $quiz_heading = $quiz_data['heading'];
                            $scoreRelease = $quiz_data['scoreRelease'];
                            $score=$score_data['score'];
                            $date = $score_data['date'];
                            $timestamp = strtotime($date);
                            $formattedDate = date('d F Y', $timestamp);
                            if ($scoreRelease == 1) {
                                echo '<div class="card mb-3" style="max-width: 400px;">
                                <div class="row g-0">
                                <div class="col-md-7">
                                <div class="card-body">
                                <h5 class="card-title">' . $quiz_heading . '</h5>
                                <p class="text-secondary">' . $formattedDate . '</p>
                                <p class="card-text">You have scored ' . $score . ' marks.</p>
                                </div>
                                </div>
                                </div>
                                </div>';
                            } else {
                                echo '<div class="card mb-3" style="max-width: 400px;">
                                <div class="row g-0">
                                <div class="col-md-7">
                                <div class="card-body">
                                <h5 class="card-title">' . $quiz_heading . '</h5>
                                <p class="text-secondary">' . $formattedDate . '</p>
                                </div>
                                </div>
                                </div>
                                </div>';
                            }
                        }

                    }
                } else {
                    echo '<div class="card">
                    <div class="card-body">
                    <blockquote class="blockquote mb-0">
                    <p>You currently have not attended any tests.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">Admin</cite></footer>
                    </blockquote>
                    </div>
                    </div>';
                }
            } else {
                echo 'Unable to retrieve user data.';
            }
            ?>
        </div>
    </div>
    <!-- <div class="container my-2">
    <?php
$user_id = $_SESSION['user_id'];
$directory = "../test/answers/";
$userCodes = [];
foreach (scandir($directory) as $file) {
    $filePath = $directory . $file;
    if (is_file($filePath) && strpos($file, $user_id) === 0) {
        $code = file_get_contents($filePath);
        $language = pathinfo($file, PATHINFO_EXTENSION);
        $userCodes[] = [
            'language' => $language,
            'code' => $code
        ];
    }
}
?>
    <h1>Your Stored Codes</h1>
    <?php
    foreach ($userCodes as $codeInfo) {
        $language = $codeInfo['language'];
        $code = $codeInfo['code'];

        echo "<h3>Code (Language: $language)</h3>";
        echo "<pre>$code</pre>";
    }
    ?>

    </div> -->
    <script src="../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>