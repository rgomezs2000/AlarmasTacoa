<script>
document.getElementById('divTitulo').innerHTML = 'SOLICITUD DE CREACION DE USUARIO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/correo.jpg" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fActivarEvento(event);">
<p class="textSubTitulo">
¿Para qué tener una cuenta en el Sistema Alarmas Tacoa?
</p>
<p class="text2">Con la creación de una cuenta en el Sistema Alarmas TACOA, usted podrá disfrutar de los servicios de Chat y Foro para contactar a los administradores en línea o para ver temas y realizar diversos comentarios que ayuden a mejorar el servicio brindado.</p>
<p>&nbsp;</p>
<p class="textSubTitulo">
Solicite su cuenta:
</p>
<p class="text2">Solicitar su cuenta es fácil, sólo deberás completar este formulario y los administradores del sistema le estarán contactando para completar la creación de la cuenta:</p><br/>
    <table cellpadding="0" cellspacing="0" border="0" width="100%" align="center">
        <tr>
            <td class="text2" width="150">
            	Nombres y Apellidos:
            </td>
            <td>
            	<input type="text" id="nombresapellidos" name="nombresapellidos" class="textfonBlanco" />
            </td>
        </tr>
        <tr>
            <td class="text2">
            	Correo institucional:
            </td>
            <td>
            	<input type="text" id="correo_institucional" name="correo_institucional" class="textfonBlanco" />
            </td>
        </tr>
        <tr>
            <td class="text2">
            	Tlf. Contacto:
            </td>
            <td>
            	<input type="text" id="contacto" name="contacto" class="textfonBlanco" />
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
		if (document.getElementById("nombresapellidos").value == ""){
			errMsg +="- El campo nombres y apellidos es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("correo_institucional").value == ""){
			errMsg +="- El campo correo institucional es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("contacto").value == ""){
			errMsg +="- El campo tfl. contacto es requerido.\n";
			isOk = false;
		}
		
		if (!isOk)
		{	
			alert(errMsg);
			fDetenerEvento(e);
		}
		else
		{
			nombresapellidos = document.getElementById('nombresapellidos').value;
			correo_institucional = document.getElementById('correo_institucional').value;
			contacto = document.getElementById('contacto').value;
			$("#divControlador").load("_ajax/solicitudUsuario.php", {nombresapellidos: nombresapellidos, correo_institucional: correo_institucional, contacto : contacto});
			fDetenerEvento(e);
		}
		
	}
	
</script>
                                                                    
