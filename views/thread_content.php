<div class="container">
<h2 class="threadtitle">
	<?=$thread->name?>
</h2>

<!-- Page Numbering -->
<div class="pagenumbers">
	<div class="leftnumbers col-5">
		<? if($number > 1): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><<</a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$back?>" class="pagebutton"><</a>
		<? elseif($number == 1): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><<</a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><</a>
		<? endif; ?>
	</div>

	<div class="middlenumbers col-2">
		<? if($totalpages < 6): ?>
			<? for($p = 0; $p < $totalpages; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number < 4): ?>
			<? for($p = 0; $p < $totalpages && $p < 5; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number > $lastmarker): ?>
			<? for($p = $lastmarker - 2; $p < $totalpages; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number > 3): ?>
			<? for($p = $left; $p < $right; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? endif; ?>
	</div>

	<div class="rightnumbers col-5">
		<? if($number < $totalpages): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$next?>" class="pagebutton">></a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">>></a>
		<? elseif($number == $totalpages): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">></a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">>></a>
		<? endif; ?>
	</div>
</div>

<!-- End of Page Numbering -->

<div class="all_posts">

	<? if($number == 1): ?>
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
						<?=$thread->get_filtered('content')?>
					</div>
					<div class="small_text signature">
						<?=$creator->signature?>
					</div>
				</div>
			</div>
		</div>
	<? endif; ?>
	<? if($comments->count_comments($_GET['id']) != 0): ?>
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
							<?=strip_tags($comment['content'], '<p><a><b><i><h1><h2><h3><h4><h5><h6><br>')?>
						</div>
						<div class="small_text signature">
							<?=$poster->signature?>
						</div>
					</div>
				</div>
			</div>

		<? endforeach; ?>
	<? endif; ?>
<!-- Page Numbering -->
<div class="pagenumbers">
	<div class="leftnumbers col-5">
		<? if($number > 1): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><<</a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$back?>" class="pagebutton"><</a>
		<? elseif($number == 1): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><<</a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=1" class="pagebutton"><</a>
		<? endif; ?>
	</div>

	<div class="middlenumbers col-2">
		<? if($totalpages < 6): ?>
			<? for($p = 0; $p < $totalpages; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number < 4): ?>
			<? for($p = 0; $p < $totalpages && $p < 5; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number > $lastmarker): ?>
			<? for($p = $lastmarker - 2; $p < $totalpages; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? elseif($number > 3): ?>
			<? for($p = $left; $p < $right; $p++): ?>
				<? 
				$page = $p+1;

				if($number == $page){
					$style = 'selected_page';
				}else{
					$style = '';
				} ?>
				<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$page?>" class="pagebutton" id="<?=$style?>">
					<?=$page?>
				</a>
			<? endfor; ?>
		<? endif; ?>
	</div>

	<div class="rightnumbers col-5">
		<? if($number < $totalpages): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$next?>" class="pagebutton">></a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">>></a>
		<? elseif($number == $totalpages): ?>
			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">></a>

			<a href="thread.php?id=<?=$_GET['id']?>&amp;page=<?=$totalpages?>" class="pagebutton">>></a>
		<? endif; ?>
	</div>
</div>

<!-- End of Page Numbering -->
</div>
</div>