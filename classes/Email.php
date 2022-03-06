<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email
{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token)
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }

    public function enviarMailConfirmacion()
    {
        $phpmailer = new PHPMailer();

        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp-mail.outlook.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->SMTPSecure = 'starttls';
        $phpmailer->Username = 'nicomicarelli@hotmail.com';
        $phpmailer->Password = 'NIco4089';

        $phpmailer->setFrom('nicomicarelli@hotmail.com');
        $phpmailer->addAddress($this->email, 'Nicolas Micarelli');
        $phpmailer->Subject = 'Confirma tu cuenta';
        $phpmailer->isHTML(true);
        $phpmailer->CharSet = 'UTF-8';

        $contenido =  "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "  has creado tu cuenta en AppSalon.  </strong></p>";
        $contenido .= "<p>Solo debes confirmarla haciendo click en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona Aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a></p>";
        $contenido .=  "<p>Si no solicitaste esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .=  "</html>";

        $phpmailer->Body = $contenido;
        $phpmailer->AltBody = "tienes un mensaje";

        if ($phpmailer->send()) {
            $mensaje = "Mail enviado correctamente.";
        } else {
            $mensaje = "Mail NO enviado.";
        }
    }
    public function enviarInstrucciones()
    {
        $phpmailer = new PHPMailer();

        $phpmailer->isSMTP();
        $phpmailer->Host = 'smtp-mail.outlook.com';
        $phpmailer->SMTPAuth = true;
        $phpmailer->Port = 587;
        $phpmailer->SMTPSecure = 'starttls';
        $phpmailer->Username = 'nicomicarelli@hotmail.com';
        $phpmailer->Password = 'NIco4089';

        $phpmailer->setFrom('nicomicarelli@hotmail.com');
        $phpmailer->addAddress($this->email, 'Nicolas Micarelli');
        $phpmailer->Subject = 'recupera tu password';
        $phpmailer->isHTML(true);
        $phpmailer->CharSet = 'UTF-8';

        $contenido =  "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "  has solicitado restablecer tu password.  </strong></p>";
        $contenido .= "<p>Restablece tu password haciendo click en el siguiente enlace.</p>";
        $contenido .= "<p>Presiona Aqui: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Restablece tu password</a></p>";
        $contenido .=  "<p>Si no solicitaste este cambio, puedes ignorar el mensaje</p>";
        $contenido .=  "</html>";

        $phpmailer->Body = $contenido;
        $phpmailer->AltBody = "tienes un mensaje";
        
        if ($phpmailer->send()) {
            $mensaje = "Mail enviado correctamente.";
        } else {
            $mensaje = "Mail NO enviado.";
        }
    }
}
