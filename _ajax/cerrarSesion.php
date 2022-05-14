<?php
session_start();

require_once '../includes/constantes.php';
require_once '../_funciones/funciones.php';


	$_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['extension'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['sede'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['fecha_creacion'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['perfil'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['clave'] = '';
	
	MostrarMensaje('Se ha cerrado su sesión!!!');
	require_once '../sesion/iniciar.php';
	// Cargar a la página principal y el menú vertical una vez finalizada la sesion
?>
<script type="text/javascript">
	$("#divCuerpo").load("sesion/bienvenida.php", {});
	$("#divMenuVertical").load("estructura/menuvertical.php", {});
</script>
