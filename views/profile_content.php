<div class="container">
	<h2><?=$title?></h2>

	<div class="product">

	<?=Form::open()?>

		<div class="col-6 post_anchor">
			<div class="row">
				<?=Form::label('username', 'Username:')?>
				<?=Form::input('text', 'username', $user->username)?>
			</div>

			<div class="row">
				<?=Form::label('email', 'Email:')?>
				<?=Form::text('email', $user->email)?>
			</div>

			<div class="row">
				<?=Form::label('hide_email', 'Hide your Email?')?>
				<?=Form::radio('hide_email', 1)?><p class="radio">Yes</p><br>
				<?=Form::radio('hide_email', 0)?><p class="radio">No</p>
			</div>

			<div class="row">
				<?=Form::label('image', 'Image:')?>
				<?=Form::text('image', $user->image)?>
			</div>

		</div>
		<div class="col-6 post_anchor">

			<div class="row">
				<?=Form::label('description', 'Description:')?>
				<?=Form::textarea('description', $user->description)?>
			</div>

			<div class="row">
				<?=Form::label('signature', 'Signature:')?>
				<?=Form::text('signature', $user->signature)?>
			</div>

			<div class="row">
				<?=Form::label('location', 'Location:')?>
				<?=Form::text('location', $user->location)?>
			</div>
		</div>

		<div class="row">

			<?=Form::submit('Update')?>

		</div>

		<?=Form::close()?>

	</div>
</div>