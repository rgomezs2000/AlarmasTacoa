<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'CONSULTA, MODIFICACION Y ELIMINACION DE USUARIOS';
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
                                                  <td height="40" width="225" align="left" class="text2">CORREO INSTITUCIONAL:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="correo_institucional" name="correo_institucional" class="textfonBlanco"/>
                                                        </td>
                                                  		<td>&nbsp;
                                                  		  
                                                        </td>
                                                    </tr>
                                                  </table>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">USUARIO:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
		                                                  <input type="text" id="usuario" name="usuario" class="textfonBlanco"/>
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
                                                  <td height="40" width="225" align="left" class="text2">PERFIL:</td>
                                                  <td height="40" align="left">
                                                  <table>
                                                  	<tr>
                                                    	<td>
                                                            <select name='perfil' id='perfil' class='textfonBlanco'>
                                                                <option value='todos'>todos</option>
                                                                <option value='usuario'>usuario</option>
                                                                <option value='administrador'>administrador</option>
                                                                <option value='operador'>operador</option>
                                                                <option value='soporte'>soporte</option>
                                                                <option value='supervisor'>supervisor</option>
                                                            </select>
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
		correo_institucional = document.getElementById("correo_institucional").value;
		usuario = document.getElementById("usuario").value;
		perfil = document.getElementById("perfil").value;
		
		$("#divListado").load("_ajax/consultarUsuario.php", {accion : 'listar', correo_institucional : correo_institucional, usuario : usuario, perfil : perfil});
		fDetenerEvento(e);
	}
	
</script>
