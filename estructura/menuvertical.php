<?php
if (!isset ($_SESSION)) {
	session_start();
}
?>
<?php if ($_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] <> '') { ?>
                                                  <ul id="MenuBar1" class="MenuBarVertical">
	<?php if ($_SESSION['SistAlarmasTacoa']['Usuario']['perfil'] == 'administrador') { ?>
                                                    <li><a class="MenuBarItemSubmenu">USUARIOS</a>
                                                      <ul>
                                                        <li><a onClick="fCargarCuerpo('usuarios/crear.php');">Crear</a></li>
                                                        <li><a onClick="fCargarCuerpo('usuarios/consultar.php');">Consultar</a></li>
                                                        <li><a onClick="fCargarCuerpo('usuarios/consultar.php');">Modificar</a></li>
                                                        <li><a onClick="fCargarCuerpo('usuarios/consultar.php');">Eliminar</a></li>
                                                      </ul>
                                                    </li>
	<?php } ?>
                                                    <li><a class="MenuBarItemSubmenu">ALARMAS</a>
                                                      <ul>
                                                        <li><a class="MenuBarItemSubmenu">OPERATIVAS</a>
                                                          <ul>
                                                            <li><a onClick="fCargarCuerpo('alarmas/crear.php');">Crear</a></li>
                                                            <li><a onClick="fCargarCuerpo('alarmas/consultar.php');">Consultar</a></li>
                                                            <li><a onClick="fCargarCuerpo('alarmas/consultar.php');">Modificar</a></li>
                                                            <li><a onClick="fCargarCuerpo('alarmas/consultar.php');">Eliminar</a></li>
                                                          </ul>
                                                        </li>
                                                        <li><a class="MenuBarItemSubmenu">DE MANTENIMIENTO</a>
                                                          <ul>
                                                            <li><a onClick="fCargarCuerpo('mantenimiento/crear.php');">Crear</a></li>
                                                            <li><a onClick="fCargarCuerpo('mantenimiento/consultar.php');">Consultar</a></li>
                                                            <li><a onClick="fCargarCuerpo('mantenimiento/consultar.php');">Modificar</a></li>
                                                            <li><a onClick="fCargarCuerpo('mantenimiento/consultar.php');">Eliminar</a></li>
                                                          </ul>
                                                        </li>
                                                      </ul>
                                                    </li>
                                                  </ul>
<script type="text/javascript">
var MenuBar1 = new Spry.Widget.MenuBar("MenuBar1", {imgRight:"../SpryAssets/SpryMenuBarRightHover.gif"});
</script>
<?php } ?>
