<?php
// Incluir la libreria PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Variables form HTML
$nombre    = $_POST["name"];
$correo    = $_POST["email"];
$asunto    = $_POST["subject"];
$mensaje   = $_POST["message"];

$cuerpo = '<div style="font-size: 16px;"> <div> <p> Este mensaje fue envia por  <span> <b>';
$cuerpo .= $nombre;
$cuerpo .= '</b> </span> </p> <div> <p> Su e-mail es: <span>';
$cuerpo .= $correo;
$cuerpo .= '</span> </p> <div> <p> Mensaje: <span>';
$cuerpo .= $mensaje;
$cuerpo .= '</span> </p> <div> <p> Enviado el <span>';
$cuerpo .= date('d/m/Y', time());
$cuerpo .= '</span> </p> </div>';



// Inicializaciones
$hostSMTP = 'smtp.gmail.com';
$emisor = 'chiaritafq@gmail.com';
$pass = 'querol2992';
$puerto = 465;
$receptor = 'micolfernandezquerol@gmail.com';
$reply = $correo;
//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = $hostSMTP;                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = $emisor;                     //SMTP username
    $mail->Password   = $pass;                               //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
    $mail->Port       = $puerto;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom($emisor, 'Formulario web');
    $mail->addAddress($receptor);     //Add a recipient
    $mail->addReplyTo($reply);

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $asunto;
    $mail->Body    = $cuerpo;

    $mail->send();
    header("location:../index.html");
} catch (Exception $e) {
    header("location:../index.html#contact");
}