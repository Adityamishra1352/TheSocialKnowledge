<?php
session_start();

if (isset($_POST['timeLeft'])) {
    $_SESSION['startTime'] = $_POST['timeLeft'];
}
?>
