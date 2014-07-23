<div class="container">
	<h2>Register:</h3>

	<?=Form::open()?>

		<div class="row">
			<?=Form::label('current_password', 'Current Password:')?>
			<?=Form::input('password', 'current_password')?>
		</div>

		<div class="row">
			<?=Form::label('password', 'New Password:')?>
			<?=Form::input('password', 'password')?>
		</div>

		<div class="row">
			<?=Form::label('confirmpassword', 'Confirm New Password:')?>
			<?=Form::input('password', 'confirmpassword')?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Change Password', '')?>
		</div>

	<?=Form::close()?>

</div>