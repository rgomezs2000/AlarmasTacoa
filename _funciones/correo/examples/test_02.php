<?php
require '../class.phpmailer.php';
require '../class.smtp.php'; //incluimos la clase para envíos por SMTP
$mail = new PHPMailer();
 
 
$mail->IsSMTP();
$mail->CharSet = 'UTF-8';
$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl";
$mail->Host = "pop3.live.com"; //servidor smtp
$mail->Port = 995; //puerto smtp de gmail
$mail->Username = 'luisaparcedo@hotmail.com';
$mail->Password = 'XXXXXXXXXXXXXXx';
 
$mail->FromName = 'Luis Isrrael Aparcedo';
$mail->From = 'luisaparcedo@hotmaaail.com';//email de remitente desde donde se envía el correo.
 
$mail->AddAddress('luisaparcedo@yahoo.es', 'Destinatario');//destinatario que va a recibir el correo
 
$mail->AddCC('luisaparcedo@yahoo.es', 'copia');//envía una copia del correo a la dirección especificada
 
$mail->Subject = 'Asunto de email';
 
$mail->AltBody = 'cuerpo del mensaje en texto plano';//cuerpo con texto plano
 
$mail->MsgHTML('Mensaje con HTML');//cuerpo con html
 
//$mail->AddAttachment("archivo.zip");//adjuntos un archivo al mensaje
 
if(!$mail->Send()) {//finalmente enviamos el email
   echo $mail->ErrorInfo;//si no se envía correctamente se muestra el error que ocurrió
} else {
   echo 'Correo enviado correctamente';
}
?>