<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

if (isset($_POST['send'])) {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'socialknowledge38@gmail.com';
    $mail->Password = 'imcdramgpiuaswii';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('socialknowledge38@gmail.com');
}
?>