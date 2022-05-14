<?php
session_start();

require_once '../includes/constantes.php';
require_once '../_funciones/funciones.php';


		
	$nombresapellidos = $_REQUEST['nombresapellidos'];
	$correo_institucional = $_REQUEST['correo_institucional'];
	$comentarios = $_REQUEST['comentarios'];
	
	
	setlocale(LC_ALL,"es_ES@euro","es_ES","esp");
	$hora = date("Y-m-d H:i:s");
	$fechaMktime = mktime(date("H"),date("i"),date("s"),date("m"),date("d"),date("Y")); // Propiedades similares a time()
	$horario_for = strftime("%d de %B del %Y a las %H:%M:%S",$fechaMktime);
	
	require_once("../_funciones/correo/class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP(); // telling the class to use SMTP // SOLO FUNCIONA PARA mail.cantv.net
	$mail->Host = "mail.cantv.net"; 			// cantv.net
	$mail->CharSet = "UTF-8";  
	$mail->Encoding = "quoted-printable";
	$mail->From = "luisaparcedo@cantv.net"; // Debe  existir para poder enviarlo
	//$mail->Host = "smtp.live.com"; 				// hotmail.com
	//$mail->From = "luisaparcedo@hotmail.com";
	//$mail->Host = "in.izymail.com"; 			// yahoo.com
	//$mail->From = "luisaparcedo@yahoo.es";
	//$mail->Host = "pop.gmail.com"; 				// gmail.com
	//$mail->From = "luisaparcedo@gmail.com";
	$mail->FromName = 'Administrador Sistema Alarmas TACOA';
	$mail->AddAddress("luisaparcedo@yahoo.es");
	$mail->Subject = "Envío Correo desde Módulo Contáctenos";
	$mail->Body = '
<html>
<head>
<title>Alarmas TACOA</title>
    <style type="text/css">
    body,td,th {
	font-family: Arial, Helvetica, sans-serif;
}
a {
	font-family: Arial, Helvetica, sans-serif;
}
    .azul {
	color: #009;
	font-weight: bold;
	font-size: 16px;
}
    </style>
</head>
<body>
            <div id="principal" style="height:500px;">
              <div align="center">
                <table width="859" height="63" border="0">
                  <tr>
                    <th width="849" scope="row">SISTEMA AUTOMATIZADO ALARMAS TACOA</th>
                    </tr>
                </table>
              <div align="center">
                <p>&nbsp;</p>
                <span class="azul">Envío de correo por contáctenos:</span>
                <p>&nbsp;</p>
                <p>Se ha enviado un correo del módulo contáctenos del Sistema Alarmas TACOA con los siguientes datos:</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div align="left">
				  <form name="form1" method="post">
                  <table width="560" height="103" border="1" align="center">
					<tr>
                      <td>Nombres y Apellidos:</td>
                      <td>'.$nombresapellidos.'</td>
                    </tr>
					<tr>
                      <td>Correo Institucional:</td>
                      <td>'.$correo_institucional.'</td>
                    </tr>
					<tr>
                      <td>Comentarios:</td>
                      <td>'.$comentarios.'</td>
                    </tr>
                  </table>
				  </form>
                </div>
<br><p align="center">Este correo fue enviado el '.$horario_for.'</p>
              </div>
            </div>
        </div>
</body>
</html>';

	$mail->IsHTML(true);
	$mail->WordWrap = 50;

	if(!$mail->Send())
	{
	   ReportarFalla("!El sistema esta presentando problemas en este modulo. Contacte al administrador. Error: no se pudo enviar el correo");
	}
	else
	{
		?>
		<script>
		alert('!Se ha enviado el correo satisfactoriamente. El equipo Alarmas le responderá a la brevedad');
		document.getElementById("nombresapellidos").value = "";
		document.getElementById("correo_institucional").value = "";
		document.getElementById("comentarios").value = "";
		</script>
		<?php
		exit();
	}

	
