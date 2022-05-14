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
		$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
		$mensajealarmahmi = $_REQUEST['mensajealarmahmi'];
		$causasposibles = $_REQUEST['causasposibles'];
		$respuesta = $_REQUEST['respuesta'];
		
		$resultadof = BuscarAlarmas_Parametros($codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta, 'SI');
			
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

			$resultadof = BuscarAlarmas_Parametros_Ind($codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta, 'SI', $registros, $inicio);
			
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
                  <td height='40' width='225' align='left'>Código Alarma HMI</td>
                  <td height='40' width='225' align='left'>Mensaje Alarma HMI</td>
                  <td height='40' width='225' align='left'>Causas Posibles</td>
                  <td height='40' width='225' align='left'>Respuesta</td>
                  <td height='40' width='100' align='center'>&nbsp;</td>
                </tr>
            <?php

			$classRegistro = 'textRegistroGris';
			for($i=0;$i<$resultadof['registros']['cantidad'];$i++)
			{
				?>
                <tr class='<?php echo $classRegistro; ?>'>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['codigoalarmahmi']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['mensajealarmahmi']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['causasposibles']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['respuesta']; ?></td>
				  <td height='40' width='100' align='center'><a href='JavaScript:fVerMas(10000, "<?php echo $resultadof[$i]['codigoalarmahmi']; ?>");' title='Ver más'>Ver más</a></td>
				
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
            
                function fVerMas(e, codigoalarmahmi)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
                    $("#divAdmin").load("_ajax/consultarAlarma.php", {accion : 'vermas', codigoalarmahmi : codigoalarmahmi});
                    fDetenerEvento(e);
                }
                
				function fListar(e, pagina)
				{
					var errMsg;
					var isOk;
					var pass;
					errMsg="";  
					
					isOk = true;
					codigoalarmahmi = document.getElementById("codigoalarmahmi").value;
					mensajealarmahmi = document.getElementById("mensajealarmahmi").value;
					causasposibles = document.getElementById("causasposibles").value;
					respuesta = document.getElementById("respuesta").value;
					$("#divListado").load("_ajax/consultarAlarma.php", {accion : 'listar', codigoalarmahmi : codigoalarmahmi, mensajealarmahmi : mensajealarmahmi, causasposibles : causasposibles, respuesta : respuesta, pagina : pagina});
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
		$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
		
		$resultadof = BuscarAlarma_codigoalarmahmi($codigoalarmahmi);
			
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
                                          DATOS DE LA ALARMA
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
                                                  <td height='40' width='225' align='left' class='text2'>Código Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['codigoalarmahmi']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Mensaje Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mensajealarmahmi']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Causas Posibles:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['causasposibles']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Respuesta:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['respuesta']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td><input name='imgModificar' id='imgModificar' type='image' src='_imagenes/modificar.png' alt='modificar' width='60' height='19' onMouseOut='fCambiarImagen("imgModificar", "modificar.png");' onMouseMove='fCambiarImagen("imgModificar", "modificar_03.png");' onClick='fCambiarImagen("imgModificar", "modificar_02.png");fModificar(event,"<?php echo $resultadof['codigoalarmahmi']; ?>");'>
                                                    </td>
                                                    <td><div id='btnEliminar'><input name='imgEliminar' id='imgEliminar' type='image' src='_imagenes/eliminar.png' alt='eliminar' width='60' height='19' onMouseOut='fCambiarImagen("imgEliminar", "eliminar.png");' onMouseMove='fCambiarImagen("imgEliminar", "eliminar_03.png");' onClick='fCambiarImagen("imgEliminar", "eliminar_02.png");fEliminar(event,"<?php echo $resultadof['codigoalarmahmi']; ?>");'></div></td>
                                                    <td align='right'>&nbsp;</td>
                                                </tr>
            								</table>
                                        </td>
                                    </tr>
								</table>
			<script type="text/javascript">
            
                function fModificar(e, codigoalarmahmi)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
                    $("#divAdmin").load("_ajax/consultarAlarma.php", {accion : 'modificar', codigoalarmahmi : codigoalarmahmi});
                    fDetenerEvento(e);
                }
                
                function fEliminar(e, codigoalarmahmi)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
                    
					fResultado = confirm('¿Estas seguro que deseas eliminar esta alarma?');
					if (fResultado)
					{
						$("#divAdmin").load("_ajax/consultarAlarma.php", {accion : 'eliminar', codigoalarmahmi : codigoalarmahmi});
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
		$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
		
		$resultadof = BuscarAlarma_codigoalarmahmi($codigoalarmahmi);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
											<input type="hidden" id="codigoalarmahmiactual" name="codigoalarmahmiactual" class="textfonBlanco" value="<?php echo $resultadof['codigoalarmahmi']; ?>"/>
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
                                          DATOS DE LA ALARMA
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
                                                  <td height='40' width='225' align='left' class='text2'>Código Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="codigoalarmahmi2" name="codigoalarmahmi2" class="textfonBlanco" value="<?php echo $resultadof['codigoalarmahmi']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Mensaje Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mensajealarmahmi2" name="mensajealarmahmi2" class="textfonBlanco" value="<?php echo $resultadof['mensajealarmahmi']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Causas Posibles:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="causasposibles2" name="causasposibles2" class="textfonBlanco" value="<?php echo $resultadof['causasposibles']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Respuesta:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="respuesta2" name="respuesta2" class="textfonBlanco" value="<?php echo $resultadof['respuesta']; ?>"/></td>
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
            
				function fGuardar(e)
                {
                    var errMsg;
                    var isOk;
                    var pass;
                    errMsg="";  
                    
                    isOk = true;
								
					if (document.getElementById("codigoalarmahmi2").value == "")
					{
						errMsg +="- El campo Código Alarma HMI es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mensajealarmahmi2").value == "")
					{
						errMsg +="- El campo Mensaje Alarma HMI es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("causasposibles2").value == "")
					{
						errMsg +="- El campo Causas Posibles es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("respuesta2").value == "")
					{
						errMsg +="- El campo Respuesta es requerido.\n";
						isOk = false;
					}
					
					if (!isOk)
					{	
						alert(errMsg);
						fDetenerEvento(e);
					}
					else
					{
						codigoalarmahmiactual = document.getElementById("codigoalarmahmiactual").value;
						codigoalarmahmi = document.getElementById("codigoalarmahmi2").value;
						mensajealarmahmi = document.getElementById("mensajealarmahmi2").value;
						causasposibles = document.getElementById("causasposibles2").value;
						respuesta = document.getElementById("respuesta2").value;
						
						
						fResultado = confirm('¿Estas seguro que deseas guardar los cambios?');
						if (fResultado)
						{
							$("#divControlador").load("_ajax/consultarAlarma.php", {accion : 'guardar', codigoalarmahmiactual : codigoalarmahmiactual, codigoalarmahmi : codigoalarmahmi, mensajealarmahmi : mensajealarmahmi, causasposibles : causasposibles, respuesta : respuesta});
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
		$codigoalarmahmiactual = $_REQUEST['codigoalarmahmiactual'];
		$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
		$mensajealarmahmi = $_REQUEST['mensajealarmahmi'];
		$causasposibles = $_REQUEST['causasposibles'];
		$respuesta = $_REQUEST['respuesta'];
	
		$resultadof = ModificarAlarma($codigoalarmahmiactual, $codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta);
		if ($resultadof['CodError'] == 0)
		{
			?>
			<script>
			alert('!Se han modificado los datos de la alarma satisfactoriamente');
			$("#divSesion").load("sesion/cerrar.php", {});
			$("#divMenuVertical").load("estructura/menuvertical.php", {});
			$("#divAdmin").load("_ajax/consultarAlarma.php", {accion : 'limpiar'});
			$("#divListado").load("_ajax/consultarAlarma.php", {accion : 'limpiar'});
			</script>
			<?php
			exit();
		}
		else
		{
			?>
			<script>
			alert('!Ha ocurrido una falla guardando la alarma. Contacte al administrador del Sistema');
			</script>
			<?php
			exit();
		}
	}
	elseif ($accion == 'eliminar')
	{
		$codigoalarmahmi = $_REQUEST['codigoalarmahmi'];
		
		$resultadof = EliminarAlarma($codigoalarmahmi);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
			<script type="text/javascript">
			alert('!Se ha eliminado la alarma satisfactoriamente');
			$("#divMenuVertical").load("estructura/menuvertical.php", {});
			$("#divAdmin").load("_ajax/consultarAlarma.php", {accion : 'limpiar'});
			$("#divListado").load("_ajax/consultarAlarma.php", {accion : 'limpiar'});
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
	
