<?php 
include '../../_dbconnect.php';
if(isset($_POST['allowSelected'])){
    if(isset($_POST['selectedUser'])&& is_array($_POST['selectedUser'])){
        $usersAllowed=$_POST['selectedUser'];
        $test_id=$_GET['test_id'];
        $usersAllowedJSON = json_encode($usersAllowed);
        $updateSql = "UPDATE `test` SET `userfortest` = '$usersAllowedJSON'  WHERE `test_id` = '$test_id'";
        $updateSql_result=mysqli_query($conn,$updateSql);
        if ($updateSql_result) {
            header('location:addQuestions.php?test_id='.$test_id.'&addUsers=true');
        }
    }
}
?>