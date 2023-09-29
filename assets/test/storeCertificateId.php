<?php
include '../_dbconnect.php';
$data = json_decode(file_get_contents('php://input'), true);
$certificate_formatted = $data['certificate_formatted'];
$user_id = $data['user_id'];
$test_id = $data['test_id'];
// $answers=$data['answersString'];
$store_sql = "INSERT INTO `certificates` (`certificate_formating`, `user_id`, `test_id`) VALUES ('$certificate_formatted', '$user_id', '$test_id')";
$store_result = mysqli_query($conn, $store_sql);
if ($store_result) {
    $response = ['message' => 'Certificate ID received and stored successfully'];
    echo json_encode($response);
} else {
    $response = ['message' => 'Certificate ID missed and couldnot be stored'];
    echo json_encode($response);
}
// $answers_sql="INSERT INTO `answers`(`answer`,`user_id`,`test_id`)VALUES('$answers','$user_id','$test_id')";
// $answers_result=mysqli_query($conn,$answers_sql);
// if($answers_result){
//     $responseAnswer=['message'=>'Answers recieved and stored successfully'];
//     echo json_encode($responseAnswer);
// }
?>