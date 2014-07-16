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
			<a href="user_profile.php?id=<?=$thread->user_id?>"><?=$creator->username?></a>
		</h4>
		<div id="original" class="post_box">
			<div class="col-2 user_anchor">
				<? if($creator->admin == 1): ?>
					<p class="small_text">Admin</p>
				<? else: ?>
					<p class="small_text">Member</p>
				<? endif; ?>
				<img class="avatar" src="<?=$creator->image?>"><br>
				<p class="small_text"><?=$creator->location?></p>
			</div>
			<div class="col-10 post_anchor">
				<div class="small_text post_date">
					<p><?=$thread->date_posted?></p>
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
					<a href="user_profile.php?id=<?=$comment['user_id']?>"><?=$poster->username?></a>
				</h4>
				<div class="post_box">
					<div class="col-2 user_anchor">
						<? if($poster->admin == 1): ?>
							<p class="small_text">Admin</p>
						<? else: ?>
							<p class="small_text">Member</p>
						<? endif; ?>
						<img class="avatar" src="<?=$poster->image?>"><br>
						<p class="small_text"><?=$poster->location?></p>
					</div>
					<div class="col-10 post_anchor">
						<div class="small_text post_date">
							<p><?=$comment['date_posted']?></p>
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