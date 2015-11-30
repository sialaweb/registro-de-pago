<?php
include("base.php");
     /*
     $strBancos="100% Banco|Arrendadora Financiera Empresarial, C.A. ANFICO|Bancamiga Banco Microfinanciero, C.A.|BanCaribe|Banco Activo|Banco Agrícola de Venezuela|Banco Caroní|Banco de Comercio Exterior|Banco de Venezuela|Banco del Tesoro|Banco Espírito Santo|Banco Exterior|Banco Guayana|Banco Internacional de desarrollo C.A.|Banco Mercantil|Banco Nacional de Crédito|Banco Nacional de Vivienda y el Hábitat|Banco Occidental de Descuento|Banco Plaza|Banco Sofitasa|Bancrecer SA|Banesco|Bangente|Banplus|BBVA Banco Provincial|BFC Banco Fondo Común|Citibank|Corp Banca C.A.|Del Sur|Instituto Municipal de Crédito Popular|Mi Banco|Sofioccidente Banco de Inversión";
     $arrBancos = explode("|", $strBancos);
     foreach ($arrBancos as $banco) {
          //echo "$banco<br>";
          mysql_query("INSERT INTO banco (nombre) VALUES ('$banco')");
     }
     exit();
     */
     ?>
     <!DOCTYPE html>
     <html>
     <head>
     	<title><?php echo $empNombre; ?> - Formulario de Pago</title>
     	<meta http-equiv="content-type" content="text/html;charset=utf-8" />

     	<!-- styles -->
     	<link rel="stylesheet" href="style.css">

     	<!-- type -->
     	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,700,400' rel='stylesheet'>

     	<script type="text/javascript" src="js/jquerybase.js"></script>
     	<script type="text/javascript" src="js/supervalidacion.jquery.js"></script>
     	<script type="text/javascript" src="js/cutefocus.jquery.js"></script>
     </head>
     <body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
     	<div id="absoluto"></div>
     	<div class="pagina">
     		<div class="top">
     			<table id="Tabla_01" width="900" height="500" border="0" cellpadding="0" cellspacing="0" align="center">
     				<tbody>
     				<tr>
     					<td colspan="4">
     						<img src="imagenes/video-header.gif"></td>
     					</tr>
     					<tr>
     						<td colspan="4" >
     							<img src="imagenes/plantilla-carro.jpg"></td>
     						</tr>
     				</tbody>
     			</table>
     		</div>
     				<div class="cuerpo">
     					<div class="titulo">
     						<h2>FORMULARIO DE PAGO</h2>
     					</div>
     					<div class="formulario">
     						<form action="./proceso.php" method="post" id="form-pago">
     							<span class="subtitulo"><span>Datos del Cliente</span></span>
     							<div class="clear"></div>
     							<label for="seudonimo">Tu Seudónimo en Mercadolibre</label>
     							<input type="text" name="seudonimo" id="seudonimo" maxlength="30" spval="*" spval-msj="El seudónimo es campo obligatorio" />
     							<span class="infex">Si no compro a través de MercadoLibre, favor ingresar su nombre y apellido</span>
     							<div class="clear"></div>
     							<label for="nombre">Tus Nombres y Apellidos</label>
     							<input type="text" name="nombre" id="nombre" maxlength="50" spval="*" spval-msj="El nombre es un campo obligatorio" />
     							<div class="clear"></div>
     							<label for="cedrif">Cédula de Identidad o R.I.F.</label>
     							<select id="precedrif" name="precedrif" class="cedsel" spval="*" spval-msj="El tipo de documento es obligatorio">
     								<option value="">-</option>
     								<option value="V">V</option>
     								<option value="J">J</option>
     								<option value="G">G</option>
     								<option value="E">E</option>
     								<option value="C">C</option>
     							</select>
     							<input type="text" class="cedtxt" name="cedrif" id="cedrif" maxlength="15" spval="*|int" spval-msj="La Cédula o RIF es un campo obligatorio, y debe ser un valor numérico" />
     							<div class="clear"></div>
     							<label for="correo">Correo Electrónico</label>
     							<input type="text" name="correo" id="correo" maxlength="60" spval="*|@" spval-msj="Debe escribir un correo electrónico válido" /><span class="infex">El mismo de MercadoLibre y te enviaremos ofertas de nuestros productos</span>
     							<div class="clear"></div>
     							<label for="destinatario_tel">Teléfono de Contacto (Local)</label>
     							<select id="cod_destinatario_tel" name="cod_destinatario_tel" spval="*?:!cod_destinatario_cel,!destinatario_cel|*?:destinatario_tel" spval-msj="Debes ingresar al menos un número telefónico. Selecciona el código e ingresa el número">
     								<option value="">[Cód]</option>
     								<?php
     								for ($i=212; $i<=296; $i++){
     									echo "<option value=\"$i\">$i</option>";
     								}
     								?>
     							</select>
     							<input type="text" name="destinatario_tel" id="destinatario_tel" maxlength="15" spval="*?:cod_destinatario_tel|int" spval-msj="Debes ingresar un valor numérico" /><span class="infex">Debe indicar al menos un número telefónico, sea celular o fijo</span>
     							<div class="clear"></div>
     							<label for="destinatario_cel">Teléfono de Contacto (Celular)</label>
     							<select id="cod_destinatario_cel" name="cod_destinatario_cel" spval="*?:destinatario_cel" spval-msj="Debes seleccionar el código del teléfono celular">
     								<option value="">[Cód]</option>
     								<option value="412">412</option>
     								<option value="414">414</option>
     								<option value="416">416</option>
     								<option value="424">424</option>
     								<option value="426">426</option>
     							</select>
     							<input type="text" name="destinatario_cel" id="destinatario_cel" maxlength="15" spval="*?:cod_destinatario_cel|int" spval-msj="Debes ingresar un valor numérico"/>
     							<div class="clear"></div>
     							<div class="separador"></div>
     							<span class="subtitulo"><span>Datos del Producto</span></span>
     							<div class="clear"></div>
     							<label for="producto">Producto Comprado u Ofertado</label>
     							<input type="text" name="producto" id="producto" maxlength="100" spval="*" spval-msj="El producto es un campo obligatorio" />
     							<div class="clear"></div>
     							<label for="cantidad">Cantidad de Productos</label>
     							<input type="text" name="cantidad" id="cantidad" maxlength="15" spval="*|int|[1,]" spval-msj="La cantidad debe ser un valor numérico mayor a 1" /><span class="infex">Cantidad ( Nro ) Artículo</span>
     							<div class="clear"></div>
     							<label for="modelo">Modelo</label>
     							<input type="text" name="modelo" id="modelo" maxlength="30" /><span class="opt">(opcional)</span>
     							<div class="clear"></div>
     							<label for="color">Color</label>
     							<input type="text" name="color" id="color" maxlength="30" /><span class="opt">(opcional)</span>
     							<div class="clear"></div>
     							<label for="talla">Detalle del Producto</label>
     							<input type="text" name="detalle" id="detalle" /><span class="opt">(opcional)</span>
     							<div class="clear"></div>
     							<div class="separador"></div>
     							<span class="subtitulo"><span>Datos del Pago</span></span>
     							<div class="clear"></div>
     							<label for="medio">Medio de Pago</label>
        							<select id="medio" name="medio" spval="*" spval-msj="El medio de pago es un campo obligatorio">
        								<option value="">Seleccione</option>
        								<?php
        								$r=mysql_query("SELECT pago_tipo_id, nombre FROM pago_tipo");
        								while ($rs=mysql_fetch_array($r)){
        									echo "<option value=\"$rs[0]\">$rs[1]</option>";
        								}
        								?>
        							</select>
     							<div class="clear"></div>
     							<label for="bancopago">Banco donde efectuó el Pago</label>
     							<select name="bancopago" id="bancopago" spval="*" spval-msj="El banco donde efectuó el pago es un campo obligatorio">
     								<option value="">Seleccione</option>
     								<?php
     								$r=mysql_query("SELECT banco_destino_id, nombre FROM banco_destino ORDER BY nombre");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select>
     							<div class="clear"></div>
     							<label for="numpago">Número de Transferencia, Depósito o Pago</label>
     							<input type="text" name="numpago" id="numpago" maxlength="50" spval="*|int" spval-msj="El número de depósito o transferencia es un campo obligatorio, y debe ser un valor numérico" />
     							<div class="clear"></div>
     							<label for="archivo">Adjunte un documento</label>
     							<div id="c_archivo">
     								<span id="txtfile" class="txtfile"></span></span><span class="btn"><img src="imagenes/btn-file.png"><input type="file" name="archivo" id="archivo" /></span>
     							</div><span class="infex">pdf, doc o imagen con una captura del recibo del pago o transferencia.</span>
     							<div class="clear"></div>
     							<label for="bancoemisor">Banco Emisor (Solo Transferencias)</label>
     							<select name="bancoemisor" id="bancoemisor" class="no-disponible" disabled="disabled" spval="*" spval-msj="El banco emisor es un campo obligatorio">
     								<option value="">[No Aplica]</option>
     								<?php
     								$r=mysql_query("SELECT banco_origen_id, nombre FROM banco_origen ORDER BY nombre");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select>
     							<div class="clear"></div>
     							<label for="fechapago">Fecha del Pago</label>
     							<input type="text" name="fechapago" id="fechapago" class="fecha" maxlength="10" value="<?php echo date("d/m/Y"); ?>" spval="*|#" readonly="readonly" spval-msj="Introduzca un formato de fecha válida" />
     							<div class="clear"></div>
     							<label for="montopago">Monto del Pago</label>
     							<input type="text" name="montopago" id="montopago" maxlength="15" class="moneda" spval="*|float" spval-msj="El monto es un campo obligatorio, y debe ser un valor numérico. Recuerde que el separador decimal es el punto." /><span class="txtpost">BsF</span>
     							<div class="clear"></div>
     							<div class="separador"></div>
     							<span class="subtitulo"><span>Datos del Envío</span></span>
     							<div class="clear"></div>
     							<label for="tipoentrega">Tipo de Entrega</label>
     							<select id="tipoentrega" name="tipoentrega" spval="*" spval-msj="El tipo de entrega es un campo obligatorio">
     								<option value="">Seleccione</option>
     								<?php
     								$r=mysql_query("SELECT entrega_tipo_id, nombre FROM entrega_tipo");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select>
     							<div class="clear"></div>
     							<?php
     							if (FORMULARIO_MODALIDAD_PAGO):
     								?>
     							<label for="modalidadpago">Modalidad de Pago</label>
     							<select id="modalidadpago" name="modalidadpago" spval="*" spval-msj="Debe indicar la modalidad del pago" class="no-disponible tcasa tencomienda st-tentrega">
     								<option value="">Seleccione</option>
     								<?php
     								$r=mysql_query("SELECT pago_modalidad_id, nombre FROM pago_modalidad");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select><span class="infex">Puede seleccionar <b>Pre-Pagado solo si la publicación lo ofrece</b>.</span>
     							<div class="clear"></div>
     							<?php
     							endif;
     							?>
     							<label for="servicioencomienda">Servicio de Encomienda</label>
     							<select id="servicioencomienda" name="servicioencomienda" spval="*" spval-msj="El servicio de encomienda es un campo obligatorio" class="st-tentrega tencomienda no-disponible tcasa" disabled="disabled">
     								<option value="">Seleccione</option>
     								<?php
     								$r=mysql_query("SELECT servicio_id, nombre FROM servicio");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select>
     							<div class="clear"></div>
     							<label for="direccionencomienda">Dirección de la Sucursal</label>
     							<textarea name="direccionencomienda" id="direccionencomienda" class="no-disponible tencomienda st-tentrega" disabled="disabled" spval="*" spval-msj="La dirección de la sucursal es un campo obligatorio"></textarea><span class="infex">Ingrese el código o la dirección de la sucursal de la Oficina de Encomienda.</span>
     							<div class="clear"></div>
     							<label>Nombres y Apellidos</label>
     							<span class="campo-falso" id="falso-nombre"></span><span class="infex">Si desea enviar a otra persona, colocar los datos en observación y será contactado</span>
     							<div class="clear"></div>
     							<label>Cédula de Identidad o R.I.F.</label>
     							<span class="campo-falso" id="falso-cedula-rif"></span>
     							<div class="clear"></div>
     							<label>Teléfono de Contacto (Local)</label>
     							<span class="campo-falso" id="falso-tel-local"></span>
     							<div class="clear"></div>
     							<label>Teléfono de Contacto (Celular)</label>
     							<span class="campo-falso" id="falso-tel-celular"></span>
     							<div class="clear"></div>
     							<label for="localidad">Localidad</label><span class="infex">Sector, Avenida, Calle, Carrera, Vereda, Aldea, Barrio, Callejon, Pasaje, Asentamiento, Caserío, Terraza, Urbanización, Escalera, Esquina, Ciudadela, Hacienda, Parque Residencial, Residencias, Entre Otros</span>
     							<textarea name="localidad" id="localidad" class="no-disponible tcasa st-tentrega" disabled="disabled" spval="*" spval-msj="El campo localidad es obligatorio"></textarea>
     							<div class="clear"></div>
     							<label for="inmueble">Inmueble</label><span class="infex">Nombre O Número, Edificio, Bloque, Casa, Quinta, Piso, Torre, Apartamento, Oficina, Local, Consultorio, Entre Otros</span>
     							<textarea name="inmueble" id="inmueble" class="no-disponible tcasa st-tentrega" disabled="disabled" spval="*" spval-msj="El campo inmueble es obligatorio"></textarea>
     							<div class="clear"></div>
     							<label for="parroquia">Parroquia</label>
     							<input type="text" name="parroquia" id="parroquia" maxlength="50" class="no-disponible tcasa st-tentrega" disabled="disabled" spval="*" spval-msj="El campo parroquia es obligatorio" />
     							<div class="clear"></div>
     							<label for="municipio">Municipio</label>
     							<input type="text" name="municipio" id="municipio" maxlength="50" class="no-disponible tcasa st-tentrega" disabled="disabled" spval="*" spval-msj="El campo municipio es obligatorio" />
     							<div class="clear"></div>
     							<label for="ciudad">Ciudad / Pueblo</label>
     							<input type="text" name="ciudad" id="ciudad" maxlength="50" spval="*" class="st-tentrega tcasa no-disponible" spval-msj="El campo ciudad/pueblo es obligatorio" disabled="disabled" />
     							<div class="clear"></div>
     							<label for="estado">Estado</label>
     							<select id="estado" name="estado" spval="*" spval-msj="El campo estado es obligatorio" class="st-tentrega tcasa no-disponible" disabled="disabled">
     								<option value="">Seleccione</option>
     								<?php
     								$r=mysql_query("SELECT estado_id, nombre FROM estado ORDER BY nombre");
     								while ($rs=mysql_fetch_array($r)){
     									echo "<option value=\"$rs[0]\">$rs[1]</option>";
     								}
     								?>
     							</select>
     							<div class="clear"></div>
     							<label for="pais">País</label>
     							<input type="text" name="pais" id="pais" maxlength="50" class="no-disponible tcasa st-tentrega" disabled="disabled" spval="*" value="Venezuela" spval-msj="El campo pais es obligatorio" />
     							<div class="clear"></div>
     							<label for="zpostal">Zona Postal</label>
     							<input type="text" name="zpostal" id="zpostal" maxlength="15" class="tam1 no-disponible tcasa st-tentrega" disabled="disabled" spval="*|int" spval-msj="El campo zona postal es obligatorio y debe ser un valor numérico" />
     							<div class="clear"></div>
     							<label for="observaciones">Observaciones</label>
     							<textarea name="observaciones" id="observaciones"></textarea><span class="opt">(opcional)</span>
     							<div class="clear"></div>
     							<br>
     							<div class="clear">
     								<input type="submit" value="Enviar" class="submit" />
     							</div>
     							<div class="clear"></div>
     						</form>
     					</div>
     					<div class="pie">
     						<img src="imagenes/piepagina.png" alt="">
     					</div>
     				</div>
     			</div>
     			<iframe id="archivo_target" name="archivo_target" src=""></iframe>
     			<form action="proceso.php?archivo" target="archivo_target" id="archivo_form" method="post" enctype="multipart/form-data"></form>
     			<div id="capa-proteccion">
     				<div class="msj">Por favor espere mientras cargamos todos sus datos...</div>
     			</div>
     		</body>
     		</html>
     		<script type="text/javascript">
     		$(document).ready(function(){
     			$("#fechapago").datepicker();
     			$.datepicker.regional['es'] = {
     				closeText: 'Cerrar',
     				prevText: '&#x3c;Ant',
     				nextText: 'Sig&#x3e;',
     				currentText: 'Hoy',
     				monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
     				'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
     				monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun', 'Jul','Ago','Sep','Oct','Nov','Dic'],
     				dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
     				dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
     				dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
     				weekHeader: 'Sm',
     				dateFormat: 'dd/mm/yy',
     				firstDay: 1,
     				isRTL: false,
     				showMonthAfterYear: false,
     				yearSuffix: ''};
     				$.datepicker.setDefaults($.datepicker.regional['es']);
     				$('#medio').on('change', function(){
     					var valor = $(this).val();
     					if (valor==1 || valor==3){
     						desbloquear($('#bancoemisor'));

     					}
     					else{
     						bloquear($('#bancoemisor'));
     					}
     				});
     				$('#tipoentrega').on('change', function(){
     					var valor = $(this).val();
     					if (valor == 1){
     						$('#form-pago').find('.tencomienda').each(function(){
     							var $e = $(this);
     							bloquear($e);
     						});
     						$('#form-pago').find('.tcasa').each(function(){
     							var $e = $(this);
     							desbloquear($e);
     							if ($e.attr('id')=='pais')
     								$e.val('Venezuela');
     						});
     					} else if (valor == 2){
     						$('#form-pago').find('.tcasa').each(function(){
     							var $e = $(this);
     							bloquear($e);
     						});
     						$('#form-pago').find('.tencomienda').each(function(){
     							var $e = $(this);
     							desbloquear($e);
     						});
     					} else {
     						$('#form-pago').find('.st-tentrega').each(function(){
     							var $e = $(this);
     							bloquear($e);
     						});
     					}
               /*if (valor==2){
                    $('#form-pago').find('.tencomienda').each(function(){
                         var $e = $(this);
                         desbloquear($e);
                    });
               }
               else{
                    $('#form-pago').find('.tencomienda').each(function(){
                         var $e = $(this);
                         bloquear($e);
                    });
               }
               if (valor==1){
                    $('#form-pago').find('.tcasa').each(function(){
                         var $e = $(this);
                         desbloquear($e);
                         if ($e.attr('id')=='pais')
                              $e.val('Venezuela');
                    });
               }
               else{
                    $('#form-pago').find('.tcasa').each(function(){
                         var $e = $(this);
                         bloquear($e);
                    });
}*/

});
$('#form-pago').find('input:disabled, select:disabled, textarea:disabled').each(function(){
	var tipo=$(this).prop('nodeName');
	tipo = tipo.toUpperCase();
	if (tipo=='SELECT'){
		$(this).find('option')[0].text='[No Aplica]';
	}
	else{
		$(this).val('[No Aplica]')
	}
});
$('#cod_destinatario_tel, #destinatario_tel').on('change', refrescaTelefono);
$('#destinatario_tel').on('keyup', refrescaTelefono);
$('#cod_destinatario_cel, #destinatario_cel').on('change', refrescaCelular);
$('#destinatario_cel').on('keyup', refrescaCelular);
$('#nombre').on('change', refrescaNombre);
$('#nombre').on('keyup', refrescaNombre);
$('#precedrif, #cedrif').on('change', refrescarCedula);
$('#cedrif').on('keyup', refrescarCedula);
});
var refrescarCedula = function(){
	var letra = $('#precedrif').val();
	var numero = $('#cedrif').val();
	var cedula = letra+'-'+numero;
	if (/^[VJGEC]-\d+$/.test(cedula)){
		$('#falso-cedula-rif').html(cedula);
	}
	else{
		$('#falso-cedula-rif').html('');
		console.log(cedula + ' no cumple');
	}
}
var refrescaNombre = function(){
	var nombre = $(this).val();
	nombre = $.trim(nombre);
	$('#falso-nombre').html(nombre);
}
var refrescaTelefono = function(){
	var codigo = $('#cod_destinatario_tel').val();
	var numero = $('#destinatario_tel').val();
	var completo = codigo+'-'+numero;
	completo = $.trim(completo);
	if (/^\d+-\d+$/.test(completo))
		$('#falso-tel-local').html(completo);
	else
		$('#falso-tel-local').html('');
}
var refrescaCelular  = function(){
	var codigo = $('#cod_destinatario_cel').val();
	var numero = $('#destinatario_cel').val();
	var completo = codigo+'-'+numero;
	completo = $.trim(completo);
	if (/^\d+-\d+$/.test(completo))
		$('#falso-tel-celular').html(completo);
	else
		$('#falso-tel-celular').html('');
}

$('#form-pago').SuperValidacion({
	trim: true,
	onSuccess: function(){
               //Paso la validacion
               protegerForm(true);
               var form = $('#form-pago').serialize();

               $('#form-pago').find('input, select, textarea').not(':disabled').each(function(){
               	var campo = $(this);
               	campo.addClass('protegido');
               	campo.attr('disabled','disabled');
               });

               var frmImg = document.getElementById('archivo_form');
               var archivo = document.getElementById('archivo');
               if ($('#txtfile').html() != ''){
               	archivo.disabled = false;
               	$('#archivo').appendTo(('#archivo_form'));
               	$("iframe#archivo_target").on('load', function(){
               		var respAdjTxt = $(this).contents().find('body').html();
               		var respAdj = $.parseJSON(respAdjTxt);
               		if (respAdj.respuesta=='ok'){
               			var nom = respAdj.nombre;
               			form = form + '&adjunto='+nom;
               			enviar(form);
               		}
               		else{
               			$("iframe#archivo_target").unbind();
               			alert(respAdj.mensaje);
               			desbloquearForm();
               			protegerForm(false);
               		}

               	});
               	frmImg.submit();
               }
               else{
               	enviar(form);
               }
               return false;
             },
             onError: function($e){
             	var msjspval = $e.attr('spval-msj');
             	if (msjspval){
                    //console.log(msjspval)
                    alert(msjspval);
                  }
                  $e.addClass('fondo-azul');
                  setTimeout(function(){
                  	$e.removeClass('fondo-azul');
                  }, 200);
                  $e.focus();
                }
              });
$('#archivo').on('change', function(){
	$('#txtfile').html($(this).val());
});
var protegerForm = function(proteger){
          //proteger = proteger || true;
          var $capa = $('#capa-proteccion');
          if (proteger){
          	$capa.css('display','block');
          }
          else{
          	$capa.css('display','none');
          }
        }
        var desbloquear = function(obj){
        	obj.removeAttr('disabled');
        	obj.removeClass('no-disponible');
        	var tipo=obj.prop('nodeName');
        	tipo = tipo.toUpperCase();
        	if (tipo=="SELECT"){
        		obj.find('option')[0].text='Seleccione';
        	}
        	else{
        		obj.val('');
        	}
        }
        var bloquear = function(obj){
          //obj.removeAttr('spval');
          obj.attr('disabled','disabled');
          obj.addClass('no-disponible');
          var tipo=obj.prop('nodeName');
          tipo = tipo.toUpperCase();
          if (tipo=="SELECT"){
          	obj.find('option')[0].text='[No Aplica]';
          }
          else{
          	obj.val('[No aplica]');
          }
        }
        var desbloquearForm = function(){
        	$('#form-pago').find('.protegido').each(function(){
        		var $e = $(this);
        		$e.removeAttr('disabled');
        		$e.removeClass('protegido');
        	});
        	$('#archivo').appendTo($('.btn'));
        }
        var enviar = function(datos){
        	$.ajax({
        		'url': './proceso.php',
        		'type': 'POST',
        		'data': datos,
        		success: function(data, status, xrh){
        			var resp = $.parseJSON(data);
        			if (resp.respuesta=='ok'){
        				location.href='./html/<?php echo $urlGracias; ?>';
        			}
        			else{
        				$("iframe#archivo_target").unbind();
        				alert(resp.mensaje);
        				desbloquearForm();

        			}
        			protegerForm(false);
        		},
        		error: function(xhr, textStatus, errorThrown){
        			location.href='./html/<?php echo $urlError; ?>';
        		}
        	});
        }
        $('#form-pago input:text[spval]').filter(function(){
        	var $text = $(this);
        	var regla = $text.attr('spval');
        	if (regla.match(/float/)){
        		$text.on('keydown', function(e){
        			var codigo = e.keyCode
        			if ($.inArray(codigo, [8,9,13,37,38,39,40,46,116,190,110])<0){
        				if ((codigo>=48 && codigo<=57) || (codigo>=96 && codigo<=105)){
        					return true;
        				}
        				else{
        					return false;
        				}
        			}
        		});
        	}
        	if (regla.match(/int/)){
        		$text.on('keydown', function(e){
        			var codigo = e.keyCode
        			if ($.inArray(codigo, [8,9,13,37,38,39,40,46,116])<0){
        				if ((codigo>=48 && codigo<=57) || (codigo>=96 && codigo<=105)){
        					return true;
        				}
        				else{
        					return false;
        				}
        			}
        		});
        	}
        });
        </script>
