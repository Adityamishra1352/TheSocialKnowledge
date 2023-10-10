<?php
session_start();
include '../_dbconnect.php';

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $data = json_decode(file_get_contents("php://input"));
    $updatedArray = $data->updatedArray;
    $user_id = $data->user_id;

    $update_sql = "UPDATE `users` SET `test_array` = '$updatedArray' WHERE `user_id` = '$user_id'";
    $updateresult = mysqli_query($conn, $update_sql);

    if ($updateresult) {
        echo json_encode(["message" => "Test array updated successfully"]);
    } else {
        echo json_encode(["error" => "Failed to update test array"]);
    }
}
?>
