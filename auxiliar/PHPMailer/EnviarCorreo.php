<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

class EnviarCorreo {

    public static function nuevoCorreo($correoDestinatario, $nuevoPass) {
        $mail = new PHPMailer();
        try {
            // Configuracion del servidor
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                   // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host = 'smtp.gmail.com';                             // Set the SMTP server to send through
            $mail->SMTPAuth = true;                                     // Enable SMTP authentication
            $mail->Username = 'AuxiliarDAW2@gmail.com';                      // SMTP username
            $mail->Password = 'Chubaca20';                              // SMTP password
            $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port = 465;                                          // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
            //Datos
            $mail->setFrom('AuxiliarDAW2@gmail.com');
            $mail->addAddress($correoDestinatario);                     // Add a recipient
            // Contenido
            $mail->isHTML(true);                                        // Set email format to HTML
            $mail->Subject = 'Contraseña modificada: ' . $nuevoPass;
            $mail->Body = 'Gracias por confiar en nosotros';
            $mail->AltBody = 'Gracias por confiar en nosotros';

            $mail->send();
            echo 'Mensaje enviado correctamente';
        } catch (Exception $e) {
            echo "Error al enviar un mensaje: {$mail->ErrorInfo}";
        }
    }

}
