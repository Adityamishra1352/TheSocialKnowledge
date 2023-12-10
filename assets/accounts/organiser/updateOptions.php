<?php
include '../../_dbconnect.php';
if (isset($_POST['updateOptions'])) {
    $questionId = $_POST['question_id'];
    $test_id=$_POST['test_id'];
    $editedQuestion = $_POST['editedQuestion'];
    $editedOptions = $_POST['editedOptions'];
    $editedAnswer = $_POST['editedAnswer'];
    $optionsArray = explode("\n", $editedOptions);
    $optionsArray = array_map('trim', $optionsArray);
    $optionsArray = array_filter($optionsArray);
    $editedOptionsJSON = json_encode($optionsArray);
    echo $editedOptionsJSON;
    $sql = "UPDATE `questions` SET `question`='$editedQuestion', `options`='$editedOptionsJSON', `answer`='$editedAnswer' WHERE `question_id`='$questionId'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header('location:addQuestions.php?test_id=' . $test_id . '&editQuestion=true');
    } else {
        echo "Error updating options: " . mysqli_error($conn);
    }
}
?>
