<div class="container">
	<h2><?=$title?>: <a class="thread_link" href="thread.php?id=<?=$thread->id?>"><?=$thread->name?></a></h2>

	<div class="product">

	<?=Form::open()?>

		<?=Form::hidden('user_id', $_SESSION['user_id'])?>

		<?=Form::hidden('thread_id', $_GET['id'])?>

		<div class="row">
			<?=Form::label('content', 'Comment:')?>
			<?=Form::textarea('content', $comment->content)?>
		</div>

		<div class="row">
			
			<? if ($_GET['comment_id']): ?>

				<?=Form::submit('Update')?>

				<a href="../public/delete_comment.php?id=<?=$_GET['comment_id']?>" class="delete_button">Delete Comment</a>

			<? else: ?>
				<?=Form::submit('Post')?>
			<? endif; ?>
		</div>

		<?=Form::close()?>

	</div>
</div>