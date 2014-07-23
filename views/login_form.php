<div class="container">
	<h2>Login:</h3>

	<?=Form::open()?>
		
		<div class="row">
			<?=Form::label('username', 'Username:')?>
			<?=Form::input('text', 'username', $_POST['username'])?>
		</div>

		<div class="row">
			<?=Form::label('password', 'Password:')?>
			<?=Form::input('password', 'password')?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<p><a class="threadlink" href="forgot_password.php">Forgot your password?</a></p>

		<div class="row">
			<?=Form::submit('Login')?>
		</div>

	<?=Form::close()?>

	<div class="row">
		<a class="button" href="register.php">Register</a>
	</div>

</div>