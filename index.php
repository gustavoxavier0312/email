<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'fc2e12edcd86f6';
    $mail->Password = 'bcbfb301e78b6d';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Ajuste para STARTTLS, pois a porta 587 geralmente usa STARTTLS
    $mail->Port = 587;    

    $mail->setFrom('gabriel@gmail.com');
    $mail->addAddress('ellen@outlook.com');
    $mail->isHTML(true);
    $mail->Subject = 'Notas do segundo trimestre';
    $mail->Charset = PHPMailer::charset_UTF8;
    $mail->Body = htmlspecialchars('Parabéns, você foi <b>Aprovado</b>');
    $mail->AltBody = ('Parabéns, você foi aprovado');
    $mail->send();
    echo 'A mensagem foi enviada' . PHP_EOL;
} catch (Exception $error) {
    echo "A mensagem não pode ser enviada. Error: {$mail->ErrorInfo}";
}