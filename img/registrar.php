<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';  // Asegúrate de que la ruta es correcta y que PHPMailer está instalado

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = htmlspecialchars($_POST['nombre']);
    $apellido = htmlspecialchars($_POST['apellido']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor SMTP
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'tu-email@gmail.com';
        $mail->Password = 'tu-contraseña';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configuración del correo
        $mail->setFrom('tu-email@gmail.com', 'Registro de Usuario');
        $mail->addAddress('miguelalfaro@hotmail.es');  // Destinatario

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = 'Nuevo registro de usuario';
        $mail->Body    = "
        <html>
        <head>
          <title>Nuevo registro de usuario</title>
        </head>
        <body>
          <h2>Detalles del nuevo usuario:</h2>
          <p><strong>Nombre:</strong> $nombre</p>
          <p><strong>Apellido:</strong> $apellido</p>
          <p><strong>Email:</strong> $email</p>
        </body>
        </html>
        ";

        $mail->send();
        echo 'Registro exitoso. Se ha enviado un correo de notificación.';
    } catch (Exception $e) {
        echo "Hubo un problema al enviar el correo. Error: {$mail->ErrorInfo}";
    }
}
?>
