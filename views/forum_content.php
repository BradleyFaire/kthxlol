<div class="container">

	<? if($_SESSION['user_logged_in']||$_SESSION['admin_logged_in']): ?>
		<a class="button" href="create_thread.php">Create New Thread</a>
	<? endif; ?>

	<? $values = array(
		'recent_activity' => 'Recent Activity',
		'first_created'   => 'First Created',
		'recent_thread'   => 'Recent Thread'
		);
	?>
	<?=Form::open('', 'get', 'id="orderform"')?>
	<?=Form::label('order', 'Order by:', 'class="order2"')?>
	<?=Form::select('order', $values, ($_GET['order'] ? $_GET['order'] : ''), 'class="order"')?>
	<?=Form::close()?>
	<div class="boxy">
		<table>

			<tr>
				<th width="32"></th>
				<th width="506">Forum</th>
				<th width="32"></th>
				<th width="180">Date Posted</th>
				<th width="180">Created By</th>
				<th width="80">Replies</th>
			</tr>

			<? foreach($threads->items as $thread): ?>
			<?php $user = new Users($thread['user_id']); ?>
			<tr>
				<td class="left_td"><img class="avatar" src="<?=$user->image?>"></td>
				<td><a class="threadlink" href="thread.php?id=<?=$thread['id']?>"><?=$thread['name']?></a></td>
				<td>
					<? if($thread['user_id'] == $_SESSION['user_id']): ?>
						<a class="threadlink" href="create_thread.php?id=<?=$thread['id']?>">Edit</a>
					<? endif; ?>
				</td>
				<td><?= date('D, j M, Y', strtotime($thread['date_posted']))?></td>
				<td><a class="threadlink" href="user_profile.php?id=<?=$thread['user_id']?>"><?=$user->username?></a></td>
				<?php $stuff = new Comments($thread['id']); ?>
				<td class="right_td"><?=$stuff->count_items();?></td>
			</tr>
			<? endforeach; ?>

		</table>
	</div>
</div>