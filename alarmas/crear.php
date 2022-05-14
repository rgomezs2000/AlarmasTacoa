<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CREACIÓN DE ALARMA OPERATIVA';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/usuario.png" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fGuardarAlarma(event);">
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
                                                  <td height="40" width="225" align="left" class="text2">Código Alarma HMI:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="codigoalarmahmi" name="codigoalarmahmi" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Mensaje Alarma HMI:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mensajealarmahmi" name="mensajealarmahmi" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Causas Posibles:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="causasposibles" name="causasposibles" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Respuesta:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="respuesta" name="respuesta" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="imgGuardarUsuario" id="imgGuardarUsuario" type="image" src="_imagenes/guardar.png" alt="guardar" width="60" height="19" onMouseOut="fCambiarImagen('imgGuardarUsuario', 'guardar.png');" onMouseMove="fCambiarImagen('imgGuardarUsuario', 'guardar_03.png');" onClick="fCambiarImagen('imgGuardarUsuario', 'guardar_02.png');fGuardarAlarma(event);"></td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                          </table>
                                      </td>
                                    </tr>
                                </table>
</form>
<script type="text/javascript">

	function fGuardarAlarma(e)
	{
		var errMsg;
		var isOk;
		var pass;
		errMsg="";  
		
		isOk = true;
		if (document.getElementById("codigoalarmahmi").value == "")
		{
			errMsg +="- El campo Código Alarma HMI es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mensajealarmahmi").value == "")
		{
			errMsg +="- El campo Mensaje Alarma HMI es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("causasposibles").value == "")
		{
			errMsg +="- El campo Causas Posibles es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("respuesta").value == "")
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
			codigoalarmahmi = document.getElementById("codigoalarmahmi").value;
			mensajealarmahmi = document.getElementById("mensajealarmahmi").value;
			causasposibles = document.getElementById("causasposibles").value;
			respuesta = document.getElementById("respuesta").value;
			
			$("#divControlador").load("_ajax/crearAlarma.php", {codigoalarmahmi : codigoalarmahmi, mensajealarmahmi : mensajealarmahmi, causasposibles : causasposibles, respuesta : respuesta});
			fDetenerEvento(e);
		}
	}
	
</script>
