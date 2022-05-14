<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CREACIÓN DE ALARMA DE MANTENIMIENTO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/usuario.png" width="180" height="180">';
</script>
<form id="form1" name="form1" method="post" action="fGuardarAlarma(event);" enctype="multipart/form-data">
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
                                                  <td height="40" width="225" align="left" class="text2">Dispositivo:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="dispositivo" name="dispositivo" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Descripción:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="descripcion" name="descripcion" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Sistema:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="sistema" name="sistema" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Cable N°:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="cable_num_1" name="cable_num_1" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Campo de la caja de conexiones N°:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="caja_conexiones" name="caja_conexiones" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Wire N°:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="cable_num_2" name="cable_num_2" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">MK VI Localización:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mk_vi" name="mk_vi" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">MK V ITB Screw:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mk_v" name="mk_v" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Point Name:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="point_name" name="point_name" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">VME Card:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="vme_card" name="vme_card" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">MK VI Rack:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mk_vi_rack" name="mk_vi_rack" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">MK VI VME Jack:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mk_vi_vme_jack" name="mk_vi_vme_jack" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">MK VI Signal Name:</td>
                                                  <td height="40" align="left" class="text2"><input type="text" id="mk_vi_signal_name" name="mk_vi_signal_name" class="textfonBlanco"/></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Fotos:</td>
                                                  <td height="40" align="left" class="text2"><input id="fotos" name="fotos" type="file" class="textfonBlanco"/></td>
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
		if (document.getElementById("dispositivo").value == "")
		{
			errMsg +="- El campo dispositivo es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("descripcion").value == "")
		{
			errMsg +="- El campo Descripción es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("sistema").value == "")
		{
			errMsg +="- El campo Sistema es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("cable_num_1").value == "")
		{
			errMsg +="- El campo Cable N° es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("caja_conexiones").value == "")
		{
			errMsg +="- El campo Campo caja de conexiones N° es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("cable_num_2").value == "")
		{
			errMsg +="- El campo Wire N° es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mk_vi").value == "")
		{
			errMsg +="- El campo MK VI Localización es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mk_v").value == "")
		{
			errMsg +="- El campo MK V ITB Screw es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("point_name").value == "")
		{
			errMsg +="- El campo Point Name es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("vme_card").value == "")
		{
			errMsg +="- El campo VME Card es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mk_vi_rack").value == "")
		{
			errMsg +="- El campo MK VI Rack es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mk_vi_vme_jack").value == "")
		{
			errMsg +="- El campo MK VI VME Jack es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("mk_vi_signal_name").value == "")
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
			document.form1.action="_ajax/crearMantenimiento.php";
			document.form1.submit();
/*
			codigoalarmahmi = document.getElementById("codigoalarmahmi").value;
			dispositivo = document.getElementById("dispositivo").value;
			descripcion = document.getElementById("descripcion").value;
			sistema = document.getElementById("sistema").value;
			cable_num_1 = document.getElementById("cable_num_1").value;
			caja_conexiones = document.getElementById("caja_conexiones").value;
			cable_num_2 = document.getElementById("cable_num_2").value;
			mk_vi = document.getElementById("mk_vi").value;
			mk_v = document.getElementById("mk_v").value;
			point_name = document.getElementById("point_name").value;
			vme_card = document.getElementById("vme_card").value;
			mk_vi_rack = document.getElementById("mk_vi_rack").value;
			mk_vi_vme_jack = document.getElementById("mk_vi_vme_jack").value;
			mk_vi_signal_name = document.getElementById("mk_vi_signal_name").value;
			fotos = document.getElementById("fotos").value;
			
			$("#divControlador").load("_ajax/crearMantenimiento.php", {codigoalarmahmi : codigoalarmahmi, dispositivo : dispositivo, descripcion : descripcion, sistema : sistema, cable_num_1 : cable_num_1, caja_conexiones : caja_conexiones, cable_num_2 : cable_num_2, mk_vi : mk_vi, mk_v : mk_v, point_name : point_name, vme_card : vme_card, mk_vi_rack : mk_vi_rack, mk_vi_vme_jack : mk_vi_vme_jack, mk_vi_signal_name : mk_vi_signal_name, fotos : fotos});
			fDetenerEvento(e);
*/
		}
	}
	
</script>
