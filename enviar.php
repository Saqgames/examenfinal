<?php
// Verificamos si los datos fueron enviados por el método POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Recoger los datos del formulario
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];
    $email = $_POST['email'];
    $tipoweb = $_POST['tipoweb'];
    $mensaje = $_POST['mensaje'];

    // Validación básica para asegurarnos de que los campos no están vacíos
    if (empty($nombre) || empty($telefono) || empty($email) || empty($mensaje)) {
        echo "Todos los campos son requeridos.";
        exit;
    }

    // Validación del correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "El correo electrónico no es válido.";
        exit;
    }

    // Validación del teléfono (se asume que es un número de 10 dígitos)
    if (!preg_match("/^[0-9]{10}$/", $telefono)) {
        echo "El número de teléfono no es válido. Debe ser un número de 10 dígitos.";
        exit;
    }

    // Dirección de correo electrónico a la que se enviará el formulario
    $destinatario = "sebastianquidelm.0811@gmail.com";  // Reemplaza con tu correo

    // Asunto del correo
    $asunto = "Nuevo mensaje desde el formulario de cotización";

    // Cuerpo del correo con los datos del formulario
    $cuerpo = "Nombre: $nombre\n";
    $cuerpo .= "Whatsapp: $telefono\n";
    $cuerpo .= "Correo electrónico: $email\n";
    $cuerpo .= "Tipo de Web: $tipoweb\n";
    $cuerpo .= "Mensaje:\n$mensaje\n";

    // Encabezados del correo (enviar desde la dirección de correo del remitente)
    $headers = "From: $email" . "\r\n" . "Reply-To: $email" . "\r\n";

    // Enviar el correo
    if (mail($destinatario, $asunto, $cuerpo, $headers)) {
        echo "¡Gracias por tu mensaje! Te responderemos pronto.";
    } else {
        echo "Hubo un error al enviar tu mensaje. Intenta de nuevo más tarde.";
    }
}
?>
