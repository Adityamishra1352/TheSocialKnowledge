<?php
session_start();

if (isset($_POST['timeLeft'])) {
    $_SESSION['timeLeft'] = max(0, intval($_POST['timeLeft']));
}
?>
