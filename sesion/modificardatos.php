<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'DATOS DEL USUARIO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/administrador.jpg" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fModificarDatos(event);">
                                <table align="center" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="0" valign="top">
<p class="text2">&nbsp;</p></td>
                                                  <td valign="top" class="error"><div id="crearUsuario">&nbsp;</div></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">NOMBRES:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="nombres" name="nombres" class="textfonBlanco" value="<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['nombres'];?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">APELLIDOS:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="apellidos" name="apellidos" class="textfonBlanco" value="<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'];?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">CORREO INSTITUCIONAL:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">EXTENSION:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="extension" name="extension" class="textfonBlanco" value="<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['extension'];?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">UBICACION:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="ubicacion" name="ubicacion" class="textfonBlanco" value="<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'];?>"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">SEDE:</td>
                                                  <td height="40" align="left" class="text2"><select name='sede' id='sede' class='textfonBlanco'>
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
                                                  <td height="40" width="225" align="left" class="text2">PERFIL:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['perfil'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">USUARIO:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="imgGuardarUsuario" id="imgGuardarUsuario" type="image" src="_imagenes/guardar.png" alt="guardar" width="60" height="19" onMouseOut="fCambiarImagen('imgGuardarUsuario', 'guardar.png');" onMouseMove="fCambiarImagen('imgGuardarUsuario', 'guardar_03.png');" onClick="fCambiarImagen('imgGuardarUsuario', 'guardar_02.png');fModificarDatos(event);"></td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                          </table>
                                      </td>
                                    </tr>
                                </table>
</form>
<script type="text/javascript">

	document.getElementById('sede').value = '<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['sede'];?>';
	
	function fModificarDatos(e)
	{
		nombres = document.getElementById('nombres').value;
		apellidos = document.getElementById('apellidos').value;
		extension = document.getElementById('extension').value;
		ubicacion = document.getElementById('ubicacion').value;
		sede = document.getElementById('sede').value;
		$("#divControlador").load("_ajax/modificarDatos.php", {nombres: nombres, apellidos: apellidos, extension: extension, ubicacion: ubicacion, sede : sede});
		fDetenerEvento(e);
	}
	
</script>
