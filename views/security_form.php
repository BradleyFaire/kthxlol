<div class="container">
	<h2>What is your answer?</h3>

	<?=Form::open()?>

		<div class="row">
			<?=Form::label('security_answer', $_SESSION['temp_question'].':')?>
			<?=Form::input('text', 'security_answer')?>
		</div>

		<?php if($error): ?>
		<p class="error"><?=$error?></p>
		<?php endif; ?>

		<div class="row">
			<?=Form::submit('Submit Answer', '')?>
		</div>

	<?=Form::close()?>

</div>