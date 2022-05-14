<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<script>
document.getElementById('divTitulo').innerHTML = 'DATOS DEL USUARIO';
document.getElementById('divLogo').innerHTML = '<img src="_imagenes/administrador.jpg" width="180" height="180">';
</script>
                                <table align="center" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                          <table align="center" cellspacing="0" width="100%">
                                                <tr>
                                                  <td height="0" valign="top">&nbsp;</td>
                                                  <td valign="top" class="error"><div id="crearUsuario">&nbsp;</div></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">NOMBRES:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['nombres'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">APELLIDOS:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">CORREO INSTITUCIONAL:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">EXTENSION:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['extension'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">UBICACION:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">SEDE:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['sede'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">PERFIL:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['perfil'];?></td>
                                                  <td>&nbsp;</td>
                                                </tr>
                                            	<tr>
                                                  <td height="40" width="225" align="left" class="text2">USUARIO:</td>
                                                  <td height="40" align="left" class="text2"><?php echo $_SESSION['SistAlarmasTacoa']['Usuario']['usuario'];?></td>
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
