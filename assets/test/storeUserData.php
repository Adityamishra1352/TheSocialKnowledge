<?php
include '../_dbconnect.php';
$inputJSON = file_get_contents('php://input');
$data = json_decode($inputJSON);

if ($data && isset($data->userScore)) {
    $userScore = $data->userScore;
    $user_id=$data->user_id;
    $test_id=$data->test_id;
    $sql="INSERT INTO `testscores`(`score`,`test_id`,`user_id`)VALUES('$userScore','$test_id','$user_id')";
    $result=mysqli_query($conn,$sql);
    if($result){
        echo json_encode(["message" => "Score stored successfully"]);
    }
    else{
        echo json_encode(["error" => "Score was not stored"]);
    }
} else {
    echo json_encode(["error" => "Invalid data"]);
}
?>
