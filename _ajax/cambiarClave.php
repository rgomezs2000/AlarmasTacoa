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
	
	$claveactual = $_REQUEST['claveactual'];
	$clavenueva = $_REQUEST['clavenueva'];

	$Sqlclaveactual = "'".$claveactual."'";
	$Sqlclavenueva = "'".$clavenueva."'";
	
	if (strcmp($claveactual,$_SESSION['SistAlarmasTacoa']['Usuario']['clave']) != 0)
	{
		?>
		<script>
		alert('!La contraseña ingresada no coincide con la contraseña actual');
		</script>
		<?php
		exit();
	}
	
	$usuario = $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'];
	$Sqlusuario = "'".$usuario."'";
	
	$resultadof = CambiarClave($Sqlusuario, $Sqlclavenueva);
	if ($resultadof['CodError'] == 0)
	{
		$_SESSION['SistAlarmasTacoa']['Usuario']['clave'] = $clavenueva;
		?>
		<script>
		alert('!Se ha cambiado la contraseña satisfactoriamente');
		$("#divCuerpo").load("sesion/cambiarclave.php", {});
		</script>
		<?php
		exit();
	}
	else
	{
		?>
		<script>
		alert('!Ha ocurrido una falla cambiando la contraseña. Contacte al administrador del Sistema');
		</script>
		<?php
		exit();
	}
?>
