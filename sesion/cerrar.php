<?php
if (!isset ($_SESSION)) {
	session_start();
}
if ($_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] == '')
{
	?>
	<script type="text/javascript">
		$("#divSesion").load("sesion/iniciar.php", {});
	</script>
	<?php
}

?>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr height="30" valign="middle">
                                          <td>&nbsp;
                                                
                                            </td>
                                          <td class="text2" width="120" align="center">
                                                <?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['perfil'];?>
                                            </td>
                                            <td class="text2" width="120" align="center">
                                            	<?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['nombres'];?>
                                            </td>
                                            <td class="text2" width="120" align="center">
                                                <?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'];?>
                                            </td>
                                            <td align="left" width="120">&nbsp;</td>
                                        </tr>
                                        <tr height="30" valign="middle">
                                            <td>&nbsp;
                                                
                                            </td>
                                            <td class="text2"><input name="imgVerDatos" id="imgVerDatos" type="image" src="_imagenes/verdatos.png" alt="ver datos" width="120" height="19" onmouseout="fCambiarImagen('imgVerDatos', 'verdatos.png');" onmousemove="fCambiarImagen('imgVerDatos', 'verdatos_03.png');" onclick="fCambiarImagen('imgVerDatos', 'verdatos_02.png');fCargarCuerpo('sesion/verdatos.php');" /></td>
                                            <td><input name="imgModificarDatos" id="imgModificarDatos" type="image" src="_imagenes/modificardatos.png" alt="modificar datos" width="120" height="19" onmouseout="fCambiarImagen('imgModificarDatos', 'modificardatos.png');" onmousemove="fCambiarImagen('imgModificarDatos', 'modificardatos_03.png');" onclick="fCambiarImagen('imgModificarDatos', 'modificardatos_02.png');fCargarCuerpo('sesion/modificardatos.php');" /></td>
                                            <td class="text2"><input name="imgCambiarClave" id="imgCambiarClave" type="image" src="_imagenes/cambiarclave.png" alt="cambiar clave" width="120" height="19" onmouseout="fCambiarImagen('imgCambiarClave', 'cambiarclave.png');" onmousemove="fCambiarImagen('imgCambiarClave', 'cambiarclave_03.png');" onclick="fCambiarImagen('imgCambiarClave', 'cambiarclave_02.png');fCargarCuerpo('sesion/cambiarclave.php');" /></td>
                                            <td class="text2"><input name="imgCerrarSesion" id="imgCerrarSesion" type="image" src="_imagenes/cerrarsesion.png" alt="cerrar sesión" width="120" height="19" onmouseout="fCambiarImagen('imgCerrarSesion', 'cerrarsesion.png');" onmousemove="fCambiarImagen('imgCerrarSesion', 'cerrarsesion_03.png');" onclick="fCambiarImagen('imgCerrarSesion', 'cerrarsesion_02.png');fCerrarSesion();" /></td>
                                        </tr>
                                    </table>
<script type="text/javascript">

	function fCerrarSesion()
	{
		$("#divSesion").load("_ajax/cerrarSesion.php", {});
	}
	
</script>
