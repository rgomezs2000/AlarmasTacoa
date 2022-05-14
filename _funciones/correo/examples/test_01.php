<?php
require("../class.phpmailer.php");
$mail = new PHPMailer();
$mail->IsSMTP(); // telling the class to use SMTP // SOLO FUNCIONA PARA mail.cantv.net
$mail->Host = "mail.cantv.net"; 			// cantv.net
$mail->From = "luisaparcedo@cantv.net";
//$mail->Host = "smtp.live.com"; 				// hotmail.com
//$mail->From = "luisaparcedo@hotmail.com";
//$mail->Host = "in.izymail.com"; 			// yahoo.com
//$mail->From = "luisaparcedo@yahoo.es";
//$mail->Host = "pop.gmail.com"; 				// gmail.com
//$mail->From = "luisaparcedo@gmail.com";
$mail->FromName = 'Luis Aparcedo';
$mail->AddAddress("luisaparcedo@yahoo.es");
$mail->Subject = "LUIS APARCEDO Primer Mensaje PHPMailer con ".$mail->Host;
$mail->Body = "Se hace una prueba de envio de correo.";
//$mail->IsHTML(true);
$mail->WordWrap = 50;
if(!$mail->Send())
{
   echo 'El mensaje no fue enviado.';
   echo 'Mailer error: ' . $mail->ErrorInfo;
}
else
{
   echo 'El mensaje ha sido enviado.';
}
?>