<?php
if (!isset ($_SESSION)) {
	session_start();
}
if(isset($_SESSION['SistAlarmasTacoa']['Usuario']['usuario']) == false)
{
	$_SESSION['SistAlarmasTacoa']['Usuario']['usuario'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['nombres'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['apellidos'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['correo_institucional'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['extension'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['ubicacion'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['sede'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['fecha_creacion'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['perfil'] = '';
	$_SESSION['SistAlarmasTacoa']['Usuario']['clave'] = '';
}

?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Alarmas TACOA</title>
<LINK href="_estilos/estilos.css" rel="stylesheet" type="text/css">
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<link href="SpryAssets/SpryMenuBarVertical.css" rel="stylesheet" type="text/css">
<link href="SpryAssets/SpryMenuBarHorizontal.css" rel="stylesheet" type="text/css">
<link type="text/css" rel="stylesheet" href="dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></LINK>
<SCRIPT type="text/javascript" src="dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20060118"></script>
<script src="includes/js/jquery.js" type="text/javascript"></script>
<script type="text/javascript">

	function fCambiarImagen(id, imagen)
	{
		document.getElementById(id).src = '_imagenes/'+imagen;
	}
	
	function fCargarCuerpo(nombre)
	{
		$("#divCuerpo").load(nombre, {});
		//return true;
	}
	
	function fDetenerEvento(e)
	{
		if (window.event) //IE
		{
		  e.returnValue = false;
		}
		else //Firefox
		{
		  //alert("2");
		  e.preventDefault(); // <-- What should I write here instead
		}
	}
</script>

</head>

<body>
<div id="divControlador"></div>
<table width="100%">
	<tr>
    	<td background="_imagenes/44.jpg">&nbsp;
        </td>
    	<td align="center" width="780" height="300">&nbsp;
<table align="center" cellpadding="0" cellspacing="0" border="0">
    <tr>
    	<td>&nbsp;
        	
        </td>
    	<td>
        	<img src="_imagenes/content_table_bg_top.png" width="780" height="300" alt="encabezado"/>
        </td>
    	<td>&nbsp;
        	
        </td>
    </tr>
    <tr>
    	<td>&nbsp;
        	
        </td>
    	<td>
            <table cellpadding="0" cellspacing="0" border="0" width="100%">
            	<tr>
                	<td background="_imagenes/content_table_bg_middle.png" width="1">&nbsp;
                    	
                    </td>
                    <td>
                    	<table cellpadding="0" cellspacing="0" border="0" width="100%">
                        	<tr>
                            	<td>
                                    <div id="divSesion" align="justify">
                                        <?php
                                        require_once 'sesion/iniciar.php';
                                        ?>
                                    </div>
                                </td>
                            </tr>
                            <tr height="5">
                                <td bgcolor="#CC0000">
                                </td>
                            </tr>
                        	<tr>
                            	<td>
                                    <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                        <tr valign="top" height="300">
                                            <td width="193">
                                                <table cellpadding="0" cellspacing="0" border="0" width="100%">
                                                    <tr height="150" valign="top">
                                                        <td>
                                                            <div id="divMenuVertical" align="justify">
                                                                <?php
                                                                require_once 'estructura/menuvertical.php';
                                                                ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div id="divLogo" align="justify">
                                                            	<img src="_imagenes/cbb_helpdesk.jpg" width="180" height="180">
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                            <td>
                                                    <table cellpadding="0" cellspacing="0" border="0" width="95%" align="center">
                                                        <tr height="10">
                                                            <td width="5">
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td width="5">
                                                            </td>
                                                        </tr>
                                                        <tr height="3">
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                        </tr>
                                                        <tr height="40" bgcolor="#CCCCCC">
                                                            <td>
                                                            </td>
                                                            <td align="center" class="textTitulo">
				                                                <div id="divTitulo">
                                                                </div>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr height="3">
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                        </tr>
                                                        <tr height="3">
                                                            <td>
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr height="270">
                                                            <td>
                                                            </td>
                                                            <td width="560">
                                                                <p>&nbsp;
                                                                </p>
				                                                <div id="divCuerpo" align="justify">
																	<?php
                                                                    require_once 'sesion/bienvenida.php';
																	?>
				                                                </div>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr height="3">
                                                            <td>
                                                            </td>
                                                            <td>
                                                            </td>
                                                            <td>
                                                            </td>
                                                        </tr>
                                                        <tr height="3">
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                            <td bgcolor="#CC0000">
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td background="_imagenes/content_table_bg_middle.png" width="6">&nbsp;
                        
                    </td>
                </tr>
            </table>
        </td>
    	<td>&nbsp;
        	
        </td>
    </tr>
    <tr>
    	<td>&nbsp;
        	
      </td>
    	<td><img src="_imagenes/content_table_bg_bottom.png" width="780" height="26" alt="pie de pagina" />
        	
        </td>
    	<td>&nbsp;
        	
      </td>
    </tr>
</table>
        </td>
    	<td background="_imagenes/44.jpg">&nbsp;
        </td>
    </tr>
</table>
</body>
</html>