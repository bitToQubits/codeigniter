<?php echo form_open("authentication/register"); ?>
<label for="username">Usuario: </label>
<input type="text" name="username" id="username">
<br>
<label for="pass">Clave: </label>
<input type="password" name="pass" id="pass">
<br>
<input type="submit" value="Registrarse">
<?php echo validation_errors(); ?>
<?php echo isset($message) ? $message : ''; ?>
<?php echo form_close(); ?>