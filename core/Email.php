<?php

namespace Core;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP library phpmailer
require 'core/libs/phpMailer/Exception.php';
require 'core/libs/phpMailer/PHPMailer.php';
require 'core/libs/phpMailer/SMTP.php';

class Email
{


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


