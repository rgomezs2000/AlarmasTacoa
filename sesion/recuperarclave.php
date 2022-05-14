<script>
document.getElementById('divTitulo').innerHTML = 'RECUPERACION DE CONTRASEÑA';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/correo.jpg" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fActivarEvento(event);">
<p class="textSubTitulo">
¿Olvidó su contraseña?
</p>
<p>&nbsp;</p>
<p class="text2">Ingrese su cuenta de correo institucional y su contraseña le será enviada de inmediato:</p><br/>
    <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
        <tr>
            <td class="text2">
            	Correo institucional:
            </td>
            <td>
            	<input type="text" id="correo_institucional" name="correo_institucional" class="textfonBlanco" />
            </td>
        </tr>
        <tr>
            <td class="text2">&nbsp;
            </td>
            <td>
            	<input name="imgEnviarCorreo" id="imgEnviarCorreo" type="image" src="_imagenes/enviar.png" alt="enviar correo" width="60" height="19" onMouseOut="fCambiarImagen('imgEnviarCorreo', 'enviar.png');" onMouseMove="fCambiarImagen('imgEnviarCorreo', 'enviar_03.png');" onClick="fCambiarImagen('imgEnviarCorreo', 'enviar_02.png');fActivarEvento(event);">
            </td>
        </tr>
    </table>
</form>
<script type="text/javascript">

	function fActivarEvento(e)
	{
		var errMsg;
		var isOk;
		var pass;
		errMsg="";  
		
		isOk = true;
		if (document.getElementById("correo_institucional").value == ""){
			errMsg +="- El campo correo institucional es requerido.\n";
			isOk = false;
		}
		
		if (!isOk)
		{	
			alert(errMsg);
			fDetenerEvento(e);
		}
		else
		{
			correo_institucional = document.getElementById('correo_institucional').value;
			$("#divControlador").load("_ajax/recuperarClave.php", {correo_institucional: correo_institucional});
			fDetenerEvento(e);
		}
		
	}
	
</script>
                                                                    
