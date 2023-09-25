<?php
session_start();
include '../../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $test_id = $_GET['test_id'];
    $sql = "UPDATE `test` SET `displayed` = '0' WHERE `test`.`test_id` = '$test_id'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (isset($_SESSION['admin']) && $_SESSION['admin'] == true) {
            header('location:../admin/admin.php');
        } elseif (isset($_SESSION['organiser']) && $_SESSION['organiser'] == true) {
            header('location:organiser.php');
        }
    }
}
?>