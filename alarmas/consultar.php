<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CONSULTA, MODIFICACION Y ELIMINACION DE ALARMAS OPERATIVAS';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/usuario.png" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fActivarEvento(event);">
                                <table align="center" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="40" valign="top">
<p class="text2">INGRESE LOS SIGUIENTES DATOS:</p></td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Código Alarma HMI:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="codigoalarmahmi" name="codigoalarmahmi" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Mensaje Alarma HMI:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="mensajealarmahmi" name="mensajealarmahmi" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                           	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Causas Posibles:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="causasposibles" name="causasposibles" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>
                                                  		  <input name="imgBuscar" id="imgBuscar" type="image" src="_imagenes/buscar.png" alt="buscar" width="60" height="19" onMouseOut="fCambiarImagen('imgBuscar', 'buscar.png');" onMouseMove="fCambiarImagen('imgBuscar', 'buscar_03.png');" onClick="fCambiarImagen('imgBuscar', 'buscar_02.png');fActivarEvento(event);">
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Respuesta:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
                                                            <input type="text" id="respuesta" name="respuesta" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                          </table>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="divAdmin" align="justify">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div id="divListado" align="justify">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="30" valign="top">
<p>&nbsp;</p></td>
                                                  <td valign="top">&nbsp;</td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                          </table>
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
			codigoalarmahmi = document.getElementById("codigoalarmahmi").value;
			mensajealarmahmi = document.getElementById("mensajealarmahmi").value;
			causasposibles = document.getElementById("causasposibles").value;
			respuesta = document.getElementById("respuesta").value;
			
		$("#divListado").load("_ajax/consultarAlarma.php", {accion : 'listar', codigoalarmahmi : codigoalarmahmi, mensajealarmahmi : mensajealarmahmi, causasposibles : causasposibles, respuesta : respuesta});
		fDetenerEvento(e);
	}
	
</script>
