<div class="container">
	<h2>What is your email?</h3>

	<?=Form::open()?>

		<div class="row">
			<?=Form::label('email', 'Email:')?>
			<?=Form::input('text', 'email')?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Submit Email', '')?>
		</div>

	<?=Form::close()?>

</div>