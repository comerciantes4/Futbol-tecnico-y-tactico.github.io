<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = strip_tags(trim($_POST["nombre"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $mensaje = trim($_POST["mensaje"]);

    // Verifica que los campos no estén vacíos
    if (empty($nombre) || empty($mensaje) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Por favor, completa el formulario correctamente.";
        exit;
    }

    // Cambia este correo por el tuyo
    $destinatario = "tucorreo@ejemplo.com";
    $asunto = "Nuevo mensaje desde la web Fútbol Técnico y Táctico";

    $contenido = "Nombre: $nombre\n";
    $contenido .= "Correo: $email\n\n";
    $contenido .= "Mensaje:\n$mensaje\n";

    $cabeceras = "From: $nombre <$email>";

    if (mail($destinatario, $asunto, $contenido, $cabeceras)) {
        echo "¡Mensaje enviado con éxito!";
    } else {
        echo "Hubo un error al enviar tu mensaje. Intenta de nuevo.";
    }
}

header("Location: gracias.html");
exit;
?>
