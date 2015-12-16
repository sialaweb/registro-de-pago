<?php
	include("base.php");
	if (isset($_GET['archivo'])){
		$nombre = $_FILES['archivo']['name'];
        $tipo = $_FILES['archivo']['type']; 
        $tam = $_FILES['archivo']['size'];
        $nombreTmp = $_FILES['archivo']['tmp_name'];   
        $tamMax = 500000;
        $tmp = explode(".", $nombre);
        $ext = $tmp[count($tmp)-1];
        $ext = strtolower($ext);

        $nombreNuevo = time().".".$ext;
        $destino = "./archivos/$nombreNuevo";
        $error=false;
        if (!preg_match("/(png|jpeg|jpg|doc|docx|pdf)$/i", $ext)){
	        $mensaje = "El tipo de archivo es inválido... Solo se permiten: png, jpg/jpeg, doc, docx, pdf.";
	        $error = true;
	    }
	    elseif ($tam>$tamMax){
	        $mensaje = "El adjunto no debe tener un tamaño superior a 500kb.";
	        $error = true;
	    }

	    if ($error){
	    	echo json_encode(array("respuesta"=>"error", "mensaje"=>$mensaje));
	    	exit();
	    }

        if (move_uploaded_file($nombreTmp, $destino)){
        	echo json_encode(array("respuesta"=>"ok", "mensaje"=>"El archivo se subió correctamente.", "nombre"=>"$nombreNuevo"));
        }
        else{
        	echo json_encode(array("respuesta"=>"error", "mensaje"=>"El archivo no se pudo subir.", "post"=>$_POST));
        }		
		exit();
	}
	$xp = new xPOST();
	$seudonimo = $xp->get('seudonimo');
	$nombre = $xp->get('nombre');

	$precedrif = $xp->get('precedrif');
	$cedrif = $xp->get('cedrif');
	$cedrif = $precedrif."-".$cedrif;

	$correo = $xp->get('correo');
	$producto = $xp->get('producto');
	$cantidad = $xp->get('cantidad');
	$modelo = $xp->get('modelo');
	$color = $xp->get('color');
	$detalle = $xp->get('detalle');
	$medio = $xp->get('medio');
	$bancopago = $xp->get('bancopago');
	$numpago = $xp->get('numpago');
	$bancoemisor = $xp->get('bancoemisor');
	$fechapago_es = $xp->get('fechapago');
	$fechapago = esp2eng($fechapago_es);
	$montopago = $xp->get('montopago');
	$tipoentrega = $xp->get('tipoentrega');
	$servicioencomienda = $xp->get('servicioencomienda');
	$direccionencomienda = $xp->get('direccionencomienda');
	if (FORMULARIO_MODALIDAD_PAGO){
		$modalidadpago = $xp->get('modalidadpago');
	}
	else{
		$modalidadpago = 0;
	}

	//$destinatario = $xp->get('destinatario');
	//$destinatario_ced = $xp->get('destinatario_ced');
	//$predestinatario_ced = $xp->get('predestinatario_ced');
	//$destinatario_ced = $predestinatario_ced."-".$destinatario_ced;

	$destinatario_tel = $xp->get('destinatario_tel');
	$cod_destinatario_tel = $xp->get('cod_destinatario_tel');
	$destinatario_tel = $cod_destinatario_tel."-".$destinatario_tel;

	$destinatario_cel = $xp->get('destinatario_cel');
	$cod_destinatario_cel = $xp->get('cod_destinatario_cel');
	$destinatario_cel = $cod_destinatario_cel."-".$destinatario_cel;

	$localidad = $xp->get('localidad');
	$inmueble = $xp->get('inmueble');
	$parroquia = $xp->get('parroquia');
	$municipio = $xp->get('municipio');
	$ciudad = $xp->get('ciudad');
	$estado = $xp->get('estado');
	$pais = $xp->get('pais');
	$zpostal = $xp->get('zpostal');
	$observaciones = $xp->get('observaciones');
	$adjunto = $xp->get('adjunto');
	$fecha_sis = date("Y-m-d H:i:s");
	$errores = 0;
	
	if (empty($nombre))
		$errores++;
	if (empty($cedrif))
		$errores++;
	if (empty($correo))
		$errores++;
	if (empty($producto))
		$errores++;
	if (empty($cantidad))
		$errores++;
	if (empty($medio))
		$errores++;
	if (empty($bancopago))
		$errores++;
	if (empty($numpago))
		$errores++;
	if (empty($fechapago))
		$errores++;
	if (empty($montopago))
		$errores++;
	if (empty($tipoentrega))
		$errores++;
	if ($destinatario_tel=='-' && $destinatario_cel=='-')
		$errores++;

	if ($errores>0){
		echo json_encode(array("respuesta"=>"error", "mensaje"=>"Los datos están incompletos. Imposible registrar la información."));
		exit();
	}

	$r = mysql_query("SELECT pago_id FROM pago WHERE num_pago='$numpago'");
	if (mysql_num_rows($r)>0){
		echo json_encode(array("respuesta"=>"error", "mensaje"=>"El recibo de pago ya está registrado."));
		exit();
	}

	mysql_query("INSERT INTO pago (seudonimo, nombre, cedrif, correo, producto, cantidad, modelo, color, detalle, pago_tipo_id, banco_pago, num_pago, banco_emisor, fecha_pago, monto_pago, entrega_tipo_id, servicio_id, direccion_encomienda, pais, estado_id, fecha, ciudad, observaciones, zpostal, parroquia, destinatario_tel, destinatario_cel, localidad, municipio, inmueble, adjunto, pago_modalidad_id)
				VALUES ('$seudonimo','$nombre','$cedrif','$correo','$producto','$cantidad','$modelo','$color','$detalle','$medio','$bancopago','$numpago','$bancoemisor','$fechapago','$montopago','$tipoentrega','$servicioencomienda','$direccionencomienda','$pais','$estado','$fecha_sis','$ciudad','$observaciones','$zpostal','$parroquia','$destinatario_tel','$destinatario_cel','$localidad','$municipio','$inmueble', '$adjunto', '$modalidadpago')");

	if (!mysql_error()){

		$r=mysql_query("SELECT nombre FROM pago_tipo WHERE pago_tipo_id='$medio'");
		$rs = mysql_fetch_array($r);
		$medio = $rs[0];

		$r=mysql_query("SELECT nombre FROM banco_destino WHERE banco_destino_id='$bancopago'");
		$rs = mysql_fetch_array($r);
		$bancopago = $rs[0];

		if (!empty($bancoemisor)){
			$r=mysql_query("SELECT nombre FROM banco_origen WHERE banco_origen_id='$bancoemisor'");
			$rs = mysql_fetch_array($r);
			$bancoemisor = $rs[0];
		}

		$r=mysql_query("SELECT nombre FROM entrega_tipo WHERE entrega_tipo_id='$tipoentrega'");
		$rs = mysql_fetch_array($r);
		$tipoentrega = $rs[0];

		if (FORMULARIO_MODALIDAD_PAGO){
			$r=mysql_query("SELECT nombre FROM pago_modalidad WHERE pago_modalidad_id='$modalidadpago'");
			$rs = mysql_fetch_array($r);
			$modalidadpago = $rs[0];
		}
		
		if (!empty($servicioencomienda)){
			$r=mysql_query("SELECT nombre FROM servicio WHERE servicio_id='$servicioencomienda'");
			$rs = mysql_fetch_array($r);
			$servicioencomienda = $rs[0];
		}

		$r=mysql_query("SELECT nombre FROM estado WHERE estado_id='$estado'");
		$rs = mysql_fetch_array($r);
		$estado = $rs[0];

		$fecha_envio = date("d/m/Y")." a las ".date("h:i:s a");

		$cuerpo = "";
		$cuerpo.= "<b>DATOS DEL CLIENTE</b><br>";
		$cuerpo.= "<b>Seudónimo en Mercadolibre:</b> $seudonimo<br>";
		$cuerpo.= "<b>Nombres y Apellidos:</b> $nombre<br>";
		$cuerpo.= "<b>Cédula de Identidad o R.I.F.:</b> $cedrif<br>";
		$cuerpo.= "<b>Teléfono de Contacto (Local):</b> $destinatario_tel<br>";
		$cuerpo.= "<b>Teléfono de Contacto (Celular):</b> $destinatario_cel<br>";
		$cuerpo.= "<b>Correo Electrónico:</b> $correo<br>";
		$cuerpo.= "<br><br><b>DATOS DEL PRODUCTO</b><br>";
		$cuerpo.= "<b>Producto Comprado u Ofertado:</b> $producto<br>";
		$cuerpo.= "<b>Cantidad de Productos:</b> $cantidad<br>";
		$cuerpo.= "<b>Modelo:</b> $modelo<br>";
		$cuerpo.= "<b>Color:</b> $color<br>";
		$cuerpo.= "<b>Detalle del Producto:</b> $detalle<br>";
		$cuerpo.= "<br><br><b>DATOS DEL PAGO</b><br>";
		$cuerpo.= "<b>Medio de Pago:</b> $medio<br>";
		$cuerpo.= "<b>Banco donde efectuó el Pago:</b> $bancopago<br>";
		$cuerpo.= "<b>Número de Transferencia, Depósito o Pago:</b> $numpago<br>";
		$cuerpo.= "<b>Banco Emisor (Solo Transferencias):</b> $bancoemisor<br>";
		$cuerpo.= "<b>Fecha del Pago:</b> $fechapago_es<br>";
		$cuerpo.= "<b>Monto del Pago (BsF):</b> $montopago<br>";
		$cuerpo.= "<br><br><b>DATOS DEL ENVIO</b><br>";
		$cuerpo.= "<b>Tipo de Entrega:</b> $tipoentrega<br>";
		if (FORMULARIO_MODALIDAD_PAGO){
			$cuerpo.= "<b>Modalidad de Pago:</b> $modalidadpago<br>";
		}
		$cuerpo.= "<b>Servicio de Encomienda:</b> $servicioencomienda<br>";
		$cuerpo.= "<b>Dirección de la Sucursal:</b> $direccionencomienda<br>";
		$cuerpo.= "<b>Nombre y Apellido / Razón Social:</b> $nombre<br>";
		$cuerpo.= "<b>Cédula de Identidad:</b> $cedrif<br>";
		$cuerpo.= "<b>Teléfono de Contacto (Local):</b> $destinatario_tel<br>";
		$cuerpo.= "<b>Teléfono de Contacto (Celular):</b> $destinatario_cel<br>";
		$cuerpo.= "<b>Localidad:</b> $localidad<br>";
		$cuerpo.= "<b>Inmueble:</b> $inmueble<br>";
		$cuerpo.= "<b>Parroquia:</b> $parroquia<br>";
		$cuerpo.= "<b>Municipio:</b> $municipio<br>";
		$cuerpo.= "<b>Ciudad / Pueblo:</b> $ciudad<br>";
		$cuerpo.= "<b>Estado:</b> $estado<br>";
		$cuerpo.= "<b>País:</b> $pais<br>";
		$cuerpo.= "<b>Zona Postal:</b> $zpostal<br>";
		$cuerpo.= "<b>Observaciones:</b> $observaciones<br>";
		
		$topProveedor = "Se ha realizado el siguiente registro para el usuario <b>$seudonimo</b>:<br><br>";
		$bottomProveedor = "<br><br><i>Enviado el $fecha_envio</i>";
		$cuerpoProveedor = $topProveedor.$cuerpo.$bottomProveedor;

		$mailProveedor = new NotificacionCorreo();
		$mailProveedor->Asunto("El Sr/Sra $nombre, Acaba de Notificar un Pago: $numpago");
		$mailProveedor->CorreoOrigen(MAIL_USUARIO);
		$mailProveedor->NombreOrigen("Pagos");
		$mailProveedor->Cuerpo($cuerpoProveedor);
		$mailProveedor->AddAttachment("./archivos/".$adjunto, $adjunto);
		//$mailProveedor->AgregarDestino($correo, $nombre);
		$mailProveedor->AgregarDestino(MAIL_USUARIO, 'Pagos');
		if (MAIL_ENVIAR){
			if (!$mailProveedor->Enviar()){	        			
				echo json_encode(array("respuesta"=>"ok", "mensaje"=>"Su pago ha sido registrado, pero no se pudo enviar el correo.", "mostrar",true));
				exit();
			}
		}

		$topCliente = "Hola <b>$seudonimo</b>, gracias por registrar tu pago. A continuación te enviamos una copia de los datos:<br><br>";
		$bottomCliente = "<br><br>Estamos para servirle...<br><br>Atentamente... <b>$empNombre</b>";
		$cuerpoCliente = $topCliente.$cuerpo.$bottomCliente;

		$mailCliente = new NotificacionCorreo();
		$mailCliente->Asunto("Hemos recibido los datos de su pago #$numpago");
		$mailCliente->CorreoOrigen(MAIL_USUARIO);
		$mailCliente->NombreOrigen("$empNombre");
		$mailCliente->Cuerpo($cuerpoCliente);
		$mailCliente->AddAttachment("./archivos/".$adjunto, $adjunto);
		$mailCliente->AgregarDestino($correo, $nombre);
		
		if (MAIL_ENVIAR){
			if (!$mailCliente->Enviar()){	        			
				echo json_encode(array("respuesta"=>"ok", "mensaje"=>"Su pago ha sido registrado, pero no se pudo enviar el correo.", "mostrar",true));
				exit();
			}
		}
		echo json_encode(array("respuesta"=>"ok", "mensaje"=>"Se registró la información."));
		exit();
	}
	else{
		echo json_encode(array("respuesta"=>"error", "mensaje"=>"No se pudo registrar la información. Intente de nuevo."));
		exit();
	}
?>