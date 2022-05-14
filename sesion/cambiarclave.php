<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'DATOS DEL USUARIO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/administrador.jpg" width="180" height="180">';
</script>
<form id="form1" name="form1" action="fCambiarClave(event);">
                                <table align="center" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="0" valign="top">
<p class="text2">&nbsp;</p></td>
                                                  <td valign="top" class="error"><div id="crearUsuario">&nbsp;</div></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="242" align="left" class="text2">NOMBRES:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['nombres'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="242" align="left" class="text2">APELLIDOS:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="242" align="left" class="text2">CONTRASEÑA ACTUAL:</td>
                                                  <td height="40" align="left">
	                                                  <input type="password" id="claveactual" name="claveactual" class="textfonBlanco"/>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td height="40" width="242" align="left" class="text2">CONTRASEÑA NUEVA:</td>
                                                  <td height="40" align="left">
	                                                  <input type="password" id="clavenueva" name="clavenueva" class="textfonBlanco"/>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                  <td height="40" width="242" align="left" class="text2">CONFIRMAR CONTRASEÑA:</td>
                                                  <td height="40" align="left">
	                                                  <input type="password" id="confirmaclave" name="confirmaclave" class="textfonBlanco"/>
                                                  </td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td>&nbsp;</td>
                                                    <td><input name="imgCambiar" id="imgCambiar" type="image" src="_imagenes/cambiar.png" alt="cambiar" width="60" height="19" onMouseOut="fCambiarImagen('imgCambiar', 'cambiar.png');" onMouseMove="fCambiarImagen('imgCambiar', 'cambiar_03.png');" onClick="fCambiarImagen('imgCambiar', 'cambiar_02.png');fCambiarClave(event);"></td>
                                                    <td align="right">&nbsp;</td>
                                                </tr>
                                          </table>
                                      </td>
                                    </tr>
                                </table>
</form>
<script type="text/javascript">

	function fCambiarClave(e)
	{
		var errMsg;
		var isOk;
		var pass;
		errMsg="";  
		
		isOk = true;
		if (document.getElementById("claveactual").value == ""){
			errMsg +="- El campo contraseña actual es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("clavenueva").value == ""){
			errMsg +="- El campo contraseña nueva es requerido.\n";
			isOk = false;
		}
		if (document.getElementById("confirmaclave").value == ""){
			errMsg +="- El campo confirmar contraseña es requerido.\n";
			isOk = false;
		}
		if((document.getElementById("clavenueva").value!="")&&(document.getElementById("confirmaclave").value!="")){
			if(document.getElementById("clavenueva").value!=document.getElementById("confirmaclave").value){
				errMsg +="- Las contraseñas no coinciden\n";
				isOk = false;
			}
			else
			{
				if(document.getElementById("claveactual").value==document.getElementById("clavenueva").value){
					errMsg +="- La contraseña actual debe ser diferente de la nueva\n";
					isOk = false;
				}
			}
		}
		
		if (!isOk)
		{	
			alert(errMsg);
			fDetenerEvento(e);
		}
		else
		{
			claveactual = document.getElementById('claveactual').value;
			clavenueva = document.getElementById('clavenueva').value;
			$("#divControlador").load("_ajax/cambiarClave.php", {claveactual: claveactual, clavenueva: clavenueva});
			fDetenerEvento(e);
		}
	}
	
</script>
