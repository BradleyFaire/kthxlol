<div class="container">
	<h2>Register:</h3>

	<?=Form::open()?>
		
		<div class="row">
			<?=Form::label('username', 'Username:')?>
			<?=Form::input('text', 'username', $_POST['username'])?>
		</div>

		<div class="row">
			<?=Form::label('email', 'Email:')?>
			<?=Form::input('text', 'email', $_POST['email'])?>
		</div>

		<div class="row">
			<?=Form::label('password', 'Password:')?>
			<?=Form::input('password', 'password', $_POST['password'])?>
		</div>

		<div class="row">
			<?=Form::label('confirmpassword', 'Confirm Password:')?>
			<?=Form::input('password', 'confirmpassword')?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Register', '')?>
		</div>

	<?=Form::close()?>

</div>