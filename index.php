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
<form id="msform" action="./proceso.php" method="post">
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
      <input type="date" name="fechapago" id="fechapago" class="fecha alcincuenta" value="<?php echo date("d/m/Y"); ?"/>
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

<!-- jQuery -->
<!-- <script src="bower_components/dist/jquery.min.js" type="text/javascript"></script> -->
<script src="http://thecodeplayer.com/uploads/js/jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="http://thecodeplayer.com/uploads/js/jquery.easing.min.js" type="text/javascript"></script>
<!-- my script -->
<script src="js/script.js" type="text/javascript">
</script>

   </body>
</html>
