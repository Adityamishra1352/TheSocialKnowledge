<?php
session_start();

if (isset($_SESSION['timeLeft'])) {
    unset($_SESSION['timeLeft']);
    unset($_SESSION['startTime']);
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false]);
}
?>
