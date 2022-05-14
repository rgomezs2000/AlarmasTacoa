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
	
	$usuario = $_REQUEST['usuario'];
	$clave = $_REQUEST['clave'];


	$strQuery = "SELECT * FROM usuarios where usuario = '" . $usuario . "' and  clave = '" . $clave . "' and activo = 'SI' ";
	
	$result = mysql_query($strQuery);
	$NumRows = mysql_num_rows($result);
	if ($NumRows == 0)
	{
		$msjDiv = "!ERROR: usuario y/o clave incorrecto.";
		//MostrarMensajeJava($msjDiv,'divSesion');
		MostrarMensaje($msjDiv);
		?>
		<script type="text/javascript">
			$("#divSesion").load("sesion/iniciar.php", {});
		</script>
		<?php
		exit();
	}
	
	$results = mysql_fetch_array($result,MYSQL_ASSOC);
	
	$_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] = $results['usuario'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'] = $results['nombres'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'] = $results['apellidos'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'] = $results['correo_institucional'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['extension'] = $results['extension'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'] = $results['ubicacion'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['sede'] = $results['sede'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['fecha_creacion'] = $results['fecha_creacion'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['perfil'] = $results['perfil'];
	$_SESSION['SistAlarmasTacoa']['Usuario']['clave'] = $results['clave'];
	
	
	
	mysql_free_result($result);
	
	MostrarMensaje($_SESSION['SistAlarmasTacoa']['Usuario']['perfil'].' '.$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'].' '.$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'].'. \nBienvenido al Sistema Alarmas TACOA!!!');
	?>
	<script type="text/javascript">
		$("#divSesion").load("sesion/cerrar.php", {});
		$("#divCuerpo").load("sesion/bienvenida.php", {});
		$("#divMenuVertical").load("estructura/menuvertical.php", {});
	</script>
	<?php
	// Cargar el menú vertical según el perfil tenga asignado
	exit();
	
?>
