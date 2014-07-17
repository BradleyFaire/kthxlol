<div class="container">

	<? if($_SESSION['user_logged_in']||$_SESSION['admin_logged_in']): ?>
		<a class="button" href="create_thread.php">Create New Thread</a>
	<? endif; ?>
	
	<table>

		<tr>
			<th width="32"></th>
			<th width="436">Forum</th>
			<th width="32"></th>
			<th width="200">Date Posted</th>
			<th width="180">Created By</th>
			<th width="80">Posts</th>
		</tr>

		<? foreach($threads->items as $thread): ?>
		<?php $user = new Users($thread['user_id']); ?>
		<tr>
			<td><img class="avatar" src="<?=$user->image?>"></td>
			<td><a class="threadlink" href="thread.php?id=<?=$thread['id']?>"><?=$thread['name']?></a></td>
			<td>
				<? if($thread['user_id'] == $_SESSION['user_id']): ?>
					<a class="threadlink" href="create_thread.php?id=<?=$thread['id']?>">Edit</a>
				<? endif; ?>
			</td>
			<td><?=$thread['date_posted']?></td>
			<td><a class="threadlink" href="user_profile.php?id=<?=$thread['user_id']?>"><?=$user->username?></a></td>
			<td>x</td>
		</tr>
		<? endforeach; ?>

	</table>

</div>