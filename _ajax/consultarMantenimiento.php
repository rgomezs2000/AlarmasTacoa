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
		$dispositivo = $_REQUEST['dispositivo'];
		$descripcion = $_REQUEST['descripcion'];
		$sistema = $_REQUEST['sistema'];
		
		$resultadof = BuscarMantenimiento_Parametros($codigoalarmahmi, $dispositivo, $descripcion, $sistema, 'SI');
			
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

			$resultadof = BuscarMantenimiento_Parametros_Ind($codigoalarmahmi, $dispositivo, $descripcion, $sistema, 'SI', $registros, $inicio);
			
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
                  <td height='40' width='225' align='left'>Dispositivo</td>
                  <td height='40' width='225' align='left'>Descripción</td>
                  <td height='40' width='225' align='left'>Sistema</td>
                  <td height='40' width='100' align='center'>&nbsp;</td>
                </tr>
            <?php

			$classRegistro = 'textRegistroGris';
			for($i=0;$i<$resultadof['registros']['cantidad'];$i++)
			{
				?>
                <tr class='<?php echo $classRegistro; ?>'>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['codigoalarmahmi']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['dispositivo']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['descripcion']; ?></td>
				  <td height='40' width='225' align='left'><?php echo $resultadof[$i]['sistema']; ?></td>
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
                    
                    $("#divAdmin").load("_ajax/consultarMantenimiento.php", {accion : 'vermas', codigoalarmahmi : codigoalarmahmi});
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
					dispositivo = document.getElementById("dispositivo").value;
					descripcion = document.getElementById("descripcion").value;
					sistema = document.getElementById("sistema").value;
					$("#divListado").load("_ajax/consultarMantenimiento.php", {accion : 'listar', codigoalarmahmi : codigoalarmahmi, dispositivo : dispositivo, descripcion : descripcion, sistema : sistema, pagina : pagina});
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
		
		$resultadof = BuscarMantenimiento_codigoalarmahmi($codigoalarmahmi);
			
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
                                                  <td height='40' width='225' align='left' class='text2'>&nbsp;</td>
                                                  <td height='40' align='left' ><img src="<?php echo ($resultadof['fotos']); ?>" width="150" height="150"></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Código Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['codigoalarmahmi']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Dispositivo:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['dispositivo']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Descripción:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['descripcion']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Sistema:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['sistema']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Cable N°:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['cable_num_1']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Campo Caja de Conexiones N°:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['caja_conexiones']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Wire N°:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['cable_num_2']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Localización:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mk_vi']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK V ITB Screw:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mk_v']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Point Name:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['point_name']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>VME Card:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['vme_card']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Rack:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mk_vi_rack']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI VME Jack:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mk_vi_vme_jack']; ?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Signal Name:</td>
                                                  <td height='40' align='left' class='text2'><?php echo $resultadof['mk_vi_signal_name']; ?></td>
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
                    
                    $("#divAdmin").load("_ajax/consultarMantenimiento.php", {accion : 'modificar', codigoalarmahmi : codigoalarmahmi});
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
						$("#divAdmin").load("_ajax/consultarMantenimiento.php", {accion : 'eliminar', codigoalarmahmi : codigoalarmahmi});
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
		
		$resultadof = BuscarMantenimiento_codigoalarmahmi($codigoalarmahmi);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
											<input type="hidden" id="codigoalarmahmiactual" name="codigoalarmahmiactual" class="textfonBlanco" value="<?php echo $resultadof['dispositivo']; ?>"/>
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
                                                  <td height='40' width='225' align='left' class='text2'>&nbsp;</td>
                                                  <td height='40' align='left' ><img src="<?php echo ($resultadof['fotos']); ?>" width="150" height="150"></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Código Alarma HMI:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="codigoalarmahmi2" name="codigoalarmahmi2" class="textfonBlanco" value="<?php echo $resultadof['codigoalarmahmi']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Dispositivo:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="dispositivo2" name="dispositivo2" class="textfonBlanco" value="<?php echo $resultadof['dispositivo']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Descripción:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="descripcion2" name="descripcion2" class="textfonBlanco" value="<?php echo $resultadof['descripcion']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Sistema:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="sistema2" name="sistema2" class="textfonBlanco" value="<?php echo $resultadof['sistema']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Cable N°:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="cable_num_12" name="cable_num_12" class="textfonBlanco" value="<?php echo $resultadof['cable_num_1']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Campo de la caja de conexiones N°:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="caja_conexiones2" name="caja_conexiones2" class="textfonBlanco" value="<?php echo $resultadof['caja_conexiones']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Wire N°:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="cable_num_22" name="cable_num_22" class="textfonBlanco" value="<?php echo $resultadof['cable_num_2']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Localización:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mk_vi2" name="mk_vi2" class="textfonBlanco" value="<?php echo $resultadof['mk_vi']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK V ITB Screw:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mk_v2" name="mk_v2" class="textfonBlanco" value="<?php echo $resultadof['mk_v']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>Point Name:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="point_name2" name="point_name2" class="textfonBlanco" value="<?php echo $resultadof['point_name']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>VME Card:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="vme_card2" name="vme_card2" class="textfonBlanco" value="<?php echo $resultadof['vme_card']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Rack:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mk_vi_rack2" name="mk_vi_rack2" class="textfonBlanco" value="<?php echo $resultadof['mk_vi_rack']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI VME Jack:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mk_vi_vme_jack2" name="mk_vi_vme_jack2" class="textfonBlanco" value="<?php echo $resultadof['mk_vi_vme_jack']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>MK VI Signal Name:</td>
                                                  <td height='40' align='left' class='text2'><input type="text" id="mk_vi_signal_name2" name="mk_vi_signal_name2" class="textfonBlanco" value="<?php echo $resultadof['mk_vi_signal_name']; ?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height='40' width='225' align='left' class='text2'>&nbsp;</td>
                                                  <td height='40' align='left' class='text2'><input type="hidden" id="fotos2" name="fotos2" class="textfonBlanco" value="<?php echo $resultadof['fotos']; ?>"/></td>
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
					if (document.getElementById("dispositivo2").value == "")
					{
						errMsg +="- El campo dispositivo es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("descripcion2").value == "")
					{
						errMsg +="- El campo Descripción es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("sistema2").value == "")
					{
						errMsg +="- El campo Sistema es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("cable_num_12").value == "")
					{
						errMsg +="- El campo Cable N° es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("caja_conexiones2").value == "")
					{
						errMsg +="- El campo Campo caja de conexiones N° es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("cable_num_22").value == "")
					{
						errMsg +="- El campo Wire N° es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mk_vi2").value == "")
					{
						errMsg +="- El campo MK VI Localización es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mk_v2").value == "")
					{
						errMsg +="- El campo MK V ITB Screw es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("point_name2").value == "")
					{
						errMsg +="- El campo Point Name es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("vme_card2").value == "")
					{
						errMsg +="- El campo VME Card es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mk_vi_rack2").value == "")
					{
						errMsg +="- El campo MK VI Rack es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mk_vi_vme_jack2").value == "")
					{
						errMsg +="- El campo MK VI VME Jack es requerido.\n";
						isOk = false;
					}
					if (document.getElementById("mk_vi_signal_name2").value == "")
					{
						errMsg +="- El campo MK VI Signal Name es requerido.\n";
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
						dispositivo = document.getElementById("dispositivo2").value;
						descripcion = document.getElementById("descripcion2").value;
						sistema = document.getElementById("sistema2").value;
						cable_num_1 = document.getElementById("cable_num_12").value;
						caja_conexiones = document.getElementById("caja_conexiones2").value;
						cable_num_2 = document.getElementById("cable_num_22").value;
						mk_vi = document.getElementById("mk_vi2").value;
						mk_v = document.getElementById("mk_v2").value;
						point_name = document.getElementById("point_name2").value;
						vme_card = document.getElementById("vme_card2").value;
						mk_vi_rack = document.getElementById("mk_vi_rack2").value;
						mk_vi_vme_jack = document.getElementById("mk_vi_vme_jack2").value;
						mk_vi_signal_name = document.getElementById("mk_vi_signal_name2").value;
						fotos = document.getElementById("fotos2").value;
						
						
						fResultado = confirm('¿Estas seguro que deseas guardar los cambios?');
						if (fResultado)
						{
							$("#divControlador").load("_ajax/consultarMantenimiento.php", {accion : 'guardar', codigoalarmahmiactual : codigoalarmahmiactual, codigoalarmahmi : codigoalarmahmi, dispositivo : dispositivo, descripcion : descripcion, sistema : sistema, cable_num_1 : cable_num_1, caja_conexiones : caja_conexiones, cable_num_2 : cable_num_2, mk_vi : mk_vi, mk_v : mk_v, point_name : point_name, vme_card : vme_card, mk_vi_rack : mk_vi_rack, mk_vi_vme_jack : mk_vi_vme_jack, mk_vi_signal_name : mk_vi_signal_name, fotos : fotos});
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
		$fotos = $_REQUEST['fotos'];
	
		$resultadof = ModificarMantenimiento($codigoalarmahmiactual, $codigoalarmahmi, $dispositivo, $descripcion, $sistema, $cable_num_1, $caja_conexiones, $cable_num_2, $mk_vi, $mk_v, $point_name, $vme_card, $mk_vi_rack, $mk_vi_vme_jack, $mk_vi_signal_name, $fotos);
		if ($resultadof['CodError'] == 0)
		{
			?>
			<script>
			alert('!Se han modificado los datos de la alarma satisfactoriamente');
			$("#divSesion").load("sesion/cerrar.php", {});
			$("#divMenuVertical").load("estructura/menuvertical.php", {});
			$("#divAdmin").load("_ajax/consultarMantenimiento.php", {accion : 'limpiar'});
			$("#divListado").load("_ajax/consultarMantenimiento.php", {accion : 'limpiar'});
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
		
		$resultadof = EliminarMantenimiento($codigoalarmahmi);
			
		if ($resultadof['CodError'] == 0) 
		{
			?>
			<script type="text/javascript">
			alert('!Se ha eliminado la alarma satisfactoriamente');
			$("#divMenuVertical").load("estructura/menuvertical.php", {});
			$("#divAdmin").load("_ajax/consultarMantenimiento.php", {accion : 'limpiar'});
			$("#divListado").load("_ajax/consultarMantenimiento.php", {accion : 'limpiar'});
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
	
