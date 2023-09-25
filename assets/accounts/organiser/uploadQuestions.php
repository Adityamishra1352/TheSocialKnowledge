<?php
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$questions = [];
$test_id= $_POST['test_id'];
foreach ($_POST as $key => $value) {
    if (strpos($key, "question-") === 0) {
        $questionText = $value;
        $questionObj = [];
        $questionObj['question'] = $questionText;
        $questions[] = $questionObj;
        echo "hii";
    }
    if (strpos($key, "option-") === 0) {
        list(, $questionNum, $optionNum) = explode("-", $key);
        $options = $questions[$questionNum - 1]['options'] ?? [];
        $options[$optionNum] = $value;
        $questions[$questionNum - 1]['options'] = $options;
    }
    if (strpos($key, "answer-") === 0) {
        $answer = $value;
        $questions[count($questions) - 1]['answer'] = $answer;
    }
}
foreach ($questions as $questionData) {
    
    $questionText = $questionData['question'];
    $option1 = $questionData['options'][1] ?? null;
    $option2 = $questionData['options'][2] ?? null;
    $option3 = $questionData['options'][3] ?? null;
    $option4 = $questionData['options'][4] ?? null;
    $answer = $questionData['answer'];
    // echo $questionText;
    // echo $option1;
    // echo $option2;
    // echo $option3;
    // echo $option4;
    // echo $answer;
    $sql="INSERT INTO `questions` (`question`, `option1`, `option2`, `option3`, `option4`, `answer`,`test_id`) VALUES ('$questionText', '$option1', '$option2', '$option3', '$option4', '$answer', '$test_id')";
    $result=mysqli_query($conn,$sql); 
    if($result){
        header('location:organiser.php');
    }   
    else{
        echo mysqli_connect_error();
    }
}
}

?>
