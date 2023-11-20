<?php
session_start();
include '../../_dbconnect.php';
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $test_id = $_GET['testid'];
    $sql = "UPDATE `codingtest` SET `displayed` = '1' WHERE `codingtest`.`test_id` = '$test_id'";
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