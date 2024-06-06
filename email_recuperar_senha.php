use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
require 'vendor/autoload.php';

// Função para gerar uma senha temporária
function gerarSenhaTemporaria($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

// Gerar uma senha temporária
$senhaTemporaria = gerarSenhaTemporaria();

$mail = new PHPMailer(true);
try {
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Username = 'fc2e12edcd86f6';
    $mail->Password = 'bcbfb301e78b6d';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; 
    $mail->Port = 587;

    $mail->setFrom('no-reply@seudominio.com', 'Suporte');
    $mail->addAddress('usuario@dominio.com'); // Troque pelo e-mail do destinatário
    $mail->isHTML(true);
    $mail->Subject = 'Sua senha temporária';
    $mail->Charset = PHPMailer::CHARSET_UTF8;

    $mail->Body = '
    <html>
    <head>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px; }
            .header { font-size: 20px; font-weight: bold; color: #333; margin-bottom: 10px; }
            .content { font-size: 16px; color: #555; }
            .footer { margin-top: 20px; font-size: 14px; color: #777; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">Olá,</div>
            <div class="content">
                <p>Sua senha temporária é: <b>' . htmlspecialchars($senhaTemporaria) . '</b></p>
                <p>Por favor, altere sua senha assim que possível.</p>
            </div>
            <div class="footer">
                Atenciosamente,<br>
                Equipe de Suporte
            </div>
        </div>
    </body>
    </html>';

    $mail->AltBody = 'Olá,\n\nSua senha temporária é: ' . $senhaTemporaria . '\n\nPor favor, altere sua senha assim que possível.\n\nAtenciosamente,\nEquipe de Suporte';

    $mail->send();
    echo 'A mensagem foi enviada' . PHP_EOL;
} catch (Exception $error) {
    echo "A mensagem não pode ser enviada. Error: {$mail->ErrorInfo}";
}
?>
