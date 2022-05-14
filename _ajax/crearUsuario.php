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
	$correo_institucional = $_REQUEST['correo_institucional'];
	$extension = $_REQUEST['extension'];
	$ubicacion = $_REQUEST['ubicacion'];
	$sede = $_REQUEST['sede'];
	$perfil = $_REQUEST['perfil'];
	$usuario = $_REQUEST['usuario'];
	$clave = $_REQUEST['clave'];

	$Sqlnombres = "'".$nombres."'";
	$Sqlapellidos = "'".$apellidos."'";
	$Sqlcorreo_institucional = "'".$correo_institucional."'";
	$Sqlextension = "'".$extension."'";
	$Sqlubicacion = "'".$ubicacion."'";
	$Sqlsede = "'".$sede."'";
	$Sqlperfil = "'".$perfil."'";
	$Sqlusuario = "'".$usuario."'";
	$Sqlclave = "'".$clave."'";
	
	$resultadof = BuscarUsuario_Correo($correo_institucional);
	$resultadof2 = BuscarUsuario_Usuario($usuario);
	
	//Existe correo y usuario
	if ($resultadof['CodError'] == 0 and $resultadof2['CodError'] == 0) 
	{
		// El correo y el usuario pertenecen al mismo usuario
		if ($resultadof['correo_institucional'] == $resultadof2['correo_institucional']) 
		{
			// Se encuentra desactivado
			if ($resultadof['activo'] == 'NO')
			{
				$resultadof3 = ReactivarUsuario($Sqlnombres, $Sqlapellidos, $Sqlcorreo_institucional, $Sqlextension, $Sqlubicacion, $Sqlsede, $Sqlperfil, $Sqlusuario, $Sqlclave);
				if ($resultadof3['CodError'] == 0)
				{
					?>
                    <script>
					alert('Se ha reactivado el usuario satisfactoriamente');
					$("#divCuerpo").load("usuarios/crear.php", {});
					</script>
                    <?php
					exit();
				}
				else
				{
					?>
                    <script>
					alert('!Ha ocurrido una falla reactivando al usuario. Contacte al administrador del Sistema');
					</script>
                    <?php
					exit();
				}
			}
			// Se encuentra activado
			else
			{
				?>
				<script>
				alert('!El usuario ya existe');
				document.getElementById('correo_institucional').value = '';
				document.getElementById('usuario').value = '';
				</script>
				<?php
				exit();
			}
		}
		// Existe la cedula y el usuario en el sistema
		elseif ($resultadof['activo'] == 'NO' or $resultadof2['activo'] == 'NO')
		{
			?>
			<script>
			alert('!El correo y/o el usuario que ha ingresado ya estan siendo utilizados en el sistema por otro usuario');
			alert('!Si desea reactivar un usuario, debera hacer coincidir el correo con el usuario que fue desactivado');
			document.getElementById('correo_institucional').value = '';
			document.getElementById('usuario').value = '';
			</script>
			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('!El correo y el usuario que ha ingresado ya estan siendo utilizados en el sistema por otros usuarios');
			document.getElementById('correo_institucional').value = '';
			document.getElementById('usuario').value = '';
			</script>
			<?php
			exit();
		}
	}
	// Existe la cedula pero no el usuario
	elseif ($resultadof['CodError'] == 0 and $resultadof2['CodError'] != 0)
	{
		// La cedula esta desactivada
		if ($resultadof['activo'] == 'NO')
		{
			?>
			<script>
			alert('!El correo que ha ingresado ya estan siendo utilizada en el sistema por otro usuario');
			alert('!Si desea reactivar un usuario, debera hacer coincidir el correo con el usuario que fue desactivado');
			document.getElementById('usuario').value = '';
			</script>
			<?php
			exit();
		}
		// La cedula esta activa
		else
		{
			?>
			<script>
			alert('!El correo que ha ingresado ya estan siendo utilizada en el sistema por otro usuario');
			document.getElementById('correo_institucional').value = '';
			</script>
			<?php
			exit();
		}
	}
	// Existe el usuario pero no la cedula
	elseif ($resultadof['CodError'] != 0 and $resultadof2['CodError'] == 0)
	{
		// El usuario esta desactivado
		if ($resultadof2['activo'] == 'NO')
		{
			?>
			<script>
			alert('!El usuario que ha ingresado ya estan siendo utilizado en el sistema por otro usuario');
			alert('!Si desea reactivar un usuario, debera hacer coincidir el correo con el usuario que fue desactivado');
			document.getElementById('correo_institucional').value = '';
			</script>
			<?php
			exit();
		}
		// El usuario esta activo
		else
		{
			?>
			<script>
			alert('!El usuario que ha ingresado ya estan siendo utilizado en el sistema por otro usuario');
			document.getElementById('usuario').value = '';
			</script>
			<?php
			exit();
		}
	}
	// No existe ni la cedula ni el usuario
	elseif ($resultadof['CodError'] != 0 and $resultadof2['CodError'] != 0)
	{
		$resultadof4 = CrearUsuario($Sqlnombres, $Sqlapellidos, $Sqlcorreo_institucional, $Sqlextension, $Sqlubicacion, $Sqlsede, $Sqlperfil, $Sqlusuario, $Sqlclave);
		if ($resultadof4['CodError'] == 0)
		{
			?>
			<script>
			alert('Se ha creado el usuario satisfactoriamente');
			$("#divCuerpo").load("usuarios/crear.php", {});
			</script>
			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('!Ha ocurrido una falla creando al usuario. Contacte al administrador del Sistema');
			</script>
			<?php
			exit();
		}
	}
?>
