<?php
session_start();
include '../../_dbconnect.php';
if (!(isset($_SESSION['organiser']) && $_SESSION['organiser'] === true) &&
    !(isset($_SESSION['admin']) && $_SESSION['admin'] === true)) {
    header('location: ../../403.php');
}
$test_id = $_GET['testid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Social Knowledge: Organiser</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="shortcut icon" href="../../images/websitelogo.jpg" type="image/png">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
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
                </ul>
                <ul class="d-flex">
                    <button class="btn btn-outline-danger me-2"
                        onclick="window.location.href=(`../logout.php`)">Logout</button>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container my-2 p-1">
        <ul>
            <li>
                <h4>Add Questions:</h4>
            </li>
        </ul>
        <div class="changethequestions_box p-2">
            <div id="questions-form">
                <label for="num-questions" id="noofquestionslabel">How many questions do you want to
                    input?</label><br><br>
                <input type="number" id="num-questions" name="num-questions" min="1" max="25" required
                    style="width: 20%;" class="p-1"><br><br>
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
        <table class="table my-2" id="mytable">
            <thead>
                <tr>
                    <th scope="col">Question ID</th>
                    <th scope="col">Question</th>
                    <th scope="col">Option1</th>
                    <th scope="col">Option2</th>
                    <th scope="col">Option3</th>
                    <th scope="col">Option4</th>
                    <th scope="col">Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $sql="SELECT * FROM `questions` WHERE `test_id`='$test_id'";
                $result=mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>
                    <th scope='row'>".$row['question_id']."</th>
                    <td>".$row['question']."</td>
                    <td>".$row['option1']."</td>
                    <td>".$row['option2']."</td>
                    <td>".$row['option3']."</td>
                    <td>".$row['option4']."</td>
                    <td>".$row['answer']."</td>
                    <td><button class='delete btn btn-sm btn-outline-danger' id=d".$row['question_id']." onclick='window.location.href=(`deleteQuestions.php?question_id=".$row['question_id']."&test_id=".$test_id."`)'>Delete</button></td>
                  </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"
        integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
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
                const questionInput = document.createElement("input");
                questionInput.type = "text";
                questionInput.className = "my-2 mr-2 p-1";
                questionInput.name = `question-${i}`;
                questionInput.placeholder = `Question ${i}`;
                questionLabel.appendChild(questionInput);
                questionContainer.appendChild(questionLabel);
                const numOptions = document.createElement("input");
                numOptions.type = "number";
                numOptions.min = "2";
                numOptions.max = "6";
                numOptions.required = true;
                numOptions.value = "2";
                numOptions.className = "p-1";
                numOptions.name = `num-options-${i}`;
                const optionsLabel = document.createElement("label");
                optionsLabel.textContent = "Number of Options:";
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
                        const optionInput = document.createElement("input");
                        optionInput.type = "text";
                        optionInput.className = "p-1";
                        optionInput.name = `option-${i}-${j}`;
                        optionInput.placeholder = `Option ${j}`;
                        optionsContainer.appendChild(optionInput);
                    }
                });

                const answerContainer = document.createElement("div"); // create answer container
                const answerLabel = document.createElement("label");
                const answerInput = document.createElement("input");
                answerInput.type = "text";
                answerInput.className = "p-1";
                answerInput.name = `answer-${i}`;
                answerInput.placeholder = `Answer ${i}`;
                answerLabel.appendChild(answerInput);
                answerContainer.appendChild(answerLabel);
                questionContainer.appendChild(answerContainer); // append answer container to question container

                questionsContainer.appendChild(questionContainer);
            }

            form.appendChild(questionsContainer);
            document.getElementById("questionsSubmit").disabled = true;
        }
        let table = new DataTable('#myTable');
    </script>
</body>

</html>