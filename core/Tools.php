<?php
namespace Core;

require 'core/libs/phpMailer/Exception.php';
require 'core/libs/phpMailer/PHPMailer.php';
require 'core/libs/phpMailer/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Tools
{



    public function sanitize($input)
    {
        // Eliminar espacios en blanco al inicio y al final
        $input = trim($input);
        // Eliminar etiquetas HTML y caracteres especiales
        $input = htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        $input = str_replace("<script>", "", $input);
        $input = str_replace("<script>", "", $input);
        $input = str_replace("</script>", "", $input);
        $input = str_replace("<script type=>", "", $input);
        $input = str_replace("SELECT * FROM", "", $input);
        $input = str_replace("select * from", "", $input);
        $input = str_replace("DELETE FROM", "", $input);
        $input = str_replace("delete from", "", $input);
        $input = str_replace("INSERT INTO", "", $input);
        $input = str_replace("insert into", "", $input);
        $input = str_replace("DROP DATABASE", "", $input);
        $input = str_replace("drop database", "", $input);
        $input = str_replace("--", "", $input);
        $input = str_replace("^", "", $input);
        $input = str_replace("[", "", $input);
        $input = str_replace("]", "", $input);
        $input = str_replace("==", "", $input);
        $input = str_replace("=", "", $input);
        $input = str_replace("/", "", $input);
        $input = str_replace(">", "", $input);
        $input = str_replace("<", "", $input);
        $input = str_replace("'", "", $input);
        $input = str_replace(";", "", $input);
        $input = str_replace("%", "", $input);
        $input = str_replace("(", "", $input);
        $input = str_replace(")", "", $input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $input = addslashes($input);

        // Retornar el valor limpio
        return $input;
    }

    public function validateFields($fields)
    {
        $errors = [];

        foreach ($fields as $fieldName => $field) {
            if (empty($field)) {
                $errors[$fieldName] = "Campo {$fieldName} es obligatorio.";
            }
        }

        return $errors;
    }

    public function sendEmail($subject, $email, $content)
    {

        try {

            //instance library phpmailer
            $mail = new PHPMailer(true);

            //Server settings
            $mail->SMTPDebug = 0;                   // Enable verbose debug output
            $mail->isSMTP();                        // Send using SMTP
            $mail->Host     = 'smtp.gmail.com';       // Set the SMTP server to send through
            $mail->SMTPAuth = true;                 // Enable SMTP authentication
            $mail->Username   = 'proyectochevez@gmail.com';  // SMTP username
            $mail->Password   = 'carg iixp xdgq jutm';       // SMTP password
            $mail->SMTPSecure = 'tls';              // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
            $mail->Port       = 587;                // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

            //Recipients
            $mail->setFrom('proyectochevez@gmail.com', 'ProyectosChevez');
            $mail->addAddress($email);              // Add a recipient
            $mail->isHTML(true);                    // Content
            $mail->Subject = $subject;
            //template
            $mail->Body = $content;
            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $e) {
            echo "Hubo un error para enivar correo: {$mail->ErrorInfo}";
        }
    }


}
?>