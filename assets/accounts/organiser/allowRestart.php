<?php 
include '../../_dbconnect.php';
if($_SERVER['REQUEST_METHOD']=="GET"){
    $user_id=$_GET['user_id'];
    $test_id=$_GET['test_id'];
    $sql = "SELECT test_array FROM users WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $test_array = json_decode($row['test_array'], true);

    if (is_array($test_array)) {
        $key = array_search($test_id, $test_array);
        if ($key !== false) {
            unset($test_array[$key]);
        }
        $updated_test_array = json_encode(array_values($test_array));
        $update_sql = "UPDATE users SET test_array = ? WHERE user_id = $user_id";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("s", $updated_test_array);

        if ($stmt->execute()) {
            $scoreDelete_sql="DELETE FROM `testscores` WHERE `testscores`.`user_id` = '$user_id' AND `testscores`.`test_id`='$test_id'";
            $scoreDelete_result=mysqli_query($conn,$scoreDelete_sql);
            header('location:organiser.php?allowRestart=true');
        } else {
            echo "Error updating test_array: " . mysqli_error($conn);
        }
    } else {
        echo "Invalid test_array data.";
    }
} else {
    echo "Error fetching test_array: " . mysqli_error($conn);
}
mysqli_close($conn);
}
?>
