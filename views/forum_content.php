<div class="container">
	
		<table>

			<tr>
				<th width="32"></th>
				<th width="468">Forum</th>
				<th width="200">Date Posted</th>
				<th width="180">Created By</th>
				<th width="80">Posts</th>
			</tr>

			<? foreach($threads->items as $thread): ?>
			<?php 
				$user = new Users($thread['user_id']); 
				$
			?>
			<tr>
				<td><img style="width: 64px;" src="<?=$user->image?>"></td>
				<td><?=$thread['name']?></td>
				<td><?=$thread['date_posted']?></td>
				<td><?=$user->username?> </td>
				<td>x</td>
			</tr>
			<? endforeach; ?>

		</table>

	</div>