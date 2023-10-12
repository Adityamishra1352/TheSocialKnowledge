<?php 
include '../_dbconnect.php';
$test_id = $_GET['testid'];
$questions_sql = "SELECT * FROM `questions` WHERE `test_id`='$test_id'";
$result = mysqli_query($conn, $questions_sql);

$questionsData = array();

while ($row = mysqli_fetch_assoc($result)) {
    $question = array(
        'question_text' => $row['question'],
        'options' => array(),
        'correct_answer' => $row['answer']
    );
    $optionsJSON = $row['options'];
    $options = json_decode($optionsJSON);
    
    // Check if options is an array and escape HTML entities
    if (is_array($options)) {
        $escapedOptions = array_map('htmlspecialchars', $options);
    } else {
        $escapedOptions = $options;
    }
    
    $question['options'] = $escapedOptions;
    $questionsData[] = $question;
}

$questionsDataJSON = json_encode($questionsData);
echo $questionsDataJSON;
?>
