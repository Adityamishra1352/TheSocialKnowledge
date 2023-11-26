<?php
session_start();
include '../_dbconnect.php';
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $code = $_POST["code"];
    $language = $_POST["language"];
    $user_id= $_SESSION["user_id"];
    $filename = "savedFiles/"."saved_code_" . time() . "_" . $_SESSION["user_id"] . "_" . $language .".". $language;
    $filepath = "answers/" . $filename;
    file_put_contents($filepath, $code);
    $savesql="INSERT INTO `savedFiles`(`filename`,`user_id`,`language`)VALUES('$filename','$user_id','$language')";
    $saveResult=mysqli_query($conn,$savesql);
    if($saveResult){
        echo "File saved successfully!";
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    die("Bad Request");
}
?>
