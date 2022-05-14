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
	
	$accion = $_REQUEST['accion'];
	
	if ($accion == 'listar')
	{
		$correo_institucional = $_REQUEST['correo_institucional'];
		$usuario = $_REQUEST['usuario'];
		$perfil = $_REQUEST['perfil'];
		
		$resultadof = BuscarUsuarios_Parametros($correo_institucional, $usuario, $perfil, 'SI');
			
		if ($resultadof['CodError'] == 0) 
		{
			// INI CODIGO INDICE BUSQUEDA
			$registros = 5;
			if(isset($_REQUEST['pagina'])){	$pagina = $_REQUEST['pagina'];}else{	$pagina = '';}	
			if ($pagina == "")
			{
				$inicio = 0; 
				$pagina = 1; 
			} 
			else
			{
				$inicio = ($pagina - 1) * $registros; 
			}
			
			$total_paginas = ceil($resultadof['registros']['cantidad'] / $registros);
			// FIN CODIGO INDICE BUSQUEDA

			$resultadof = BuscarUsuarios_Parametros_Ind($correo_institucional, $usuario, $perfil, 'SI', $registros, $inicio);
			
			?>
    <table align='center' cellspacing='0' width='100%'>
    <tr height='30'>
        <td>
        </td>
    </tr>
    <tr height='5' bgcolor='#CCCCCC'>
        <td>
        </td>
    </tr>
    <tr>
        <td align='center' class='textSubTitulo'>
          RESULTADOS DE LA BUSQUEDA
        </td>
    </tr>
    <tr height='5' bgcolor='#CCCCCC'>
        <td>
        </td>
    </tr>
    <tr height='30'>
        <td>
        </td>
    </tr>
    <tr>
        <td>
            <table align='center' cellspacing='0' cellpadding="8" width='100%'>
                <tr class='textTituloTabla'>
                  <td height='40' width='225' align='left'>NOMBRES</td>
                  <td height='40' width='225' align='left'>APELLIDOS</td>
                  <td height='40' width='225' align='left'>CORREO</td>
                  <td height='40' width='225' align='left'>PERFIL</td>
                  <td height='40' width='225' align='left'>FECHA CREACION</td>
                  <td height='40' width='100' align='center'>&nbsp;</td>
                </tr>
            <?php

			$classRegistro = 'textRegistroGris';
			for($i=0;$i<$resultadof['registros']['cantidad'];$i++)
			{
				?>
                <tr class='<?php echo $classRegistro; ?>'>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['nombres']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['apellidos']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['correo_institucional']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['perfil']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['fecha_creacion']; ?></td>
				  <td height='40' width='100' align='center'><a href='JavaScript:fVerMas(10000, "<?php echo $resultadof[$i]['usuario']; ?>");' title='Ver más'>Ver más</a></td>
				
				</tr>
                <?php
				if ($classRegistro == 'textRegistroGris')
				{
					$classRegistro = 'textRegistroRosado';
				}
				else
				{
					$classRegistro = 'textRegistroGris';
				}
			}
			?>
			
            </table>
        </td>
    </tr>
    <tr>
        <td>
            <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr bgcolor="#FFFFFF">
                <td width="100%" height="29">
                	<div align="center">
                  
		<?php if(($pagina - 1) > 0) {
			echo "<a href='JavaScript:fListar(10000, ".($pagina-1).");' class='text2'>< Anterior</a> ";
		}
		
		for ($i=1; $i<=$total_paginas; $i++){ 
			if ($pagina == $i) 
				echo "<b class='text2'>".$pagina."</b> "; 
			else
				echo "<a href='JavaScript:fListar(10000, ".$i.");' class='text2'>$i</a> "; 
		}
	  
		if(($pagina + 1)<=$total_paginas) {
			echo " <a href='JavaScript:fListar(10000, ".($pagina+1).");' class='text2'>Siguiente ></a>";
		} ?>
                      
                	</div>
                </td>
              </tr>
            </table>
        </td>
    </tr>
    </table>
			<script type="text/javascript">
            
                function fVerMas(e, usuario)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
                    $("#divAdmin").load("_ajax/consultarUsuario.php", {accion : 'vermas', usuario : usuario});
                    fDetenerEvento(e);
                }
                
				function fListar(e, pagina)
				{
					var errMsg;
					var isOk;
					var pass;
					errMsg="";  
					
					isOk = true;
					correo_institucional = document.getElementById("correo_institucional").value;
					usuario = document.getElementById("usuario").value;
					perfil = document.getElementById("perfil").value;
					$("#divListado").load("_ajax/consultarUsuario.php", {accion : 'listar', correo_institucional : correo_institucional, usuario : usuario, perfil : perfil, pagina : pagina});
					fDetenerEvento(e);
				}
	
            </script>

			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('No existe registro para la busqueda');
			</script>
			<?php
			exit();
		}
	}
	elseif ($accion == 'vermas')
	{
		$usuario = $_REQUEST['usuario'];
		
		$resultadof = BuscarUsuario_Usuario($usuario);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
                                <table align='center' cellspacing='0' width='100%'>
									<tr height='30'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr height='5' bgcolor='#CCCCCC'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' class='textSubTitulo'>
                                          DATOS DEL USUARIO
                                        </td>
                                    </tr>
                                    <tr height='5' bgcolor='#CCCCCC'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
											<table align='center' cellspacing='0' width='100%'>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>NOMBRES:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['nombres']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>APELLIDOS:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['apellidos']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>CORREO INSTITUCIONAL:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['correo_institucional']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>EXTENSION:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['extension']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>UBICACION:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['ubicacion']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>SEDE:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['sede']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>PERFIL:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['perfil']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>USUARIO:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['usuario']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><input name='imgModificar' id='imgModificar' type='image' src='_imagenes/modificar.png' alt='modificar' width='60' height='19' onMouseOut='fCambiarImagen("imgModificar", "modificar.png");' onMouseMove='fCambiarImagen("imgModificar", "modificar_03.png");' onClick='fCambiarImagen("imgModificar", "modificar_02.png");fModificar(event,"<?php echo $resultadof['usuario']; ?>");'>
                                                    </td>
                                                    <td><div id='btnEliminar'><input name='imgEliminar' id='imgEliminar' type='image' src='_imagenes/eliminar.png' alt='eliminar' width='60' height='19' onMouseOut='fCambiarImagen("imgEliminar", "eliminar.png");' onMouseMove='fCambiarImagen("imgEliminar", "eliminar_03.png");' onClick='fCambiarImagen("imgEliminar", "eliminar_02.png");fEliminar(event,"<?php echo $resultadof['usuario']; ?>");'></div></td>
                                                    <td align='right'>&nbsp;</td>
                                                </tr>
            								</table>
                                        </td>
                                    </tr>
								</table>
			<script type="text/javascript">
            
                function fModificar(e, usuario)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
                    $("#divAdmin").load("_ajax/consultarUsuario.php", {accion : 'modificar', usuario : usuario});
                    fDetenerEvento(e);
                }
                
                function fEliminar(e, usuario)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
					fResultado = confirm('¿Estas seguro que deseas eliminar este usuario?');
					if (fResultado)
					{
						$("#divAdmin").load("_ajax/consultarUsuario.php", {accion : 'eliminar', usuario : usuario});
					}
					
					fDetenerEvento(e);
                }
                
            </script>

			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('No existe registro para la busqueda');
			</script>
			<?php
			exit();
		}
	}
	elseif ($accion == 'modificar')
	{
		$usuario = $_REQUEST['usuario'];
		
		$resultadof = BuscarUsuario_Usuario($usuario);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
											<input type="hidden" id="usuarioactual" name="usuarioactual" class="textfonBlanco" value="<?php echo $resultadof['usuario']; ?>"/>
                                <table align='center' cellspacing='0' width='100%'>
									<tr height='30'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr height='5' bgcolor='#CCCCCC'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td align='center' class='textSubTitulo'>
                                          DATOS DEL USUARIO
                                        </td>
                                    </tr>
                                    <tr height='5' bgcolor='#CCCCCC'>
                                        <td>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table align='center' cellspacing='0' width='100%'>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>NOMBRES:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="nombres" name="nombres" class="textfonBlanco" value="<?php echo $resultadof['nombres']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>APELLIDOS:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="apellidos" name="apellidos" class="textfonBlanco" value="<?php echo $resultadof['apellidos']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>CORREO INSTITUCIONAL:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="correo_institucional2" name="correo_institucional2" class="textfonBlanco" value="<?php echo $resultadof['correo_institucional']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>EXTENSION:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="extension" name="extension" class="textfonBlanco" value="<?php echo $resultadof['extension']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>UBICACION:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="ubicacion" name="ubicacion" class="textfonBlanco" value="<?php echo $resultadof['ubicacion']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>SEDE:</td>
                                                  <td height='40' align='left' class='text2'><select name='sede' id='sede' class='textfonBlanco'>
                                            	    <option value='anzoátegui'>anzoátegui</option>
                                            	    <option value='apure'>apure</option>
                                            	    <option value='barinas'>barinas</option>
                                            	    <option value='bolívar'>bolívar</option>
                                            	    <option value='caracas'>caracas</option>
                                            	    <option value='lara'>lara</option>
                                            	    <option value='los teques'>los teques</option>
                                            	    <option value='maracay'>maracay</option>
                                            	    <option value='mérida'>mérida</option>
                                            	    <option value='nueva esparta'>nueva esparta</option>
                                            	    <option value='portuguesa'>portuguesa</option>
                                            	    <option value='trujillo'>trujillo</option>
                                            	    <option value='valencia'>valencia</option>
                                            	    <option value='vargas'>vargas</option>
                                            	    <option value='zulia'>zulia</option>
                                          	    </select></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>PERFIL:</td>
                                                  <td height='40' align='left' class='text2'><select name='perfil2' id='perfil2' class='textfonBlanco'>
				<option value='usuario'>usuario</option>
				<option value='administrador'>administrador</option>
				<option value='operador'>operador</option>
				<option value='soporte'>soporte</option>
				<option value='supervisor'>supervisor</option>
		</select></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>USUARIO:</td>
                                                  <td height='40' align='left' class='text2'><input type="hidden" id="usuario2" name="usuario2" class="textfonBlanco" value="<?php echo $resultadof['usuario']; ?>"/><?php echo $resultadof['usuario']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name='imgGuardar' id='imgGuardar' type='image' src='_imagenes/guardar.png' alt='guardar' width='60' height='19' onmouseout='fCambiarImagen("imgGuardar", "guardar.png");' onmousemove='fCambiarImagen("imgGuardar", "guardar_03.png");' onclick='fCambiarImagen("imgGuardar", "guardar_02.png");fGuardar(event);' /></td>
                                                    <td align='right'>&nbsp;</td>
                                                </tr>
            								</table>
                                        </td>
                                    </tr>
								</table>
			<script type="text/javascript">
            
                document.getElementById('sede').value = '<?php echo $resultadof['sede'];?>';
				document.getElementById('perfil2').value = '<?php echo $resultadof['perfil'];?>';
				
				function fGuardar(e)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
								
					if (document.getElementById("nombres").value == "")
					{
						errMsg +="- El campo nombres es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("apellidos").value == "")
					{
						errMsg +="- El campo apellidos es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("correo_institucional2").value == "")
					{
						errMsg +="- El campo correo institucional es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("extension").value == "")
					{
						errMsg +="- El campo extensión es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("ubicacion").value == "")
					{
						errMsg +="- El campo ubicación es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("usuario2").value == "")
					{
						errMsg +="- El campo usuario es requerido.\n";
						isOk = false;
					}
					
					if (!isOk)
					{	
						alert(errMsg);
						fDetenerEvento(e);
					}
					else
					{
						usuarioactual = document.getElementById("usuarioactual").value;
						nombres = document.getElementById("nombres").value;
						apellidos = document.getElementById("apellidos").value;
						correo_institucional = document.getElementById("correo_institucional2").value;
						extension = document.getElementById("extension").value;
						ubicacion = document.getElementById("ubicacion").value;
						sede = document.getElementById("sede").value;
						perfil = document.getElementById("perfil2").value;
						usuario = document.getElementById("usuario2").value;
						
						fResultado = confirm('¿Estas seguro que deseas guardar los cambios?');
						if (fResultado)
						{
							$("#divControlador").load("_ajax/consultarUsuario.php", {accion : 'guardar', usuarioactual : usuarioactual, nombres : nombres, apellidos : apellidos, correo_institucional : correo_institucional, extension : extension, ubicacion : ubicacion, sede : sede, perfil : perfil, usuario : usuario});
						}
						
						fDetenerEvento(e);
					}
                }
                
            </script>

			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('No existe registro para la busqueda');
			</script>
			<?php
			exit();
		}
	}
	elseif($accion == 'guardar')
	{
		$usuarioactual = $_REQUEST['usuarioactual'];
		$nombres = $_REQUEST['nombres'];
		$apellidos = $_REQUEST['apellidos'];
		$correo_institucional = $_REQUEST['correo_institucional'];
		$extension = $_REQUEST['extension'];
		$ubicacion = $_REQUEST['ubicacion'];
		$sede = $_REQUEST['sede'];
		$perfil = $_REQUEST['perfil'];
		$usuario = $_REQUEST['usuario'];
	
		$resultadof = ModificarUsuario($usuarioactual, $nombres, $apellidos, $correo_institucional, $extension, $ubicacion, $sede, $perfil, $usuario);
		if ($resultadof['CodError'] == 0)
		{
			if ($usuarioactual == $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'])
			{
				$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'] = $nombres;
				$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'] = $apellidos;
				$_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'] = $correo_institucional;
				$_SESSION['SistAlarmasTacoa']['Usuario']['extension'] = $extension;
				$_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'] = $ubicacion;
				$_SESSION['SistAlarmasTacoa']['Usuario']['sede'] = $sede;
				$_SESSION['SistAlarmasTacoa']['Usuario']['perfil'] = $perfil;
				$_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] = $usuario;
			}
			?>
			<script>
			alert('!Se han modificado los datos del usuario satisfactoriamente');
			$("#divSesion").load("sesion/cerrar.php", {});
			$("#divMenuVertical").load("estructura/menuvertical.php", {});
			$("#divAdmin").load("_ajax/consultarUsuario.php", {accion : 'limpiar'});
			$("#divListado").load("_ajax/consultarUsuario.php", {accion : 'limpiar'});
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
	}
	elseif ($accion == 'eliminar')
	{
		$usuario = $_REQUEST['usuario'];
		
		$resultadof = EliminarUsuario($usuario);
			
		if ($resultadof['CodError'] == 0) 
		{
			if ($usuario == $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'])
			{
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
				
				?>
				<script type="text/javascript">
				alert('!Se ha eliminado el usuario satisfactoriamente y se cerrará su sesión');
				$("#divCuerpo").load("informacion/mision.php", {});
				$("#divMenuVertical").load("estructura/menuvertical.php", {});
				$("#divSesion").load("sesion/iniciar.php", {});
				</script>
				<?php
				exit();
			}
			else
			{
				?>
				<script type="text/javascript">
				alert('!Se ha eliminado el usuario satisfactoriamente');
				$("#divMenuVertical").load("estructura/menuvertical.php", {});
				$("#divAdmin").load("_ajax/consultarUsuario.php", {accion : 'limpiar'});
				$("#divListado").load("_ajax/consultarUsuario.php", {accion : 'limpiar'});
				</script>
				<?php
				exit();
			}
		}
		else
		{
			?>
			<script>
			alert('No existe registro para la busqueda');
			</script>
			<?php
			exit();
		}
	}
	
