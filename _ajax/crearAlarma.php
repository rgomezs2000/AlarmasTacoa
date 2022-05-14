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
	
	$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
	$mensajealarmahmi = $_REQUEST['mensajealarmahmi'];
	$causasposibles = $_REQUEST['causasposibles'];
	$respuesta = $_REQUEST['respuesta'];

	$Sqlcodigoalarmahmi = "'".$codigoalarmahmi."'";
	$Sqlmensajealarmahmi = "'".$mensajealarmahmi."'";
	$Sqlcausasposibles = "'".$causasposibles."'";
	$Sqlrespuesta = "'".$respuesta."'";
	
	$resultadof = BuscarAlarma_codigoalarmahmi($codigoalarmahmi);
	
	//Existe codigo alarma hmi
	if ($resultadof['CodError'] == 0) 
	{
		?>
		<script>
		alert('!El código de alarma ya existe');
		document.getElementById('codigoalarmahmi').value = '';
		</script>
		<?php
		exit();
	}
	else
	{
		$resultadof4 = CrearAlarma($Sqlcodigoalarmahmi, $Sqlmensajealarmahmi, $Sqlcausasposibles, $Sqlrespuesta);
		if ($resultadof4['CodError'] == 0)
		{
			?>
			<script>
			alert('Se ha creado la alarma satisfactoriamente');
			$("#divCuerpo").load("alarmas/crear.php", {});
			</script>
			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('!Ha ocurrido una falla creando la alarma. Contacte al administrador del Sistema');
			</script>
			<?php
			exit();
		}
	}
?>
