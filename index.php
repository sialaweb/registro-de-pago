<?php
include("base.php");
?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title>Registro de Pagos</title>
      <!-- styles -->
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>

      <!-- title -->
      <h2 class="title">Registro de pagos</h2>

      <!-- multistep form -->
<form id="msform" action="proceso.php" method="post">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Datos del cliente</li>
		<li>Datos del Producto y Pago</li>
		<li>Datos de Envio</li>
	</ul>
	<!-- fieldsets -->
   <!-- PASO 1 -->
	<fieldset>
		<h2 class="fs-title">datos generales</h2>
		<h3 class="fs-subtitle">Paso 1/3</h3>
		<input type="text" name="seudonimo" id="seudonimo" placeholder="Tu Pseudonimo en Mercadolibre" spval="*" spval-msj="El seudónimo es campo obligatorio" />
		<input type="Text" name="nombre" id="nombre" placeholder="Nombre y Apellido" spval="*" spval-msj="El nombre es un campo obligatorio" />
		<input type="email" name="Correo" placeholder="Email" />
      <select id="precedrif" name="precedrif" class="cedsel" spval="*" spval-msj="El tipo de documento es obligatorio">
         <option value="">-</option>
         <option value="V">V</option>
         <option value="J">J</option>
         <option value="G">G</option>
         <option value="E">E</option>
         <option value="C">C</option>
      </select>
      <input type="text" class="cedtxt deselect" placeholder="Cédula de Identidad" name="cedrif" id="cedrif" maxlength="15" spval="*|int" spval-msj="La Cédula o RIF es un campo obligatorio, y debe ser un valor numérico" />
      <select id="cod_destinatario_cel" name="cod_destinatario_cel" spval="*?:destinatario_cel" spval-msj="Debes seleccionar el código del teléfono celular">
         <option value="">[Cód]</option>
         <option value="412">412</option>
         <option value="414">414</option>
         <option value="416">416</option>
         <option value="424">424</option>
         <option value="426">426</option>
      </select>
      <input type="tel" placeholder="Numero Celular" class="deselect" name="destinatario_cel" id="destinatario_cel" maxlength="15" spval="*?:cod_destinatario_cel|int" spval-msj="Debes ingresar un valor numérico"/>
      <!-- siguiente button -->
		<input type="button" name="next" class="next action-button" value="Siguiente" />
	</fieldset>
   <!-- PASO 2 -->
	<fieldset>
		<h2 class="fs-title">Datos del producto y pago</h2>
		<h3 class="fs-subtitle">Paso 2/3</h3>
		<input type="text" name="producto" id="producto" spval="*" placeholder="Nombre del Producto"/>
      <textarea name="observaciones" id="observaciones" placeholder="Detalles del Producto"></textarea>
      <h2 class="fs-title">Datos del pago</h2>
      <select class="alcincuenta" id="medio" name="medio" spval="*" spval-msj="El medio de pago es un campo obligatorio">
         <option value="">Medio de pago</option>
         <?php
         $r=mysql_query("SELECT pago_tipo_id, nombre FROM pago_tipo");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
      <select class="alcincuenta" name="bancopago" id="bancopago" spval="*" spval-msj="El banco donde efectuó el pago es un campo obligatorio">
         <option value="">Banco Donde Realizo el Pago</option>
         <?php
         $r=mysql_query("SELECT banco_destino_id, nombre FROM banco_destino ORDER BY nombre");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
      <select class="alcincuenta" name="bancoemisor" id="bancoemisor" class="no-disponible" spval="*" spval-msj="El banco emisor es un campo obligatorio">
         <option value="">Banco Emisor (solo transferencias)</option>
         <?php
         $r=mysql_query("SELECT banco_origen_id, nombre FROM banco_origen ORDER BY nombre");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
      <input type="date" name="fechapago" id="fechapago" class="fecha alcincuenta" value="<?php echo date("d/m/Y"); ?>"/>
      <!--TODO aqui colocar el cierre de php -->
      <input type="text" name="numpago" id="numpago" placeholder="Referencia de Depósito o Transferencia"/>
      <div id="c_archivo">
         <span id="txtfile" class="txtfile"></span></span><span class="btn"><input type="file" name="archivo" id="archivo" /></span>
      </div>

      <!-- boton de anterior y siguiente -->
		<input type="button" name="previous" class="previous action-button" value="Anterior" />
		<input type="button" name="next" class="next action-button" value="Siguiente" />
	</fieldset>
   <!-- paso 3 -->
	<fieldset>
		<h2 class="fs-title">Datos de envío</h2>
		<h3 class="fs-subtitle">Paso 3/3</h3>
      <select class="alcien" id="tipoentrega" name="tipoentrega" spval="*" spval-msj="El tipo de entrega es un campo obligatorio">
         <option value="">Tipo de Entrega</option>
         <?php
         $r=mysql_query("SELECT entrega_tipo_id, nombre FROM entrega_tipo");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
      <select id="modalidadpago" name="modalidadpago" spval="*" spval-msj="Debe indicar la modalidad del pago" class=" alcien no-disponible tcasa tencomienda st-tentrega">
         <option value="">Modalidad de pago</option>
         <?php
         $r=mysql_query("SELECT pago_modalidad_id, nombre FROM pago_modalidad");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
      <select id="servicioencomienda" name="servicioencomienda" spval="*" spval-msj="El servicio de encomienda es un campo obligatorio" class=" alcien st-tentrega tencomienda no-disponible tcasa">
         <option value="">Servicio de Encomienda</option>
         <?php
         $r=mysql_query("SELECT servicio_id, nombre FROM servicio");
         while ($rs=mysql_fetch_array($r)){
            echo "<option value=\"$rs[0]\">$rs[1]</option>";
         }
         ?>
      </select>
		<textarea name="direccionencomienda" id="direccionencomienda" class="no-disponible tencomienda st-tentrega" spval="*" spval-msj="La dirección de la sucursal es un campo obligatorio" placeholder="direccion de envío o de sucursal (también puede agregar detalles extras)"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Anterior" />
		<input type="submit" name="submit" class="submit action-button" value="Enviar" />
	</fieldset>
</form>

<!-- carga -->
<iframe id="archivo_target" name="archivo_target" src=""></iframe>
<form action="proceso.php?archivo" target="archivo_target" id="archivo_form" method="post" enctype="multipart/form-data"></form>
<div id="capa-proteccion">
   <div class="msj">Por favor espere mientras cargamos todos sus datos...</div>
</div>

<!-- jQuery -->
<!-- script de evio y pago -->
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

      <script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<!-- my script -->
<script src="js/script.js" type="text/javascript">
</script>

   </body>
</html>