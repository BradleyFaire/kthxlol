<div class="container">
	<h2>Register:</h3>

	<?=Form::open()?>

		<div class="row">
			<?=Form::label('hide_email', 'Hide your Email?')?>
			<?=Form::radio('hide_email', 1)?><p class="radio">Yes</p><br>
			<?=Form::radio('hide_email', 0)?><p class="radio">No</p>
		</div>
		
		<div class="row">
			<?=Form::label('security_question', 'Security Question:')?>
			<?=Form::input('text', 'security_question', $_POST['security_question'])?>
		</div>

		<div class="row">
			<?=Form::label('security_answer', 'Security Answer:')?>
			<?=Form::input('text', 'security_answer', $_POST['security_answer'])?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Finish Registration', '')?>
		</div>

	<?=Form::close()?>

</div>