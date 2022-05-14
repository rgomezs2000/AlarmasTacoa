<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CREACIÓN DE USUARIO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/usuario.png" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fGuardarUsuario(event);">
                                <table align="center" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="40" valign="top">
<p class="text2">INGRESE LOS SIGUIENTES DATOS:</p></td>
                                                  <td valign="top" class="error"><div id="crearUsuario">&nbsp;</div></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">NOMBRES:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="nombres" name="nombres" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">APELLIDOS:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="apellidos" name="apellidos" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">CORREO INSTITUCIONAL:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="correo_institucional" name="correo_institucional" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">EXTENSION:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="extension" name="extension" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">UBICACION:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="ubicacion" name="ubicacion" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                            	  <td height="40" align="left" class="text2">SEDE:</td>
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
                                                  <td height="40" align="left" class="text2"><select name='perfil' id='perfil' class='textfonBlanco'>
				<option value='usuario'>usuario</option>
				<option value='administrador'>administrador</option>
				<option value='operador'>operador</option>
				<option value='soporte'>soporte</option>
				<option value='supervisor'>supervisor</option>
		</select></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">USUARIO:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="usuario" name="usuario" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">CLAVE:</td>
                                                  <td height="40" align="left" class="text2"><input type="password" id="clave" name="clave" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">CONFIRMA CLAVE:</td>
                                                  <td height="40" align="left" class="text2"><input type="password" id="confirmaclave" name="confirmaclave" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="imgGuardarUsuario" id="imgGuardarUsuario" type="image" src="_imagenes/guardar.png" alt="guardar" width="60" height="19" onMouseOut="fCambiarImagen('imgGuardarUsuario', 'guardar.png');" onMouseMove="fCambiarImagen('imgGuardarUsuario', 'guardar_03.png');" onClick="fCambiarImagen('imgGuardarUsuario', 'guardar_02.png');fGuardarUsuario(event);"></td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                          </table>
                                      </td>
                                    </tr>
                                </table>
</form>
<script type="text/javascript">

	function fGuardarUsuario(e)
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
		if (document.getElementById("correo_institucional").value == "")
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
		if (document.getElementById("usuario").value == "")
		{
			errMsg +="- El campo usuario es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("clave").value == "")
		{
			errMsg +="- El campo clave es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("confirmaclave").value == "")
		{
			errMsg +="- El campo confirmar clave es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("clave").value != "" && document.getElementById("confirmaclave").value != "")
		{
			if (document.getElementById("clave").value != document.getElementById("confirmaclave").value)
			{
				errMsg +="- El campo clave y confirmar clave deben ser iguales.\n";
				isOk = false;
			}
		}
		
		if (!isOk)
		{	
			alert(errMsg);
			fDetenerEvento(e);
		}
		else
		{
			nombres = document.getElementById("nombres").value;
			apellidos = document.getElementById("apellidos").value;
			correo_institucional = document.getElementById("correo_institucional").value;
			extension = document.getElementById("extension").value;
			ubicacion = document.getElementById("ubicacion").value;
			sede = document.getElementById("sede").value;
			perfil = document.getElementById("perfil").value;
			usuario = document.getElementById("usuario").value;
			clave = document.getElementById("clave").value;
			
			$("#divControlador").load("_ajax/crearUsuario.php", {nombres : nombres, apellidos : apellidos, correo_institucional : correo_institucional, extension : extension, ubicacion : ubicacion, sede : sede, perfil : perfil, usuario : usuario, clave : clave});
			fDetenerEvento(e);
		}
	}
	
</script>
