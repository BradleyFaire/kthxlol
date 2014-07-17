<div class="container">
	<h2><?=$title?></h2>

	<div class="product">

	<?=Form::open()?>

		<?=Form::hidden('user_id', $_SESSION['user_id'])?>

		<div class="row">
			<?=Form::label('name', 'Name:')?>
			<?=Form::input('text', 'name', $thread_stuff->name)?>
		</div>

		<div class="row">
			<?=Form::label('content', 'Content:')?>
			<?=Form::textarea('content', $thread_stuff->content)?>
		</div>

		<div class="row">
			
			<? if ($_GET['id']): ?>

				<?=Form::submit('Update')?>

				<a href="../public/delete_thread.php?id=<?=$_GET['id']?>" class="delete_button">Delete Thread</a>

			<? else: ?>
				<?=Form::submit('Create')?>
			<? endif; ?>
		</div>

		<?=Form::close()?>

	</div>
</div>