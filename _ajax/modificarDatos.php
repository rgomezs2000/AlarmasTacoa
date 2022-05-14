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
	
	$nombres = $_REQUEST['nombres'];
	$apellidos = $_REQUEST['apellidos'];
	$extension = $_REQUEST['extension'];
	$ubicacion = $_REQUEST['ubicacion'];
	$sede = $_REQUEST['sede'];

	$Sqlnombres = "'".$nombres."'";
	$Sqlapellidos = "'".$apellidos."'";
	$Sqlextension = "'".$extension."'";
	$Sqlubicacion = "'".$ubicacion."'";
	$Sqlsede = "'".$sede."'";
	
	$usuario = $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'];
	$Sqlusuario = "'".$usuario."'";
	
	$resultadof = ModificarDatos($Sqlusuario, $Sqlnombres, $Sqlapellidos, $Sqlextension, $Sqlubicacion, $Sqlsede);
	if ($resultadof['CodError'] == 0)
	{
		$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'] = $nombres;
		$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'] = $apellidos;
		$_SESSION['SistAlarmasTacoa']['Usuario']['extension'] = $extension;
		$_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'] = $ubicacion;
		$_SESSION['SistAlarmasTacoa']['Usuario']['sede'] = $sede;
		?>
		<script>
		alert('!Se han modificado los datos satisfactoriamente');
		$("#divSesion").load("sesion/cerrar.php", {});
		</script>
		<?php
		exit();
	}
	else
	{
		?>
		<script>
		alert('!Ha ocurrido una falla eliminando al proveedor. Contacte al administrador del Sistema');
		</script>
		<?php
		exit();
	}
?>
