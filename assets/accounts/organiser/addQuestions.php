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
            <button class="btn btn-outline-success me-2" type="button" id="setTime_btn">Edit Features</button>
            <button class="btn btn-outline-success me-2" type="button" id="editQuestions_btn">Edit/Add
                Questions</button>
            <button class="btn btn-outline-success me-2" type="button" id="users_btn">Completed Test Users</button>
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
    ?>
    <div class="editQuestions_container container" style="display:none;">
        <div class="container my-2 p-1 ">
            <ul>
                <li>
                    <h4>Add Questions:</h4>
                </li>
            </ul>
            <div class="changethequestions_box p-2">
            <span class="fw-bold fst-italic">Note:</span><span class="fst-italic text-secondary"> Give three spaces for a line break.</span>
                <div id="questions-form">
                    <label for="num-questions" id="noofquestionslabel">How many questions do you want to
                        input?(Please enter 5 questions at once)</label><br><br>
                    <input type="number" id="num-questions" name="num-questions" min="1" max="25" required
                        style="width: 20%;" class="p-1 form-control"><br><br>
                    <button type="submit" id="questionsSubmit" class="btn btn-primary mb-2">Submit</button><br>
                </div>
                <form action="uploadQuestions.php" method="post" id="questionsDynamic">
                    <div class="inputQuestions"></div>
                    <input type="hidden" name="test_id" value="<?php echo $test_id ?>">
                    <button id="addquestion" class="btn btn-outline-success my-2">Add Question</button>
                </form>
            </div>
        </div>
        <div class="container my-2">
            <ul>
                <li>
                    <h4>Present Questions:</h4>
                </li>
            </ul>
            <table class="table my-2 table-hover" id="mytable">
                <thead>
                    <tr>
                        <th scope="col">Question ID</th>
                        <th scope="col">Question</th>
                        <th scope="col">Answer</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        $questionId = $row['question_id'];
                        $question = $row['question'];
                        $optionsJSON = $row['options'];
                        $options = json_decode($optionsJSON, true);
                        $answer = $row['answer'];
                        echo "<tr>
        <th scope='row'>$questionId</th>
        <td>$question</td>
        <td>" . $row['answer'] . "</td>
        <td><button class='delete btn btn-sm btn-outline-danger' id='d$questionId' onclick='window.location.href=`deleteQuestions.php?question_id=$questionId&test_id=$test_id`'>Delete</button></td>
    </tr>";
                    }
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <div class="setTime_container container p-1 my-2" style="display:none;width:30%">
        <form action="setTime.php" method="post">
            <div class="mb-3">
                <label for="startTime" class="form-label">Time To Start:*</label>
                <input type="datetime-local" class="form-control" id="startTime" required name="startTime">
            </div>
            <div class="mb-3">
                <label for="numberofQuestions" class="form-label">Number of Questions:*</label>
                <input type="number" class="form-control" id="numberofQuestions" required name="numberofQuestions">
            </div>
            <div class="mb-3">
                <label for="timeforeach" class="form-label">Time for each question(in seconds):*</label>
                <input type="number" class="form-control" id="timeforeach" required name="timeforeach">
            </div>
            <div class="mb-3">
                <label for="endTime" class="form-label">Time To End:*</label>
                <input type="datetime-local" class="form-control" id="endTime" required name="endTime">
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
                </div>
            </form>
        </nav>
        <div class="container" style="display:grid;grid-template-columns:1fr 1fr 1fr;">
            <?php
            include '../../_dbconnect.php';
            $dataArray = array();
            $pic = null;
            $count=0;
            $user_sql = "SELECT * FROM users WHERE test_array LIKE '%\"$test_id\"%'";
            $user_result = mysqli_query($conn, $user_sql);
            while ($rowUser = mysqli_fetch_assoc($user_result)) {
                $count=$count+1;
                $user_id = $rowUser['user_id'];
                $score_sql = "SELECT * FROM `testscores` WHERE `user_id`='$user_id' AND `test_id`='$test_id'";
                $score_result = mysqli_query($conn, $score_sql);
                $scoreRow = mysqli_fetch_assoc($score_result);
                $score = $scoreRow['score'];
                $name = $rowUser['fname'] . ' ' . $rowUser['lname'];
                $email = $rowUser['email'];
                $enrollment=$rowUser['enrollment'];
                $userData = array(
                    "user_id" => $user_id,
                    "name" => $name,
                    "score" => $score,
                    "email" => $email,
                    "enrollment"=>$enrollment
                );
                $dataArray[] = $userData;
                echo '<div class="card" style="width: max-content;">
            <div class="card-body">
              <h5 class="card-title">Name: ' . $name . '</h5>
              <p class="text-secondary">Email: ' . $email . '</p>
              <p class="text-secondary">Enroll No. : ' . $enrollment . '</p>
              <p class="card-text">Score: ' . $score . '</p>
              <a class="btn btn-outline-success" href="allowRestart.php?user_id='.$user_id.'&test_id='.$test_id.'">Allow Restart</a>
            </div>
          </div>';
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
        </div>
    </div>
    <script src="../../xlsx/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById("exportExcel").addEventListener("click", function () {
    const data = [
        ["User ID", "Name", "Email", "Score", "Enrollment Number"]
    ];
    <?php
    foreach ($dataArray as $userData) {
        echo "data.push(['" . $userData['user_id'] . "', '" . $userData['name'] . "', '" . $userData['email'] . "', '" . $userData['score'] . "','".$userData['enrollment']."']);\n";
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
        editQuestions_btn.onclick = () => {
            editQuestions_container.style.display = "block";
            setTime_container.style.display = "none";
            users_container.style.display = "none";
        }
        setTime_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "block";
            users_container.style.display = "none";
        }
        users_btn.onclick = () => {
            editQuestions_container.style.display = "none";
            setTime_container.style.display = "none";
            users_container.style.display = "block";
        }
    </script>
    <script src="../../bootstrap-5.3.2-dist/js/bootstrap.min.js"></script>
    <script>
        const add_btn = document.querySelector("#questionsSubmit");
        const form = document.querySelector(".inputQuestions");
        add_btn.onclick = (e) => {
            e.preventDefault();
            const numQuestions = document.getElementById("num-questions").value;
            const questionsContainer = document.createElement("div");
            const lineBreak = document.createElement("br");
            for (let i = 1; i <= numQuestions; i++) {
                const questionContainer = document.createElement("div");
                const questionLabel = document.createElement("label");
                const questionInput = document.createElement("textarea");
                questionInput.className = "my-2 p-1 form-control";
                questionInput.name = `question-${i}`;
                questionInput.placeholder = `Question ${i}`;
                questionLabel.appendChild(questionInput);
                questionContainer.appendChild(questionLabel);
                const numOptions = document.createElement("input");
                numOptions.type = "number";
                numOptions.min = "2";
                numOptions.max = "4";
                numOptions.required = true;
                numOptions.style="width:10%;";
                numOptions.value = "2";
                numOptions.className = "p-1 form-control";
                numOptions.name = `num-options-${i}`;
                const optionsLabel = document.createElement("label");
                optionsLabel.textContent = "Number of Options:";
                optionsLabel.style="display:block;";
                optionsLabel.appendChild(numOptions);
                questionContainer.appendChild(optionsLabel);

                const optionsContainer = document.createElement("div");
                optionsContainer.classList.add("options-container");
                // questionContainer.appendChild(lineBreak);
                questionContainer.appendChild(optionsContainer);

                numOptions.addEventListener("change", () => {
                    const num = parseInt(numOptions.value);
                    optionsContainer.innerHTML = "";
                    for (let j = 1; j <= num; j++) {
                        const optionInput = document.createElement("textarea");
                        optionInput.className = "p-1 form-control m-1";
                        optionInput.style="width:50%";
                        optionInput.name = `option-${i}-${j}`;
                        optionInput.placeholder = `Option ${j}`;
                        optionsContainer.appendChild(optionInput);
                    }
                });

                const answerContainer = document.createElement("div");
                const answerLabel = document.createElement("label");
                const answerInput = document.createElement("textarea");
                answerInput.className = "p-1 form-control";
                answerInput.name = `answer-${i}`;
                answerInput.placeholder = `Answer ${i}`;
                answerLabel.appendChild(answerInput);
                answerContainer.appendChild(answerLabel);
                questionContainer.appendChild(answerContainer);

                questionsContainer.appendChild(questionContainer);
            }

            form.appendChild(questionsContainer);
            document.getElementById("questionsSubmit").disabled = true;
        }
    </script>
</body>

</html>