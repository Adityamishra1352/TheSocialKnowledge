<?php
session_start();
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != true) {
    header('location:../../403.php');
}
include '../../_dbconnect.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Admin</title>
    <link rel="stylesheet" href="../../modules/bootstrap-5.3.2-dist/css/bootstrap.css">
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
                        <a class="nav-link" href="users.php">View Users</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../dashboard.php">Dashboard</a>
                    </li>
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <nav class="navbar navbar-light bg-light">
        <form class="container-fluid justify-content-start">
            <!-- <button class="btn btn-success me-2" type="button" id="runningCourse_btn">Running Courses</button> -->
            <button class="btn btn-outline-success me-2" type="button" id="organisers_btn">View Organisers</button>
            <button class="btn btn-outline-success me-2" type="button" id="addOrganiser_btn">Add Organisers</button>
            <!-- <button class="btn btn-outline-success me-2" type="button" id="quiz_btn">Quizes</button> -->
            <!-- <button class="btn btn-outline-success me-2" type="button" id="addCourse_btn">Add Course</button> -->
            <!-- <button class="btn btn-outline-success me-2" type="button" id="courseTest_btn">Course Tests</button> -->
            <button class="btn btn-outline-success me-2" type="button" id="addUsers_btn">Add Users</button>
        </form>
    </nav>
    <?php
    // if (isset($_GET['addCourse']) && $_GET['addCourse'] == true) {
    //     echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    //     <strong>New Course has been added successfully!!</strong> Check it out from view courses.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    // }
    if (isset($_GET['addOrganiser']) && $_GET['addOrganiser'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>New Organiser has been added successfully!!</strong> Check it out from view organisers.
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    // if (isset($_GET['deleteCourse']) && $_GET['deleteCourse'] == true) {
    //     echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    //     <strong>Course has been deleted successfully!!</strong> Check it out from view courses.
    //     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    //   </div>';
    // }
    if (isset($_GET['uploadUsers']) && $_GET['uploadUsers'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Users have been added successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    if (isset($_GET['addOrganiser']) && $_GET['addOrganiser'] == false) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Error while add organiser!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>';
    }
    ?>
    <div class="container my-2 p-1 addUsers_container" style="display:none;">
        <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> Give Faculty whilst adding
            faculty as a user at the batch.</span>
        <ul class="my-2">
            <li>
                <h6>Add users via CSV file:</h6>
            </li>
        </ul>
        <div class="container my-2">
            <form id="question-form" action="addUsers.php" method="post" enctype="multipart/form-data">
                <input type="file" name="csv_file" accept=".csv" required>
                <button type="submit" class="btn btn-success m-2">Submit</button>
            </form>
        </div>
        <ul>
            <li>
                <h6>Add users individually:</h6>
            </li>
        </ul>
        <div class="container my-2">
            <form id="users-form" action="uploadUsers.php" method="post" enctype="multipart/form-data">
                <div id="questions">
                    <!-- Existing code for dynamic questions and options -->
                </div>
                <button type="button" class="btn btn-primary m-2" id="add-question">Add User</button>
                <button type="submit" class="btn btn-success m-2" id="submit-form">Submit</button>
            </form>
        </div>

    </div>
    <div class="container my-2 p-1">
        <div class="container mx-2 runningCourses" style="display:none;grid-template-columns:1fr 1fr 1fr;">
            <?php
            $course_sql = "SELECT * FROM `courses` WHERE `displayed`=1";
            $course_result = mysqli_query($conn, $course_sql);
            while ($rowCourse = mysqli_fetch_assoc($course_result)) {
                $heading = $rowCourse['heading'];
                $description = $rowCourse['description'];
                $course_id = $rowCourse['course_id'];
                echo '<div class="card my-2" style="width: 18rem;">
                 <div class="card-body">
                 <h5 class="card-title">' . $heading . '</h5>
                 <p class="card-text mb-2">' . $description . '</p>
                 <a href="editCourse.php?course_id=' . $course_id . '" class="btn btn-primary">Edit Course</a>
                 <a href="deleteCourse.php?course_id=' . $course_id . '" class="btn btn-danger m-2">Delete</a>
                </div></div>';
            }
            ?>
        </div>
    </div>
    <div class="container my-3">
        <div class="container my-2 viewOrganisers" style="display:none;grid-template-columns:1fr 1fr 1fr;">
            <?php
            $viewOrganisers = "SELECT * FROM `users` WHERE `organiser`=1";
            $viewOrganiser_result = mysqli_query($conn, $viewOrganisers);
            while ($rowOrganiser = mysqli_fetch_assoc($viewOrganiser_result)) {
                $name = $rowOrganiser['fname'] . " " . $rowOrganiser['lname'];
                $email = $rowOrganiser['email'];
                $orgainser_id = $rowOrganiser['user_id'];
                echo '
                <div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $name . '</h5>
                  <p class="card-text">' . $email . '</p>
                  <a href="deleteOrganiser.php?orgainser_id=' . $orgainser_id . '" class="btn btn-outline-danger">Delete Orgainser</a>
                </div>
              </div>';
            }
            ?>
        </div>
    </div>
    <div class="container addOrganisers my-3" style="display:none;">
        <div class="container my-2">
            <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> The new organiser must
                be
                the user of the website.</span>
            <form method="post" action="addOrganiser.php" style="width: 40%;">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Email address:</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        name="email">
                </div>
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </form>
        </div>
    </div>
    <div class="container quizes_container my-3" style="display: none;">
        <ul>
            <li>
                <h4>Quizes Visible On The Website!!</h4>
            </li>
        </ul>
        <div class="container">
            <div class="my-2" style="display:grid;grid-template-columns:1fr 1fr 1fr;">
                <?php
                include '../../_dbconnect.php';
                $nameOrganiser = null;
                $organiser_id = $_SESSION['user_id'];
                $organiserFetch = "SELECT * FROM `users` WHERE `user_id`='$organiser_id'";
                $organiserFetch_result = mysqli_query($conn, $organiserFetch);
                while ($rowFetchOrganiser = mysqli_fetch_assoc($organiserFetch_result)) {
                    $nameOrganiser = $rowFetchOrganiser['fname'] . " " . $rowFetchOrganiser['lname'];
                }
                $quizfetch_sql = "SELECT * FROM `test` WHERE `displayed`=1";
                $fetch_result = mysqli_query($conn, $quizfetch_sql);
                while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                    $test_id = $rowQuiz['test_id'];
                    $heading = $rowQuiz['heading'];
                    $timeDate = $rowQuiz['time'];
                    $description = $rowQuiz['description'];
                    echo '<div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">' . $timeDate . '</p>
                  <p class="card-text">' . $description . '</p>
                  <p class="card-text text-secondary">' . $nameOrganiser . '</p>
                  <a href="../organiser/deleteQuiz.php?test_id=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
                </div>
              </div>';
                }
                ?>
            </div>
        </div>
        <ul>
            <li>
                <h4>Quizes Not Visible On The Website!!</h4>
            </li>
        </ul>
        <div class="container">
            <div class="my-2" style="display:grid;grid-template-columns:1fr 1fr 1fr;">
                <?php
                include '../../_dbconnect.php';
                $nameOrganiser = null;
                $organiser_id = $_SESSION['user_id'];
                $organiserFetch = "SELECT * FROM `users` WHERE `user_id`='$organiser_id'";
                $organiserFetch_result = mysqli_query($conn, $organiserFetch);
                while ($rowFetchOrganiser = mysqli_fetch_assoc($organiserFetch_result)) {
                    $nameOrganiser = $rowFetchOrganiser['fname'] . " " . $rowFetchOrganiser['lname'];
                }
                $quizfetch_sql = "SELECT * FROM `test` WHERE `displayed`=0";
                $fetch_result = mysqli_query($conn, $quizfetch_sql);
                while ($rowQuiz = mysqli_fetch_assoc($fetch_result)) {
                    $test_id = $rowQuiz['test_id'];
                    $heading = $rowQuiz['heading'];
                    $timeDate = $rowQuiz['time'];
                    $description = $rowQuiz['description'];
                    echo '<div class="card" style="width: 18rem;">
                <div class="card-body">
                  <h5 class="card-title">' . $heading . '</h5>
                  <p class="card-text text-secondary">' . $timeDate . '</p>
                  <p class="card-text">' . $description . '</p>
                  <p class="card-text text-secondary">' . $nameOrganiser . '</p>
                  <a href="../organiser/addQuestions.php?test_id=' . $test_id . '" class="btn btn-outline-success">Read Questions</a>
                </div>
              </div>';
                }
                ?>
            </div>
        </div>
    </div>
    <div class="container my-2 p-1 addCourse_container" style="width:40%;display:none;">
        <form action="addCourse.php" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Course Name:*</label>
                <input type="text" class="form-control" name="course_name" required>
            </div>
            <div class="form-floating">
                <textarea class="form-control" style="height: 100px" name="course_description" required></textarea>
                <label for="floatingTextarea2">Short Description*</label>
            </div>
            <button type="submit" class="btn btn-primary my-2">Submit</button>
        </form>
    </div>
    <div class="container my-3 courseTest" style="display:none;">
        <div class="container" style="display:grid;grid-template-columns:1fr 1fr 1fr;">
            <?php
            $coursequizfetch_sql = "SELECT * FROM `test` WHERE `displayed`=1 AND `course_id`!=0";
            $coursefetch_result = mysqli_query($conn, $coursequizfetch_sql);
            while ($rowCourseQuiz = mysqli_fetch_assoc($coursefetch_result)) {
                $test_id = $rowCourseQuiz['test_id'];
                $heading = $rowCourseQuiz['heading'];
                $description = $rowCourseQuiz['description'];
                echo '<div class="card" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">' . $heading . '</h5>
              <p class="card-text">' . $description . '</p>
              <p class="card-text text-secondary">' . $nameOrganiser . '</p>
              <a href="../organiser/addQuestions.php?testid=' . $test_id . '" class="btn btn-outline-success">Read Questions</a>
              <a href="../organiser/deleteQuiz.php?testid=' . $test_id . '" class="btn btn-outline-danger">Delete Quiz</a>
            </div>
          </div>';
            }
            ?>
        </div>
    </div>
    <script src="../../modules/bootstrap-5.3.2-dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // const runningCourse_btn = document.querySelector("#runningCourse_btn");
        const runningCourses = document.querySelector(".runningCourses");
        const organiser_btn = document.querySelector("#organisers_btn");
        const viewOrganisers = document.querySelector(".viewOrganisers");
        const addOrganiser_btn = document.querySelector("#addOrganiser_btn");
        const addOrganiser = document.querySelector(".addOrganisers");
        const quiz_container = document.querySelector(".quizes_container");
        // const quiz_btn = document.querySelector("#quiz_btn");
        const courseTest_btn = document.querySelector("#courseTest_btn");
        const courseTest_container = document.querySelector(".courseTest");
        // const addCourse_btn = document.querySelector("#addCourse_btn");
        const addCourse_container = document.querySelector(".addCourse_container");
        const addUsers_btn = document.querySelector("#addUsers_btn");
        const addUsers_container = document.querySelector(".addUsers_container");
        // runningCourse_btn.onclick = () => {
        //     runningCourses.style.display = "grid";
        //     viewOrganisers.style.display = "none";
        //     addOrganiser.style.display = "none";
        //     quiz_container.style.display = "none";
        //     courseTest_container.style.display = "none";
        //     addCourse_container.style.display = "none";
        //     addUsers_container.style.display = "none";
        // }
        organiser_btn.onclick = () => {
            runningCourses.style.display = "none";
            viewOrganisers.style.display = "grid";
            addOrganiser.style.display = "none";
            quiz_container.style.display = "none";
            courseTest_container.style.display = "none";
            addCourse_container.style.display = "none";
            addUsers_container.style.display = "none";
        }
        addOrganiser_btn.onclick = () => {
            runningCourses.style.display = "none";
            viewOrganisers.style.display = "none";
            addOrganiser.style.display = "block";
            quiz_container.style.display = "none";
            courseTest_container.style.display = "none";
            addCourse_container.style.display = "none";
            addUsers_container.style.display = "none";
        }
        // quiz_btn.onclick = () => {
        //     runningCourses.style.display = "none";
        //     viewOrganisers.style.display = "none";
        //     addUsers_container.style.display = "none";
        //     addOrganiser.style.display = "none";
        //     quiz_container.style.display = "block";
        //     courseTest_container.style.display = "none";
        //     addCourse_container.style.display = "none";
        // }
        // addCourse_btn.onclick = () => {
        //     runningCourses.style.display = "none";
        //     viewOrganisers.style.display = "none";
        //     addOrganiser.style.display = "none";
        //     addUsers_container.style.display = "none";
        //     quiz_container.style.display = "none";
        //     courseTest_container.style.display = "none";
        //     addCourse_container.style.display = "block";
        // }
        // courseTest_btn.onclick = () => {
        //     runningCourses.style.display = "none";
        //     viewOrganisers.style.display = "none";
        //     addOrganiser.style.display = "none";
        //     addUsers_container.style.display = "none";
        //     quiz_container.style.display = "none";
        //     courseTest_container.style.display = "block";
        //     addCourse_container.style.display = "none";
        // }
        addUsers_btn.onclick = () => {
            runningCourses.style.display = "none";
            viewOrganisers.style.display = "none";
            addOrganiser.style.display = "none";
            addUsers_container.style.display = "block";
            quiz_container.style.display = "none";
            courseTest_container.style.display = "none";
            addCourse_container.style.display = "none";
        }
        document.addEventListener("DOMContentLoaded", function () {
            const addQuestionButton = document.getElementById("add-question");
            const questionsContainer = document.getElementById("questions");
            let questionCount = -1;
            addQuestionButton.addEventListener("click", function () {
                addQuestionButton.style.display="none";
                questionCount++;
                const questionDiv = document.createElement("div");
                questionDiv.classList.add("question");
                questionDiv.innerHTML = `
    <div class="row">
    <div class="col">
            <input type="email" id="question-${questionCount}" name="questions[]" class="form-control" style="width:30%" placeholder="User Email"></input>
        </div>
    </div>
    <div class="options row row-cols-2"></div>
    <button type="button" class="btn btn-outline-success add-option m-2">Add Details</button>
    <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove User</button>`;
                questionsContainer.appendChild(questionDiv);

                const removeQuestionButton =
                    questionDiv.querySelector(".remove-question");
                removeQuestionButton.addEventListener("click", function () {
                    questionsContainer.removeChild(questionDiv);
                });

                const optionsContainer = questionDiv.querySelector(".options");
                let optionCount = 0;

                questionDiv
                    .querySelector(".add-option")
                    .addEventListener("click", function () {
                        const optionDiv = document.createElement("div");
                        optionDiv.setAttribute("class", "row align-items-center p-2");
                        // optionDiv.style.display = "flex";
                        const optionRadio = document.createElement("textarea");
                        optionRadio.setAttribute("class", "col form-control m-1");
                        optionRadio.setAttribute("placeholder", `Batch/Faculty`);
                        optionRadio.setAttribute("name", `batch-${questionCount}`);

                        const optionInput = document.createElement("textarea");
                        optionInput.setAttribute("class", "col form-control m-1");
                        optionInput.setAttribute("name", `year-${questionCount}`);
                        optionInput.setAttribute("placeholder", `Year`);
                        
                        const enrollInput=document.createElement("textarea");
                        enrollInput.setAttribute("class","col form-control m-1");
                        enrollInput.setAttribute("name",`enroll-${questionCount}`);
                        enrollInput.setAttribute("placeholder","EnrollNo.");
                        optionDiv.appendChild(optionRadio);
                        optionDiv.appendChild(optionInput);
                        optionDiv.appendChild(enrollInput);
                        optionsContainer.appendChild(optionDiv);
                        optionCount++;
                        questionDiv.querySelector(".add-option").disabled = true;
                    });

            });
            const csvFileInput = document.querySelector("input[type='file']");
            csvFileInput.addEventListener("change", function () {
                questionsContainer.innerHTML = "";
                addQuestionButton.style.display = "none";
            });

        });
        // const form = document.getElementById("users-form");
        // form.addEventListener("submit", function (event) {
        //     event.preventDefault();
        //     const formData = new FormData(form);
        //     fetch(form.action, {
        //         method: form.method,
        //         body: formData
        //     })
        //         .then(response => response.json())
        //         .then(data => {
        //             console.log(data);
        //         })
        //         .catch(error => {
        //             console.error('Error:', error);
        //         });
        // });
    </script>
</body>

</html>