<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <title><?php echo $empNombre; ?> - Registro de Pagos</title>
      <!-- styles -->
      <link rel="stylesheet" href="css/style.css">
   </head>
   <body>

      <!-- title -->
      <h2 class="title">Registro de pagos</h2>

      <!-- multistep form -->
<form id="msform">
	<!-- progressbar -->
	<ul id="progressbar">
		<li class="active">Datos del cliente</li>
		<li>Datos del Producto y Pago</li>
		<li>Datos de Envio</li>
	</ul>
	<!-- fieldsets -->
	<fieldset>
		<h2 class="fs-title">Create your account</h2>
		<h3 class="fs-subtitle">This is step 1</h3>
		<input type="text" name="email" placeholder="Email" />
		<input type="password" name="pass" placeholder="Password" />
		<input type="password" name="cpass" placeholder="Confirm Password" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Social Profiles</h2>
		<h3 class="fs-subtitle">Your presence on the social network</h3>
		<input type="text" name="twitter" placeholder="Twitter" />
		<input type="text" name="facebook" placeholder="Facebook" />
		<input type="text" name="gplus" placeholder="Google Plus" />
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="button" name="next" class="next action-button" value="Next" />
	</fieldset>
	<fieldset>
		<h2 class="fs-title">Personal Details</h2>
		<h3 class="fs-subtitle">We will never sell it</h3>
		<input type="text" name="fname" placeholder="First Name" />
		<input type="text" name="lname" placeholder="Last Name" />
		<input type="text" name="phone" placeholder="Phone" />
		<textarea name="address" placeholder="Address"></textarea>
		<input type="button" name="previous" class="previous action-button" value="Previous" />
		<input type="submit" name="submit" class="submit action-button" value="Submit" />
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
