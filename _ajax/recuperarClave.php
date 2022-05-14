<?php
session_start();

require_once '../includes/constantes.php';
require_once '../_funciones/funciones.php';


		
	$id_cone = mysql_connect($cServidor, $cUsuario, $cPassword);
	
	if ($id_cone == 0) {
		ReportarFalla("!El sistema esta presentando problemas en este modulo. Contacte al administrador. Error: al conectarse al servidor de base de datos");
	}
	
	$bdcone = mysql_select_db($cBaseDatos, $id_cone);
	if (!$bdcone)
	{
		ReportarFalla("!El sistema esta presentando problemas en este modulo. Contacte al administrador. Error: no se pudo realizar la conexion a la base de datos");
	}
	
	$correo_institucional = $_REQUEST['correo_institucional'];
	$resultadof = BuscarUsuario_Correo($correo_institucional);
	if ($resultadof['CodError'] != 0)
	{
		?>
		<script>
		alert('!El correo no está asignado a usuario alguno');
		</script>
		<?php
		exit();
	}
	
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
	$mail->AddAddress($correo_institucional);
	$mail->Subject = "Envío Correo desde Módulo Ólvidó su Contraseña";
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
                <span class="azul">Envío de correo por Módulo Olvidó su contraseña:</span>
                <p>&nbsp;</p>
                <p>Se ha enviado un correo del módulo olvidó su contraseña del Sistema Alarmas TACOA con los siguientes datos:</p>
                <p>&nbsp;</p>
                <p>&nbsp;</p>
                <div align="left">
				  <form name="form1" method="post">
                  <table width="560" height="103" border="1" align="center">
					<tr>
                      <td>Nombres y Apellidos:</td>
                      <td>'.$resultadof['nombres'].' '.$resultadof['apellidos'].'</td>
                    </tr>
					<tr>
                      <td>Correo Institucional:</td>
                      <td>'.$resultadof['correo_institucional'].'</td>
                    </tr>
					<tr>
                      <td>Contraseña:</td>
                      <td>'.$resultadof['clave'].'</td>
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
		alert('!Se ha enviado la contraseña a su cuenta de correo institucional.');
		document.getElementById("correo_institucional").value = "";
		</script>
		<?php
		exit();
	}

	
