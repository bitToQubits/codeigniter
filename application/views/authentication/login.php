<?php echo validation_errors(); ?>

<?php echo form_open("authentication/login"); ?>
<?php if(isset($message)) echo "{$message} <br><br>" ?>
<?php if(isset($_SESSION['user'])) echo "{$_SESSION['user']} <br><br>" ?>

<label for="username">username</label>
<input type="text" name="username" id="username">

<label for="password">password</label>
<input type="password" name="password" id="password">

<input type="submit" name="submit" value="Loguearse">

</form>