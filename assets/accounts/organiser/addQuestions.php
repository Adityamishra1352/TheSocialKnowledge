<?php
session_start();
include '../../_dbconnect.php';
if (
    !(isset($_SESSION['organiser']) && $_SESSION['organiser'] === true) &&
    !(isset($_SESSION['admin']) && $_SESSION['admin'] === true)
) {
    header('location: ../../403.php');
}
$test_id = $_GET['test_id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link rel="stylesheet" href="../../bootstrap-5.3.2-dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <script src="../../chart.js/dist/chart.umd.js"></script>
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
                        <a class="nav-link" href="organiser.php">Organiser Panel</a>
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
            <button class="btn btn-outline-success me-2" type="button" id="setString">Authentication Code</button>
            <button class="btn btn-outline-success me-2" type="button" id="setTime_btn">Edit Features</button>
            <button class="btn btn-outline-success me-2" type="button" id="editQuestions_btn">Edit/Add
                Questions</button>
            <button class="btn btn-outline-success me-2" type="button" id="setUsers_btn">Set Users</button>
            <button class="btn btn-outline-success me-2" type="button" id="users_btn">Responses</button>
        </form>
    </nav>
    <?php
    if (isset($_GET['uploadQuestions']) && $_GET['uploadQuestions'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Questions have been added successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['timeUpdate']) && $_GET['timeUpdate'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The constraints for the test has been changed successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['startString']) && $_GET['startString'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The start string for the test has been added successfully!!</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    if (isset($_GET['scoreRelease']) && $_GET['scoreRelease'] == true) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>The score is now being displayed</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>';
    }
    ?>
    <?php
    $recent_sql = "SELECT * FROM `test` WHERE `test_id`='$test_id'";
    $recent_result = mysqli_query($conn, $recent_sql);
    $recentRow = mysqli_fetch_assoc($recent_result);
    $startTime = $recentRow['time'];
    $questionsEach = $recentRow['questionsforeach'];
    $timeforeach = $recentRow['timeforeach'];
    $timeEnd = $recentRow['heldtill'];
    $startString = $recentRow['startString'];
    ?>
    <div class="container startString_container my-2" style="display: none;width:30%;">
        <h4>Set Authentication String:</h4>
        <?php
        if ($startString != null) {
            echo '<ul><li><h6 class="text-secondary">Current: <b>' . $startString . '</b></h6></li></ul>';
        }
        ?>

        <div class="container p-1">
            <form action="startString.php" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" name="startString" placeholder="Enter the Start String">
                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                </div>
                <button type="submit" class="btn btn-outline-success my-2">Submit</button>
            </form>
        </div>
    </div>
    <div class="editQuestions_container container" style="display:none;">
        <div class="container my-2 p-1 ">
            <ul>
                <li>
                    <h4>Add Questions:</h4>
                </li>
            </ul>
            <div class="changethequestions_box p-2">
                <ul>
                    <li>
                        <h6>Add Questions Individually:</h6>
                    </li>
                </ul>
                <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> Give three spaces
                    for a line break.</span>
                <div class="container my-2">
                    <form id="question-form" action="uploadQuestions.php" method="post">
                        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                        <div id="questions">
                        </div>
                        <button type="button" class="btn btn-primary m-2" id="add-question">Add Question</button>
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                    </form>
                </div>
                <ul>
                    <li>
                        <h6>Add questions via CSV file:</h6>
                    </li>
                </ul>
                <span class="fw-bold fst-italic">Note: </span><span class="fst-italic text-secondary">If the question or
                    answer has " , " please enclose the question/answer in "".</span>
                <div class="container my-2">
                    <form id="question-form" action="uploadQuestions3.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="test_id" value="<?php echo $_GET['test_id']; ?>">
                        <div id="questions">
                        </div>
                        <input type="file" name="csv_file" accept=".csv" required>
                        <button type="submit" class="btn btn-success m-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="container my-2">
            <form action="deleteQuestions.php?test_id=<?php echo $test_id; ?>" method="post">
                <ul>
                    <li>
                        <h4>Present Questions:</h4>
                    </li>
                </ul>
                <table class="table my-2 table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th scope="col">Sno</th>
                            <th scope="col">Question</th>
                            <th scope="col">Options</th>
                            <th scope="col">Answer</th>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="" id="selectAll">
                                    <label class="form-check-label" for="flexCheckDefault">
                                        Delete
                                    </label>
                                </div>
                                <!-- <input type="checkbox" id="selectAll"><span>Delete</span> -->
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 1;
                        $sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
                        $result = mysqli_query($conn, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $questionId = $row['question_id'];
                            $question = $row['question'];
                            $optionsJSON = $row['options'];
                            $options = json_decode($optionsJSON, true);
                            $answer = $row['answer'];
                            echo "<tr>
                        <th scope='row'>$count</th>
                        <td>$question</td>
                        <td>";
                            $countOption = 1;
                            foreach ($options as $option) {
                                echo "$countOption. $option<br>";
                                $countOption += 1;
                            }

                            echo "</td>
                        <td>$answer</td>
                        <td><input type='checkbox' name='delete[]' value='$questionId' class='form-check-input'></td>
                        </tr>";
                            $count += 1;
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-outline-danger my-2 me-2" name="deleteSelected">Delete
                    Selected</button>
            </form>
        </div>
    </div>
    <div class="setTime_container container p-1 my-2" style="display:none;width:30%">
        <form action="setTime.php" method="post">
            <div class="mb-3">
                <label for="startTime" class="form-label">Time To Start:*</label>
                <input type="datetime-local" class="form-control" id="startTime" required name="startTime"
                    placeholder="<?php echo $startTime; ?>">
            </div>
            <div class="mb-3">
                <label for="numberofQuestions" class="form-label">Number of Questions:*</label>
                <input type="number" placeholder="<?php echo $questionsEach; ?>" class="form-control"
                    id="numberofQuestions" required name="numberofQuestions">
            </div>
            <div class="mb-3">
                <label for="timeforeach" class="form-label">Time for each question(in seconds):*</label>
                <input type="number" class="form-control" placeholder="<?php echo $timeforeach; ?>" id="timeforeach"
                    required name="timeforeach">
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">Time To End:*</label>
                <input type="datetime-local" class="form-control" id="endTime" placeholder="<?php echo $timeEnd; ?>"
                    required name="endTime">
                <input type="hidden" name="test_id" value=<?php echo $test_id; ?>>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    <div class="container users_container my-2 p-1" style="display:none;">
        <nav class="navbar">
            <form class="container-fluid justify-content-start">
                <div class="d-flex">
                    <button class="btn btn-outline-success me-2" type="button" id="exportExcel">Export Excel
                        Sheet</button>
                    <button class="btn btn-outline-success me-2" type="button" id="scoreRelease" data-bs-toggle="modal"
                        data-bs-target="#exampleModal">Release Score</button>
                </div>
            </form>
        </nav>
        <!-- Score Release Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Release Score for this quiz:</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- <ul><li><h4>Choose when to release the score:</h4></li></ul>
                        <div class="container m-1">
                            <ul><li><h6>Set when to release:</h6></li></ul>
                            <form method="post" action="scoreReleaseDate.php">
                                <div class="mb-3">
                                    <input type="datetime-local" class="form-control" name="dateRealease">
                                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                                </div>
                            </form>
                        </div> -->
                        <div class="container m-1">
                            <ul>
                                <li>
                                    <h6>Release Now:</h6>
                                </li>
                            </ul>
                            <form action="scoreReleaseNow.php" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="test_id" value="<?php echo $test_id; ?>">
                                    <button class="btn btn-outline-success">Release Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="container my-2" style="width:50%;height:50%;">
            <canvas id="myChart"></canvas>
        </div>
        <div class="container">
            <form action="allowRestart.php?test_id=<?php echo $test_id ?>" method="post">
                <table class="table my-2 table-hover" id="attendedUserTable">
                    <thead>
                        <tr>
                            <th scope="col">S.no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Enrollment</th>
                            <th scope="col">Score</th>
                            <th scope="col">
                                <div class="form-check">
                                    <input class="form-check-input" id="attemptedAll" type="checkbox" value="">
                                    <label for="attemptedAll" class="form-check-label">Restart</label>
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../../_dbconnect.php';
                        $dataArray = array();
                        $pic = null;
                        $countUser = 1;
                        $count = 0;
                        $user_sql = "SELECT * FROM users WHERE test_array LIKE '%\"$test_id\"%'";
                        $user_result = mysqli_query($conn, $user_sql);
                        while ($rowUser = mysqli_fetch_assoc($user_result)) {
                            $count = $count + 1;
                            $user_id = $rowUser['user_id'];
                            $score_sql = "SELECT * FROM `testscores` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
                            $score_result = mysqli_query($conn, $score_sql);
                            $scoreRow = mysqli_fetch_assoc($score_result);
                            $score = $scoreRow['score'];
                            $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
                            $email = $rowUser['email'];
                            $enrollment = $rowUser['enrollment'];
                            $userData = array(
                                "user_id" => $user_id,
                                "name" => $name,
                                "score" => $score,
                                "email" => $email,
                                "enrollment" => $enrollment
                            );
                            $dataArray[] = $userData;
                            $highestScore = 0;
                            $lowestScore = PHP_INT_MAX;
                            $totalScore = 0;
                            $scoreCount = count($dataArray);
                            $highestScoringUsers = [];
                            $lowestScoringUsers = [];
                            $averageScoringUsers = [];
                            foreach ($dataArray as $userData) {
                                $score = $userData['score'];
                                $totalScore += $score;
                                $averageScore = $scoreCount > 0 ? $totalScore / $scoreCount : 0;
                                $averageScore=ceil($averageScore);
                                if ($score > $highestScore) {
                                    $highestScore = $score;
                                }

                                if ($score < $lowestScore) {
                                    $lowestScore = $score;
                                }
                                if ($score === $highestScore) {
                                    $highestScoringUsers[] = $userData['name'];
                                } elseif ($score === $lowestScore) {
                                    $lowestScoringUsers[] = $userData['name'];
                                } elseif ($score === $averageScore) {
                                    $averageScoringUsers[] = $userData['name'];
                                }
                            }
                            echo '<tr>
                <th scope="row">' . $countUser . '</th>
                <td>' . $name . '</td>
                <td>' . $email . '</td>
                <td>' . $enrollment . '</td>
                <td>' . $score . '</td>
                <td><input type="checkbox" name="allowRestart[]" value="' . $user_id . '" class="form-check-input"></td>
                </tr>';
                            $countUser = $countUser + 1;
                        }
                        if ($count == 0) {
                            echo '<div class="card">
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>No one has attempted the quiz yet.</p>
                    <footer class="blockquote-footer"><cite title="Source Title">The Social Knowledge</cite></footer>
                  </blockquote>
                </div>
              </div>';
                        }
                        ?>
                    </tbody>
                </table>
                <button type="submit" name="allowRestart_btn" class="btn btn-outline-success my-2">
                    Allow Restart
                </button>
            </form>
        </div>
    </div>
    <div class="container setUsers_container my-2 p-1" style="display:none;">
        <form id="filter-form">
            <div class="row">
                <div class="form-group col" style="width:40%;">
                    <label for="year" class="form-label"><b>Year:</b></label>
                    <select class="form-control" id="year" name="year">
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                    </select>
                </div>
                <div class="form-group col" style="width:40%;">
                    <label for="batch" class="form-label"><b>Batch:</b></label>
                    <select class="form-control" id="batch" name="batch">
                        <option value="b1">b1</option>
                        <option value="b2">b2</option>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-success my-2" style="width: 10%;">Filter</button>
        </form>
        <form action="userForTest.php?test_id=<?php echo $test_id; ?>" method="post">
            <table class="table my-2 table-hover">
                <thead>
                    <tr>
                        <th scope="col">Sno</th>
                        <th scope="col">Email</th>
                        <th scope="col">Enrollment</th>
                        <th scope="col">
                            <div class="form-check">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Select
                                </label>
                                <input class="form-check-input" type="checkbox" value="" id="allowAll">
                            </div>
                        </th>
                    </tr>
                </thead>
                <tbody id="user-list">
                </tbody>
            </table>
            <button type="submit" class="btn btn-outline-success my-2 me-2" name="allowSelected">Allow Selected</button>
    </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#filter-form').submit(function (e) {
                e.preventDefault();
                var year = $('#year').val();
                var batch = $('#batch').val();
                $.ajax({
                    type: 'POST',
                    url: 'filter-users.php',
                    data: { year: year, batch: batch },
                    success: function (response) {
                        $('#user-list').html(response);
                    }
                });
            });
        });
    </script>
    <script>
        const ctx = document.querySelector("#myChart");
        const highestScore = <?php echo $highestScore; ?>;
        const lowestScore = <?php echo $lowestScore; ?>;
        const averageScore = <?php echo $averageScore; ?>;
        const highestScoringUsers = <?php echo json_encode($highestScoringUsers); ?>;
        const lowestScoringUsers = <?php echo json_encode($lowestScoringUsers); ?>;
        const averageScoringUsers = <?php echo json_encode($averageScoringUsers); ?>;
        console.log(highestScoringUsers);
        console.log(averageScoringUsers);
        console.log(lowestScoringUsers);

        function getTooltipText(context) {
            const datasetIndex = context.datasetIndex;
            switch (datasetIndex) {
                case 0:
                    return "Score:"+highestScore+" Users with Highest Marks: " + highestScoringUsers.join(', ');
                case 1:
                    return "Score:"+averageScore+" Users with Average Marks: " + averageScoringUsers.join(', ');
                case 2:
                    return "Score:"+lowestScore+" Users with Lowest Marks: " + lowestScoringUsers.join(', ');
                default:
                    return '';
            }
        }

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Score'],
                datasets: [
                    {
                        label: 'Highest',
                        data: [highestScore],
                        borderWidth: 1,
                        backgroundColor: '#7FFF00'
                    },
                    {
                        label: 'Average',
                        data: [averageScore],
                        borderWidth: 1,
                        backgroundColor: '#F0E68C'
                    },
                    {
                        label: 'Lowest',
                        data: [lowestScore],
                        borderWidth: 1,
                        backgroundColor: '#FF0000'
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function (context) {
                                return getTooltipText(context);
                            }
                        }
                    }
                }
            }
        });


    </script>

    <script src="../../xlsx/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById("exportExcel").addEventListener("click", function () {
            const data = [
                ["User ID", "Name", "Email", "Score", "Enrollment Number"]
            ];
            <?php
            foreach ($dataArray as $userData) {
                echo "data.push(['" . $userData['user_id'] . "', '" . $userData['name'] . "', '" . $userData['email'] . "', '" . $userData['score'] . "','" . $userData['enrollment'] . "']);\n";
            }
            ?>
            const workbook = XLSX.utils.book_new();
            const worksheet = XLSX.utils.aoa_to_sheet(data);
            XLSX.utils.book_append_sheet(workbook, worksheet, "UserData");
            const arrayBuffer = XLSX.write(workbook, { bookType: "xlsx", type: "array" });
            const blob = new Blob([arrayBuffer], { type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" });
            const url = window.URL.createObjectURL(blob);
            const a = document.createElement("a");
            a.href = url;
            a.download = "user_data.xlsx";
            a.click();
            window.URL.revokeObjectURL(url);
        });
    </script>
    <script>
        const editQuestions_container = document.querySelector(".editQuestions_container");
        const editQuestions_btn = document.querySelector("#editQuestions_btn");
        const setTime_container = document.querySelector(".setTime_container");
        const setTime_btn = document.querySelector("#setTime_btn");
        const user_btn = document.querySelector("#users_btn");
        const users_container = document.querySelector(".users_container");
        const startString_btn = document.querySelector("#setString");
        const startString_container = document.querySelector(".startString_container");
        const setUsers_container = document.querySelector(".setUsers_container");
        const setUsers_btn = document.querySelector("#setUsers_btn");
        editQuestions_btn.onclick = () => {
            editQuestions_container.style.display = "block";
            setTime_container.style.display = "none";
            users_container.style.display = "none";
            startString_container.style.display = "none";
            setUsers_container.style.display = "none";
        }
        setTime_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "block";
            users_container.style.display = "none";
            startString_container.style.display = "none";
            setUsers_container.style.display = "none";
        }
        users_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "none";
            users_container.style.display = "block";
            startString_container.style.display = "none";
            setUsers_container.style.display = "none";
        }
        startString_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "none";
            users_container.style.display = "none";
            startString_container.style.display = "block";
            setUsers_container.style.display = "none";
        }
        setUsers_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "none";
            users_container.style.display = "none";
            startString_container.style.display = "none";
            setUsers_container.style.display = "block";
        }
        document.getElementById("selectAll").addEventListener("change", function () {
            const checkboxes = document.querySelectorAll("input[name='delete[]']");
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
        document.getElementById("allowAll").addEventListener("change", function () {
            const checkboxes = document.querySelectorAll("input[name='selectedUser[]']");
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
        document.getElementById("attemptedAll").addEventListener("change", function () {
            const checkboxes = document.querySelectorAll("input[name='allowRestart[]']");
            checkboxes.forEach((checkbox) => {
                checkbox.checked = this.checked;
            });
        });
    </script>
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const addQuestionButton = document.getElementById("add-question");
            const questionsContainer = document.getElementById("questions");
            let questionCount = -1;

            addQuestionButton.addEventListener("click", function () {
                questionCount++;
                const questionDiv = document.createElement("div");
                questionDiv.classList.add("question");
                questionDiv.innerHTML = `
            <div class="row row-cols-2">
                <div class="col">
                    <label for="question-${questionCount}"><b>Question ${questionCount + 1}:</b></label>
                    <textarea id="question-${questionCount}" name="questions[]" class="form-control"></textarea>
                </div>
                <div class="col">
                    <label for="answer-${questionCount}"><b>Answer ${questionCount + 1}:</b></label>
                    <textarea class="form-control" id="answer-${questionCount}" name="answers[]"></textarea>
                </div>
            </div>
            <button type="button" class="btn m-2 btn-outline-danger remove-question">Remove</button>
            <div class="options row row-cols-2"></div>
            <button type="button" class="btn btn-outline-success add-option m-2">Add Option</button>`;
                questionsContainer.appendChild(questionDiv);

                const removeQuestionButton = questionDiv.querySelector(".remove-question");
                removeQuestionButton.addEventListener("click", function () {
                    questionsContainer.removeChild(questionDiv);
                });

                const optionsContainer = questionDiv.querySelector(".options");
                let optionCount = 0;

                questionDiv.querySelector(".add-option").addEventListener("click", function () {
                    const optionInput = document.createElement("textarea");
                    optionInput.setAttribute("class", "form-control m-2 col");
                    optionInput.setAttribute("style", "width:45%;");
                    optionInput.setAttribute("name", `options_${questionCount}[${optionCount}]`);
                    optionInput.setAttribute("placeholder", `Option ${optionCount + 1}`);
                    optionsContainer.appendChild(optionInput);
                    optionCount++;
                });
            });

            // Handle the CSV file upload
            const csvFileInput = document.querySelector("input[type='file']");
            csvFileInput.addEventListener("change", function () {
                // Clear the form and hide the "Add Question" button
                questionsContainer.innerHTML = "";
                addQuestionButton.style.display = "none";
            });
        });

        // Inside the event listener for CSV file upload
        addQuestionButton.style.display = "none"; // Hide "Add Question" button
        questionsContainer.innerHTML = ""; // Remove existing question/answer fields

        // Add a button to clear the form and add more questions
        const clearFormButton = document.createElement("button");
        clearFormButton.innerText = "Clear Form and Add More Questions";
        clearFormButton.className = "btn btn-primary m-2";
        clearFormButton.addEventListener("click", function () {
            questionsContainer.innerHTML = ""; // Clear the form
            addQuestionButton.style.display = "block"; // Show "Add Question" button
        });
        questionsContainer.appendChild(clearFormButton);
    </script>
</body>

</html>