<?php
	$comments = new Comments($_GET['id']);
	$creator = new Users($thread->user_id);
?>
<div class="container">
<h2 class="threadtitle">
	<?=$thread->name?>
</h2>
<div class="all_posts">
	<div class="whole_post">
		<h4>
			<div class="name">
				<a href="user_profile.php?id=<?=$thread->user_id?>"><?=$creator->username?></a>
			</div>

			<? if($_SESSION['user_logged_in']||$_SESSION['admin_logged_in']): ?>
				<div class="reply">
					<? if($thread->user_id == $_SESSION['user_id']): ?>
						<a href="create_thread.php?id=<?=$thread->id?>">Edit</a> | 
					<? endif; ?>

					<a href="post_reply.php?id=<?=$thread->id?>">Reply</a>
				</div>
			<? endif; ?>
		</h4>
		<div class="post_box">
			<div class="col-2 user_anchor">
				<? if($creator->admin == 1): ?>
					<p class="small_text">Admin</p>
				<? else: ?>
					<p class="small_text">Member</p>
				<? endif; ?>
				<img class="big_avatar" src="<?=$creator->image?>"><br>
				<p class="small_text"><?=$creator->location?></p>
			</div>
			<div class="col-10 post_anchor">
				<div class="small_text post_date">
					<p><?=date('l, j F, Y', strtotime($thread->date_posted))?></p>
				</div>
				<div class="post_content">
					<?=$thread->content?>
				</div>
				<div class="small_text signature">
					<?=$creator->signature?>
				</div>
			</div>
		</div>
	</div>
	<? if($comments->count_items() != 0): ?>
		<? foreach($comments->items as $comment): ?>

			<?php $poster = new Users($comment['user_id']) ?>

			<div class="whole_post">
				<h4>
					<div class="name">
						<a href="user_profile.php?id=<?=$comment['user_id']?>"><?=$poster->username?></a>
					</div>

					<? if($_SESSION['user_logged_in']||$_SESSION['admin_logged_in']): ?>
						<div class="reply">
							<? if($comment['user_id'] == $_SESSION['user_id']): ?>
								<a href="post_reply.php?id=<?=$thread->id?>&amp;comment_id=<?=$comment['id']?>">Edit</a> | 
							<? endif; ?>

							<a href="post_reply.php?id=<?=$thread->id?>">Reply</a>
						</div>
					<? endif; ?>
				</h4>
				<div class="post_box">
					<div class="col-2 user_anchor">
						<? if($poster->admin == 1): ?>
							<p class="small_text">Admin</p>
						<? else: ?>
							<p class="small_text">Member</p>
						<? endif; ?>
						<img class="big_avatar" src="<?=$poster->image?>"><br>
						<p class="small_text"><?=$poster->location?></p>
					</div>
					<div class="col-10 post_anchor">
						<div class="small_text post_date">
							<p><?=date('l, j F, Y', strtotime($comment['date_posted']))?></p>
						</div>
						<div class="post_content">
							<?=$comment['content']?>
						</div>
						<div class="small_text signature">
							<?=$poster->signature?>
						</div>
					</div>
				</div>
			</div>

		<? endforeach; ?>
	<? endif; ?>
</div>
</div>