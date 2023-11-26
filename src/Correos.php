<?php
namespace MisClases;
require_once '../vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Correos{

    public static function enviaCorreoRecuperacion(){
        if(isset($_POST['recuperar'])){
          $datos = self::generaDatosRecuperacionCorreo($_POST['nombre']);
          if($datos != 0){
            $opciones = ['cost' => 10,];
            $certificado = password_hash($datos['nombre'], PASSWORD_BCRYPT, $opciones);
            try {
              $mail = new PHPMailer(true);
              $mail->isSMTP();
              $mail->Host = 'smtp.mail.yahoo.com';
              $mail->SMTPAuth = true;
              $mail->Username = 'reinosis@yahoo.es';
              $mail->Password = 'quudmhiryehrmblt';
              $mail->SMTPSecure = 'tls'; // Puedes cambiarlo a 'ssl' si es necesario
              $mail->Port = 587; 
              $mail->setFrom('reinosis@yahoo.es');
              $mail->addAddress($datos['email'], $datos['nombre']);
              $mail->isHTML(true);
              $mail->CharSet = 'UTF-8';
              $mail->Subject = 'Recuperar acceso';
              $mensaje = "<p>Estimado/a " . $datos['nombre'] . ",";
              $mensaje .= "<p>Hemos recibido tu solicitud para restablecer la contraseña de tu cuenta. Para completar el proceso, haz clic en el siguiente enlace:</p>";
              $mensaje .= "<a href='" . Configuracion::URI . "restablecer.php?&cert=" . $certificado . "'>Pulse aquí para restablecer su contraseña</a>";
              $mensaje .= "<p>Sigue las instrucciones en la página para crear una nueva contraseña. Si no realizaste esta solicitud, por favor contáctanos de inmediato.</p>";
              $mensaje .= "<p>Gracias,</p>";
              $mensaje .= "<p>Equipo de soporte</p>";
              $mail->Body = $mensaje;
              $mail->send();
            } catch (Exception $e) {
                echo 'Error al enviar el correo: ', $mail->ErrorInfo;
            }  
          }   
          header("Location: index.php");    
        }
      }
      
}