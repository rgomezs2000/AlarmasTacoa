<?php
	
	
	function ObtFechaSql($Fecha)
	{
		
		$dia=substr($Fecha,0,2);
		$mes=substr($Fecha,3,2);
		$anio=substr($Fecha,6,4);
		
		$ObtFechaSql = $anio.'-'.$mes.'-'.$dia;
		return $ObtFechaSql;
	}
	
	
	function ObtFechaHtml($Fecha)
	{
		if ($Fecha == "")
		{
			$ObtFechaHtml = "";
		}
		else
		{
			$dia=substr($Fecha,8,2);
			$mes=substr($Fecha,5,2);
			$anio=substr($Fecha,0,4);
			
			$ObtFechaHtml = $dia.'/'.$mes.'/'.$anio;
		}
		return $ObtFechaHtml;
	}
	
	
	// INI EN CONSTRUCCION
	function ObtHoMiSeHtml($Fecha)
	{
		if ($Fecha == "")
		{
			$ObtFechaHtml = "";
		}
		else
		{
			$hora=substr($Fecha,11,2);
			$minuto=substr($Fecha,14,2);
			$segundo=substr($Fecha,17,2);
			
			$ObtHoMiSeHtml = $hora.':'.$minuto.':'.$segundo;
		}
		return $ObtHoMiSeHtml;
	}
	
	
	function ObtFechaCompletaHtml($Fecha)
	{
		if ($Fecha == "")
		{
			$ObtFechaHtml = "";
		}
		else
		{
			$dia=substr($Fecha,8,2);
			$mes=substr($Fecha,5,2);
			$anio=substr($Fecha,0,4);
			$hora=substr($Fecha,11,2);
			$minuto=substr($Fecha,14,2);
			$segundo=substr($Fecha,17,2);
			
			$ObtFechaCompletaHtml = $dia.'/'.$mes.'/'.$anio.' '.$hora.':'.$minuto.':'.$segundo;
		}
		return $ObtFechaCompletaHtml;
	}
	// FIN EN CONSTRUCCION
	
	
	function ObtenerFechaActual()
	{
		
		$fecha = time (); 
		$dia = date ( "w" , $fecha );
		if ($dia == 0)
		{
			$dia = "Domingo";
		}
		elseif ($dia == 1)
		{
			$dia = "Lunes";
		}
		elseif ($dia == 2)
		{
			$dia = "Martes";
		}
		elseif ($dia == 3)
		{
			$dia = "Miercoles";
		}
		elseif ($dia == 4)
		{
			$dia = "Jueves";
		}
		elseif ($dia == 5)
		{
			$dia = "Viernes";
		}
		elseif ($dia == 6)
		{
			$dia = "Sabado";
		}
		$fecha = $dia.', '.date ( "d/m/Y h:i A" , $fecha );
		return $fecha;
	}
	
	
	function ObtenerFechasIniFin($periodo)
	{
		
		$dia = date("d");
		$mes = date("m");
		$ano = date("Y");
		$hora = date("%H");
		$min = date("%M");
		$seg = date("%S");
		
		if ($periodo == 'semanal')
		{
			$dia_desc = strftime("%w",time());
	//		echo $dia_desc;
			$fechaMktime = mktime(8,0,0,$mes,$dia,$ano); // Propiedades similares a time()
			$Retorno['horario_ini'] = date('Y-m-d', $fechaMktime-(($dia_desc+6)*24*60*60))." 12:30:00";
			$Retorno['horario_fin'] = date('Y-m-d', $fechaMktime-($dia_desc*24*60*60))." 12:29:59";
			$Retorno['horario_ini_for'] = strftime("%d de %B del %Y", $fechaMktime-(($dia_desc+6)*24*60*60))." 12:30:00";
			$Retorno['horario_fin_for'] = strftime("%d de %B del %Y", $fechaMktime-($dia_desc*24*60*60))." 12:29:59";
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "se han obtenido las fechas satisfactoriamente";
			
		}
		elseif($periodo == 'mensual')
		{
			$mes_ano = restarMeses($date_actual,1);
			$fechaMktime = mktime(8,0,0,substr($mes_ano,5,2),1,substr($mes_ano,0,4));
			$Retorno['horario_ini'] = date('Y-m-d', $fechaMktime)." 12:30:00";
			$Retorno['horario_ini_for'] = strftime("%d de %B del %Y", $fechaMktime)." 12:30:00";
			
			$fechaMktime = mktime(8,0,0,date("m"),1,date("Y"));
			$Retorno['horario_fin'] = date('Y-m-d', $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['horario_fin_for'] = strftime("%d de %B del %Y", $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "se han obtenido las fechas satisfactoriamente";

		}
		elseif($periodo == 'trimestral')
		{
			$mes_ano = restarMeses($date_actual,3);
			$fechaMktime = mktime(8,0,0,substr($mes_ano,5,2),1,substr($mes_ano,0,4));
			$Retorno['horario_ini'] = date('Y-m-d', $fechaMktime)." 12:30:00";
			$Retorno['horario_ini_for'] = strftime("%d de %B del %Y", $fechaMktime)." 12:30:00";
			
			$fechaMktime = mktime(8,0,0,date("m"),1,date("Y"));
			$Retorno['horario_fin'] = date('Y-m-d', $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['horario_fin_for'] = strftime("%d de %B del %Y", $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "se han obtenido las fechas satisfactoriamente";
	
		}
		elseif($periodo == 'semestral')
		{
			$mes_ano = restarMeses($date_actual,6);
			$fechaMktime = mktime(8,0,0,substr($mes_ano,5,2),1,substr($mes_ano,0,4));
			$Retorno['horario_ini'] = date('Y-m-d', $fechaMktime)." 12:30:00";
			$Retorno['horario_ini_for'] = strftime("%d de %B del %Y", $fechaMktime)." 12:30:00";
			
			$fechaMktime = mktime(8,0,0,date("m"),1,date("Y"));
			$Retorno['horario_fin'] = date('Y-m-d', $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['horario_fin_for'] = strftime("%d de %B del %Y", $fechaMktime-(1*24*60*60))." 12:29:59";
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "se han obtenido las fechas satisfactoriamente";
			
		}
		elseif($periodo == 'anual')
		{
			$fechaMktime = mktime(8,0,0,1,1,(date("Y")-1));
			$Retorno['horario_ini'] = date('Y-m-d', $fechaMktime)." 12:30:00";
			$Retorno['horario_ini_for'] = strftime("%d de %B del %Y", $fechaMktime)." 12:30:00";
			
			$fechaMktime = mktime(8,0,0,12,31,(date("Y")-1));
			$Retorno['horario_fin'] = date('Y-m-d', $fechaMktime)." 12:29:59";
			$Retorno['horario_fin_for'] = strftime("%d de %B del %Y", $fechaMktime)." 12:29:59";
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "se han obtenido las fechas satisfactoriamente";
			
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Ha seleccionado un periodo incorrecto";
		}
		
		return $Retorno;
		
	}
	
	
	function ReportarFalla($msj)
	{
		$mensaje= "<script>alert('".$msj."');
		</script>";
		echo $mensaje;
		exit();
	}
	
	
	function MostrarMensaje($msj)
	{
		$mensaje= "<script>alert('".$msj."');
		</script>";
		echo $mensaje;
	}
	
	
	function MostrarMensajeJava($msj, $div)
	{
		$mensaje= "<script>
		document.getElementById('".$div."').innerHTML = '".$msj."';
		</script>
		";
		echo $mensaje;
	}
	
	
	function Direccionar($pagina)
	{
		$mensaje= "<script>
		document.form1.action = '".$pagina."';
		document.form1.submit();
		</script>";
		echo $mensaje;
	}
	
	
	function ModificarDatos($usuario, $nombres, $apellidos, $extension, $ubicacion, $sede)
	{
		
		$strQuery = "UPDATE usuarios SET nombres = ".$nombres.", apellidos = ".$apellidos.", extension = ".$extension.", ubicacion = ".$ubicacion." , sede = ".$sede." WHERE usuario = ".$usuario.";";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se han modificado los datos satisfactoriamente";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar modificar los datos<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
	function CambiarClave($usuario, $clavenueva)
	{
		
		$strQuery = "UPDATE usuarios SET clave = ".$clavenueva." WHERE usuario = ".$usuario.";";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha cambiado la contraseña satisfactoriamente";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar cambiar la contraseña<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
	function RegistrarUsuario($cedula, $nombres, $apellidos, $cargo, $usuario, $clave)
	{
		
		$strQuery = "INSERT INTO usuarios (cedula, nombres, apellidos, cargo, usuario, clave, fecha_creacion, activo) values (".$cedula.", ".$nombres.", ".$apellidos.", ".$cargo.", ".$usuario.", ".$clave.", now(), 'SI');";

		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if ($results > 0)
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha registrado satisfactoriamente un nuevo usuario";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar registrar un nuevo usuario<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarUsuario_Correo($correo_institucional)
	{
		
		$strQuery = " SELECT * FROM usuarios WHERE correo_institucional = '".$correo_institucional."';";
		
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$results = mysql_fetch_array($result,MYSQL_ASSOC);
			$Retorno['nombres'] = $results['nombres'];
			$Retorno['apellidos'] = $results['apellidos'];
			$Retorno['correo_institucional'] = $results['correo_institucional'];
			$Retorno['extension'] = $results['extension'];
			$Retorno['ubicacion'] = $results['ubicacion'];
			$Retorno['sede'] = $results['sede'];
			$Retorno['perfil'] = $results['perfil'];
			$Retorno['usuario'] = $results['usuario'];
			$Retorno['clave'] = $results['clave'];
			$Retorno['fecha_creacion'] = ObtFechaHtml($results['fecha_creacion']);
			$Retorno['activo'] = $results['activo'];
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarUsuario_Usuario($usuario)
	{
		
		$strQuery = " SELECT * FROM usuarios WHERE usuario = '".$usuario."';";
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			$results = mysql_fetch_array($result,MYSQL_ASSOC);
			$Retorno['nombres'] = $results['nombres'];
			$Retorno['apellidos'] = $results['apellidos'];
			$Retorno['correo_institucional'] = $results['correo_institucional'];
			$Retorno['extension'] = $results['extension'];
			$Retorno['ubicacion'] = $results['ubicacion'];
			$Retorno['sede'] = $results['sede'];
			$Retorno['perfil'] = $results['perfil'];
			$Retorno['usuario'] = $results['usuario'];
			$Retorno['clave'] = $results['clave'];
			$Retorno['fecha_creacion'] = ObtFechaHtml($results['fecha_creacion']);
			$Retorno['activo'] = $results['activo'];
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarUsuarios_Parametros($correo_institucional, $usuario, $perfil, $activo)
	{
		
		$strCondiciones = "";
		if ($correo_institucional != '')
		{
			$strCondiciones = $strCondiciones." AND correo_institucional like '%".$correo_institucional."%' ";
		}
		if ($usuario != '')
		{
			$strCondiciones = $strCondiciones." AND usuario like '%".$usuario."%' ";
		}
		if ($perfil != 'todos')
		{
			$strCondiciones = $strCondiciones." AND perfil like '%".$perfil."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM usuarios ".$strCondiciones." order by fecha_creacion ASC;";

		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarUsuarios_Parametros_Ind($correo_institucional, $usuario, $perfil, $activo, $registros, $inicio)
	{
		
		$strCondiciones = "";
		if ($correo_institucional != '')
		{
			$strCondiciones = $strCondiciones." AND correo_institucional like '%".$correo_institucional."%' ";
		}
		if ($usuario != '')
		{
			$strCondiciones = $strCondiciones." AND usuario like '%".$usuario."%' ";
		}
		if ($perfil != 'todos')
		{
			$strCondiciones = $strCondiciones." AND perfil like '%".$perfil."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM usuarios ".$strCondiciones." order by fecha_creacion ASC LIMIT ".$inicio.", ".$registros.";";
	
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function CrearUsuario($nombres, $apellidos, $correo_institucional, $extension, $ubicacion, $sede, $perfil, $usuario, $clave)
	{
		
		$strQuery = "insert into usuarios (nombres, apellidos, correo_institucional, extension, ubicacion, sede, perfil, usuario, clave, fecha_creacion, activo) values (".$nombres.", ".$apellidos.", ".$correo_institucional.", ".$extension.", ".$ubicacion.", ".$sede.", ".$perfil.", ".$usuario.", ".$clave.", now(), 'SI');";

		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if ($results > 0)
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha registrado satisfactoriamente un nuevo usuario";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar registrar un nuevo usuario<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function ReactivarUsuario($nombres, $apellidos, $correo_institucional, $extension, $ubicacion, $sede, $perfil, $usuario, $clave)
	{
		
		$strQuery = "update usuarios set nombres = ".$nombres.", apellidos = ".$apellidos.", correo_institucional = ".$correo_institucional.", extension = ".$extension.", ubicacion = ".$ubicacion.", sede = ".$sede.", perfil = ".$perfil.", cargo = ".$cargo.", clave = ".$clave.", activo = 'SI' where correo_institucional = ".$correo_institucional.";";

		
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha reactivado satisfactoriamente un usuario";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar reactivar un usuario<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function ModificarUsuario($usuarioactual, $nombres, $apellidos, $correo_institucional, $extension, $ubicacion, $sede, $perfil, $usuario)
	{
		
		$strQuery = "UPDATE usuarios SET nombres = '".$nombres."', apellidos = '".$apellidos."', correo_institucional = '".$correo_institucional."', extension = '".$extension."', ubicacion = '".$ubicacion."', sede = '".$sede."', perfil = '".$perfil."', usuario = '".$usuario."' WHERE usuario = '".$usuarioactual."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se han modificado los datos del usuario satisfactoriamente";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar modificar los datos del usuario<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
	function EliminarUsuario($usuario)
	{
		
		$strQuery = "UPDATE usuarios SET activo = 'NO' WHERE usuario = '".$usuario."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha eliminado satisfactoriamente el usuario";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar eliminar el usuario<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
		
	
	function CrearAlarma($codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta)
	{

		
		$strQuery = "INSERT INTO alarmasoperativa (codigoalarmahmi, mensajealarmahmi, causasposibles, respuesta, fecha_creacion, activo) values (".$codigoalarmahmi.", ".$mensajealarmahmi.", ".$causasposibles.", ".$respuesta.", now(), 'SI');";

		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if ($results > 0)
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha creado satisfactoriamente una nueva alarma";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar crear una nueva alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarAlarma_codigoalarmahmi($codigoalarmahmi)
	{
		
		$strQuery = " SELECT * FROM alarmasoperativa WHERE codigoalarmahmi = '".$codigoalarmahmi."';";
		
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$results = mysql_fetch_array($result,MYSQL_ASSOC);
			$Retorno = $results;
			$Retorno['fecha_creacion'] = ObtFechaHtml($Retorno['fecha_creacion']);
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarAlarmas_Parametros($codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta, $activo)
	{
		
		$strCondiciones = "";
		if ($codigoalarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND codigoalarmahmi like '%".$codigoalarmahmi."%' ";
		}
		if ($mensajealarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND mensajealarmahmi like '%".$mensajealarmahmi."%' ";
		}
		if ($causasposibles != '')
		{
			$strCondiciones = $strCondiciones." AND causasposibles like '%".$causasposibles."%' ";
		}
		if ($respuesta != '')
		{
			$strCondiciones = $strCondiciones." AND respuesta like '%".$respuesta."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM alarmasoperativa ".$strCondiciones." order by fecha_creacion ASC;";

		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarAlarmas_Parametros_Ind($codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta, $activo, $registros, $inicio)
	{
		
		$strCondiciones = "";
		if ($codigoalarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND codigoalarmahmi like '%".$codigoalarmahmi."%' ";
		}
		if ($mensajealarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND mensajealarmahmi like '%".$mensajealarmahmi."%' ";
		}
		if ($causasposibles != '')
		{
			$strCondiciones = $strCondiciones." AND causasposibles like '%".$causasposibles."%' ";
		}
		if ($respuesta != '')
		{
			$strCondiciones = $strCondiciones." AND respuesta like '%".$respuesta."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM alarmasoperativa ".$strCondiciones." order by fecha_creacion ASC LIMIT ".$inicio.", ".$registros.";";
	
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function ModificarAlarma($codigoalarmahmiactual, $codigoalarmahmi, $mensajealarmahmi, $causasposibles, $respuesta)
	{
		
		$strQuery = "UPDATE alarmasoperativa SET codigoalarmahmi = '".$codigoalarmahmi."', mensajealarmahmi = '".$mensajealarmahmi."', causasposibles = '".$causasposibles."', respuesta = '".$respuesta."' WHERE codigoalarmahmi = '".$codigoalarmahmiactual."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se han modificado los datos de la alarma satisfactoriamente";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar modificar los datos de la alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
	function EliminarAlarma($codigoalarmahmi)
	{
		
		$strQuery = "UPDATE alarmasoperativa SET activo = 'NO' WHERE codigoalarmahmi = '".$codigoalarmahmi."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha eliminado satisfactoriamente la alarma";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar eliminar la alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
		
///////////////////////////////////
// INI EN CONSTRUCCION
///////////////////////////////////	

	
	
	function CrearMantenimiento($codigoalarmahmi, $dispositivo, $descripcion, $sistema, $cable_num_1, $caja_conexiones, $cable_num_2, $mk_vi, $mk_v, $point_name, $vme_card, $mk_vi_rack, $mk_vi_vme_jack, $mk_vi_signal_name, $fotos)
	{

		
		$strQuery = "INSERT INTO alarmasmantenimiento (codigoalarmahmi, dispositivo, descripcion, sistema, cable_num_1, caja_conexiones, cable_num_2, mk_vi, mk_v, point_name, vme_card, mk_vi_rack, mk_vi_vme_jack, mk_vi_signal_name, fotos, fecha_creacion, activo) values (".$codigoalarmahmi.", ".$dispositivo.", ".$descripcion.", ".$sistema.", ".$cable_num_1.", ".$caja_conexiones.", ".$cable_num_2.", ".$mk_vi.", ".$mk_v.", ".$point_name.", ".$vme_card.", ".$mk_vi_rack.", ".$mk_vi_vme_jack.", ".$mk_vi_signal_name.", ".$fotos.", now(), 'SI');";

		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if ($results > 0)
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha creado satisfactoriamente una nueva alarma";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar crear una nueva alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarMantenimiento_codigoalarmahmi($codigoalarmahmi)
	{
		
		$strQuery = " SELECT * FROM alarmasmantenimiento WHERE codigoalarmahmi = '".$codigoalarmahmi."';";
		
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$results = mysql_fetch_array($result,MYSQL_ASSOC);
			$Retorno = $results;
			$Retorno['fecha_creacion'] = ObtFechaHtml($Retorno['fecha_creacion']);
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarMantenimiento_Parametros($codigoalarmahmi, $dispositivo, $descripcion, $sistema, $activo)
	{
		
		$strCondiciones = "";
		if ($codigoalarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND codigoalarmahmi like '%".$codigoalarmahmi."%' ";
		}
		if ($dispositivo != '')
		{
			$strCondiciones = $strCondiciones." AND dispositivo like '%".$dispositivo."%' ";
		}
		if ($descripcion != '')
		{
			$strCondiciones = $strCondiciones." AND descripcion like '%".$descripcion."%' ";
		}
		if ($sistema != '')
		{
			$strCondiciones = $strCondiciones." AND sistema like '%".$sistema."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM alarmasmantenimiento ".$strCondiciones." order by fecha_creacion ASC;";

		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function BuscarMantenimiento_Parametros_Ind($codigoalarmahmi, $dispositivo, $descripcion, $sistema, $activo, $registros, $inicio)
	{
		
		$strCondiciones = "";
		if ($codigoalarmahmi != '')
		{
			$strCondiciones = $strCondiciones." AND codigoalarmahmi like '%".$codigoalarmahmi."%' ";
		}
		if ($dispositivo != '')
		{
			$strCondiciones = $strCondiciones." AND dispositivo like '%".$dispositivo."%' ";
		}
		if ($descripcion != '')
		{
			$strCondiciones = $strCondiciones." AND descripcion like '%".$descripcion."%' ";
		}
		if ($sistema != '')
		{
			$strCondiciones = $strCondiciones." AND sistema like '%".$sistema."%' ";
		}
		if ($activo != '')
		{
			$strCondiciones = $strCondiciones." AND activo like '%".$activo."%' ";
		}
		if(strlen($strCondiciones) > 0)
		{
			$strCondiciones = substr($strCondiciones, 4);
			$strCondiciones = " WHERE ".$strCondiciones;
		}
		
		$strQuery = " SELECT * FROM alarmasmantenimiento ".$strCondiciones." order by fecha_creacion ASC LIMIT ".$inicio.", ".$registros.";";
	
		$result = mysql_query($strQuery);
		$NumRows = mysql_num_rows($result);
		if ($NumRows > 0)
		{
			$Retorno['registros']['cantidad'] = $NumRows;
			for($i=0;$i<$NumRows;$i++)
			{
				$results = mysql_fetch_array($result,MYSQL_ASSOC);
				$Retorno[$i] = $results;
				$Retorno[$i]['fecha_creacion'] = ObtFechaHtml($Retorno[$i]['fecha_creacion']);
			}
			mysql_free_result($result);
			
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha encontrado el registro";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: No existe registro para dicha busqueda<br>Detalle: ".mysql_errno()."-".mysql_error();
		}

		return $Retorno;
	}
	
	
	function ModificarMantenimiento($codigoalarmahmiactual, $codigoalarmahmi, $dispositivo, $descripcion, $sistema, $cable_num_1, $caja_conexiones, $cable_num_2, $mk_vi, $mk_v, $point_name, $vme_card, $mk_vi_rack, $mk_vi_vme_jack, $mk_vi_signal_name, $fotos)
	{
		
		$strQuery = "UPDATE alarmasmantenimiento SET codigoalarmahmi = '".$codigoalarmahmi."', dispositivo = '".$dispositivo."', descripcion = '".$descripcion."', sistema = '".$sistema."', cable_num_1 = '".$cable_num_1."', caja_conexiones = '".$caja_conexiones."', cable_num_2 = '".$cable_num_2."', mk_vi = '".$mk_vi."', mk_v = '".$mk_v."', point_name = '".$point_name."', vme_card = '".$vme_card."', mk_vi_rack = '".$mk_vi_rack."', mk_vi_vme_jack = '".$mk_vi_vme_jack."', mk_vi_signal_name = '".$mk_vi_signal_name."', fotos = '".$fotos."' WHERE dispositivo = '".$codigoalarmahmiactual."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se han modificado los datos de la alarma satisfactoriamente";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar modificar los datos de la alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	
	function EliminarMantenimiento($codigoalarmahmi)
	{
		
		$strQuery = "UPDATE alarmasmantenimiento SET activo = 'NO' WHERE codigoalarmahmi = '".$codigoalarmahmi."';";
		$result = mysql_query($strQuery);
		$results = mysql_affected_rows();
		if (($results > 0) or (mysql_errno() == 0))
		{
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha eliminado satisfactoriamente la alarma";
		}
		else
		{
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar eliminar la alarma<br>Detalle: ".mysql_errno()."-".mysql_error();
		}
	
		return $Retorno;
	}
	
	function SubirImagen($nombreImagen, $idElementoHtml)
	{
		
	//	$newFile = 'fotos/'.$nombreImagen.strstr($_FILES['FotoRuta']['name'],'.');
		 // HABRIA QUE VALIDAR EL NOMBRE DEL ARCHIVO Y DEMAS
		$subio = false;
		
		if(move_uploaded_file($_FILES[$idElementoHtml]['tmp_name'], $nombreImagen)){
			$subio = true;
		}
		
		if($subio) {
			$Retorno['CodError'] = 0;
			$Retorno['Mensaje'] = "Se ha guardado satisfactoriamente la imagen";
		} else {
			$Retorno['CodError'] = 1;
			$Retorno['Mensaje'] = "ERROR: Al intentar guardar la imagen. Cargue imagenes con formatos JPG, JPEG o PNG";
		}  
	
	}

///////////////////////////////////
// FIN EN CONSTRUCCION
///////////////////////////////////	
		
	

?>