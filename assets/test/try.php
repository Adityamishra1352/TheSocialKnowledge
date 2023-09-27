<?php
session_start();
include '../_dbconnect.php';

// Initialize variables
$test_id = $_GET['testid'];
$questions_sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
$result = mysqli_query($conn, $questions_sql);
$questionsArray = array();
$questionIndex = 0; // To keep track of the current question index
$userAnswer_array=array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['answer'])) {
        $userAnswer = $_POST['answer'];
        $userAnswer_array=array(
            $questionIndex,
            $userAnswer
        );
        $questionIndex++;
    }
}
if ($rowQuestion = mysqli_fetch_assoc($result)) {
    $question = $rowQuestion['question'];
    $answer = $rowQuestion['answer'];
    $options = array(
        $rowQuestion['option1'],
        $rowQuestion['option2'],
        $rowQuestion['option3'],
        $rowQuestion['option4']
    );
} else {
    echo "All questions have been answered.";
}
echo var_dump($userAnswer_array);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz</title>
</head>
<body>
    <form method="POST" action="">
        <h1>Question <?php echo $questionIndex + 1; ?></h1>
        <p><?php echo $question; ?></p>
        <ul>
            <?php foreach ($options as $option) : ?>
                <li>
                    <label>
                        <input type="radio" name="answer" value="<?php echo $option; ?>"><?php echo $option; ?>
                    </label>
                </li>
            <?php endforeach; ?>
        </ul>
        <button>Submit</button>
    </form>
    <script>
        // Timer for 30 seconds
        setTimeout(function () {
            document.querySelector('form').submit();
        }, 30000);
    </script>
</body>
</html>
