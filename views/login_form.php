<div class="container">
	<h2>Login:</h3>

	<?=Form::open()?>
		
		<div class="row">
			<?=Form::label('username', 'Username:')?>
			<?=Form::input('text', 'username', $_POST['username'])?>
		</div>

		<div class="row">
			<?=Form::label('password', 'Password:')?>
			<?=Form::input('password', 'password', $_POST['password'])?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Login')?>
		</div>

	<?=Form::close()?>

	<div class="row">
		<a href="register.php"><button class="register">Register</button></a>
	</div>

</div>