<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CONSULTA, MODIFICACION Y ELIMINACION DE ALARMAS DE MANTENIMIENTO';
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
                                                  <td height="40" width="225" align="left" class="text2">Dispositivo:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="dispositivo" name="dispositivo" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Descripción:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="descripcion" name="descripcion" class="textfonBlanco"/>
                                                        </td>
                                                  		<td><input name="imgBuscar" id="imgBuscar" type="image" src="_imagenes/buscar.png" alt="buscar" width="60" height="19" onmouseout="fCambiarImagen('imgBuscar', 'buscar.png');" onmousemove="fCambiarImagen('imgBuscar', 'buscar_03.png');" onclick="fCambiarImagen('imgBuscar', 'buscar_02.png');fActivarEvento(event);" />
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                           	<tr>
                                                  <td height="40" width="225" align="left" class="text2">Sistema:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="sistema" name="sistema" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;</td>
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
			dispositivo = document.getElementById("dispositivo").value;
			descripcion = document.getElementById("descripcion").value;
			sistema = document.getElementById("sistema").value;
			
		$("#divListado").load("_ajax/consultarMantenimiento.php", {accion : 'listar', codigoalarmahmi : codigoalarmahmi, dispositivo : dispositivo, descripcion : descripcion, sistema : sistema});
		fDetenerEvento(e);
	}
	
</script>
