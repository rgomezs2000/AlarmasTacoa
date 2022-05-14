<html>
<head>

</head>

<body>
<form action="../index.php" method="post" name="form1" id="form1">
</form>
</body>
</html>
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
	$dispositivo = $_REQUEST['dispositivo'];
	$descripcion = $_REQUEST['descripcion'];
	$sistema = $_REQUEST['sistema'];
	$cable_num_1 = $_REQUEST['cable_num_1'];
	$caja_conexiones = $_REQUEST['caja_conexiones'];
	$cable_num_2 = $_REQUEST['cable_num_2'];
	$mk_vi = $_REQUEST['mk_vi'];
	$mk_v = $_REQUEST['mk_v'];
	$point_name = $_REQUEST['point_name'];
	$vme_card = $_REQUEST['vme_card'];
	$mk_vi_rack = $_REQUEST['mk_vi_rack'];
	$mk_vi_vme_jack = $_REQUEST['mk_vi_vme_jack'];
	$mk_vi_signal_name = $_REQUEST['mk_vi_signal_name'];
	//$fotos = $_REQUEST['fotos'];
	$fotos = 'fotos/'.$codigoalarmahmi.strstr($_FILES['fotos']['name'],'.');


	$Sqlcodigoalarmahmi = "'".$codigoalarmahmi."'";
	$Sqldispositivo = "'".$dispositivo."'";
	$Sqldescripcion = "'".$descripcion."'";
	$Sqlsistema = "'".$sistema."'";
	$Sqlcable_num_1 = "'".$cable_num_1."'";
	$Sqlcaja_conexiones = "'".$caja_conexiones."'";
	$Sqlcable_num_2 = "'".$cable_num_2."'";
	$Sqlmk_vi = "'".$mk_vi."'";
	$Sqlmk_v = "'".$mk_v."'";
	$Sqlpoint_name = "'".$point_name."'";
	$Sqlvme_card = "'".$vme_card."'";
	$Sqlmk_vi_rack = "'".$mk_vi_rack."'";
	$Sqlmk_vi_vme_jack = "'".$mk_vi_vme_jack."'";
	$Sqlmk_vi_signal_name = "'".$mk_vi_signal_name."'";
	$Sqlfotos = "'".$fotos."'";
	
	$resultadof = BuscarMantenimiento_codigoalarmahmi($codigoalarmahmi);
	
	//Existe codigo alarma hmi
	if ($resultadof['CodError'] == 0) 
	{
		?>
		<script>
		alert('!El código de alarma ya existe');
		//document.getElementById('dispositivo').value = '';
		document.form1.action="../index.php";
		document.form1.submit();
		</script>
		<?php
		exit();
	}
	else
	{
		$resultadof = SubirImagen('../'.$fotos, 'fotos');
		if ($resultadof['CodError'] == 0)
		{
			$resultadof4 = CrearMantenimiento($Sqlcodigoalarmahmi, $Sqldispositivo, $Sqldescripcion, $Sqlsistema, $Sqlcable_num_1, $Sqlcaja_conexiones, $Sqlcable_num_2, $Sqlmk_vi, $Sqlmk_v, $Sqlpoint_name, $Sqlvme_card, $Sqlmk_vi_rack, $Sqlmk_vi_vme_jack, $Sqlmk_vi_signal_name, $Sqlfotos);
			if ($resultadof4['CodError'] == 0)
			{
				?>
				<script>
				alert('Se ha creado la alarma satisfactoriamente');
				document.form1.action="../index.php";
				document.form1.submit();
				//$("#divCuerpo").load("mantenimiento/crear.php", {});
				</script>
				<?php
				exit();
			}
			else
			{
				?>
				<script>
				alert('!Ha ocurrido una falla creando la alarma. Contacte al administrador del Sistema');
				document.form1.action="../index.php";
				document.form1.submit();
				</script>
				<?php
				exit();
			}
		}
		else
		{
			?>
			<script>
			alert('!Ha ocurrido una falla creando la alarma. Contacte al administrador del Sistema');
			document.form1.action="../index.php";
			document.form1.submit();
			</script>
			<?php
			exit();
		}
	}
?>
