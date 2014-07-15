<div class="container">
	<h2><?=$title?></h2>

	<div class="product">

	<?=Form::open()?>

		<div class="row">
			<?=Form::label('name', 'Name:')?>
			<?=Form::input('text', 'name', $page_stuff->name)?>
		</div>

		<div class="row">
			<?=Form::label('content', 'Content:')?>
			<?=Form::textarea('content', $page_stuff->content)?>
		</div>

		<div class="row">
			
			<? if ($_GET['id']): ?>

				<?=Form::submit('Update')?>

				<a href="../public/delete_page.php?id=<?=$_GET['id']?>" class="delete_button">Delete Page</a>

			<? else: ?>
				<?=Form::submit('Create')?>
			<? endif; ?>
		</div>

		<?=Form::close()?>

	</div>
</div>