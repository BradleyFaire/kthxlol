<div class="container">
	<div class="whole_post">
		<h4><?=$user->username?></h4>
		<div class="post_box">
			<div class="col-2 user_anchor">
				<? if($user->admin == 1): ?>
					<p class="small_text">Admin</p>
				<? else: ?>
					<p class="small_text">Member</p>
				<? endif; ?>
				<img class="big_avatar" src="<?=$user->image?>" alt="Avatar Image">
				<p class="small_text"><?=$user->location?></p>
			</div>
			<div class="col-10 post_anchor">
				<div class="post_date">
					<div class="inline_box">
						<p class="small_text" style="margin: 0;">Date joined:</p>
						<p class="small_text"><?=$user->date_joined?></p>
					</div>
					<? if($user->hide_email == 0): ?>
						<div class="inline_box push">
							<p class="small_text" style="margin: 0;">Email:</p>
							<p class="small_text"><?=$user->email?></p>
						</div>
					<? endif; ?>
				</div>
				<div class="post_content">
					<p class="small_text" style="margin: 0;">Description:</p>
					<div class="small_text">
						<?=$user->description?>
					</div>
				</div>
				<div class="signature">
					<p class="small_text" style="margin: 0;">Signature:</p>
					<p class="small_text"><?=$user->signature?></p>
				</div>
			</div>
		</div>
	</div>
</div>