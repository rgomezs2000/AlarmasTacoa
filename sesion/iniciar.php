<?php
if (!isset ($_SESSION)) {
	session_start();
}
if ($_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] == '')
{
?>
<form id="form1" name="form1" action="fIniciarSesion(event);">
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr height="30" valign="middle">
                                          <td width="400">&nbsp;
                                                
                                            </td>
                                            <td class="text2">Usuario
                                            
                                            </td>
                                            <td><input type="text" id="usuario" name="usuario" class="textfonBlancoCorto" />
                                                
                                            </td>
                                            <td align="left"><input name="imgEntrar" id="imgEntrar" type="image" src="_imagenes/entrar.png" alt="entrar" width="60" height="19" onMouseOut="fCambiarImagen('imgEntrar', 'entrar.png');" onMouseMove="fCambiarImagen('imgEntrar', 'entrar_03.png');" onClick="fIniciarSesion(event);">
                                                
                                            </td>
                                        </tr>
                                        <tr height="30" valign="middle">
                                            <td>&nbsp;
                                                
                                            </td>
                                            <td class="text2">Contraseña
                                                
                                            </td>
                                            <td><input type="password" id="clave" name="clave" class="textfonBlancoCorto"/>
                                                
                                            </td>
                                            <td class="text2"><a href="JavaScript:fCargarCuerpo('sesion/recuperarclave.php');">¿Olvidó su contraseña?</a>
                                                
                                            </td>
                                        </tr>
                                    </table>
</form>
<script type="text/javascript">

	function fIniciarSesion(e)
	{
		var errMsg;
		var isOk;
		var pass;
		errMsg="";  
		
		isOk = true;
		if (document.getElementById("usuario").value == ""){
			errMsg +="- El campo usuario es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("clave").value == ""){
			errMsg +="- El campo contraseña es requerido.\n";
			isOk = false;
		}
		
		if (!isOk)
		{	
			alert(errMsg);
			fDetenerEvento(e);
		}
		else
		{
			usuario = document.getElementById('usuario').value;
			clave = document.getElementById('clave').value;
			$("#divControlador").load("_ajax/iniciarSesion.php", {usuario: usuario, clave: clave});
			fDetenerEvento(e);
		}
		
	}
	
</script>
<?php
}
else
{
	require_once 'sesion/cerrar.php';
}

?>

