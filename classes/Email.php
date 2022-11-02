<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token){

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }

    public function enviarConfirmacion(){

        // crear una nueva instancia de PHPmailer
        $mail = new PHPMailer();

        // configurar smtp
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '77ecb007568004';
        $mail->Password = 'bb3712946fe3ca';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;
        
        // configurar el contenido del mail
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','appsalon.com');
        $mail->Subject = 'Confirma tu cuenta';

        // habilitar html 
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        
        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong>. Estás a un paso de crear tu cuenta en Appsalon, solo debes confirmar tu usuario presionando el siguiente enlace</p>';
        $contenido .= '<p>Presiona aquí: <a href="http://localhost:3000/confirmar-cuenta?token=' . $this->token . '">Confirmar cuenta</a></p>';
        $contenido .= '<p>Si no solicitaste esta cuenta, ignora este mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();

    }

    public function enviarInstrucciones(){
        // crear una nueva instancia de PHPmailer
        $mail = new PHPMailer();

        // configurar smtp
        $mail->isSMTP();
        $mail->Host = 'smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = '77ecb007568004';
        $mail->Password = 'bb3712946fe3ca';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 2525;
        
        // configurar el contenido del mail
        $mail->setFrom('cuentas@appsalon.com');
        $mail->addAddress('cuentas@appsalon.com','appsalon.com');
        $mail->Subject = 'Restablece tu contraseña';

        // habilitar html 
        $mail->isHTML(true);
        $mail->CharSet = "UTF-8";
        
        // Definir el contenido
        $contenido = '<html>';
        $contenido .= '<p><strong>Hola ' . $this->nombre . '</strong>. Has solicitado restablecer tu contraseña, hazlo dando clic en el siguiente enlace</p>';
        $contenido .= '<p>Presiona aquí: <a href="http://localhost:3000/recuperar?token=' . $this->token . '">Restablecer contraseña</a></p>';
        $contenido .= '<p>Si no solicitaste esta cuenta, ignora este mensaje</p>';
        $contenido .= '</html>';

        $mail->Body = $contenido;

        $mail->send();        
    }

}