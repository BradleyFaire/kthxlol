<?php

	$pages = new Pages();

?>

<nav>
	<div class="">
		<ul class="leftnav">

			<? foreach($pages->items as $page): ?>
				<? if($_SESSION['admin_logged_in']): ?>
					<li><a class="navbutton" href="add_page.php?id=<?=$page['id']?>"><?=$page['name']?></a></li>
				<? else: ?>
					<li><a class="navbutton" href="index.php?id=<?=$page['id']?>"><?=$page['name']?></a></li>
				<? endif; ?>
			<? endforeach; ?>

			<? if($_SESSION['admin_logged_in']): ?>
				<li><a class="navbutton" href="add_page.php">Add Page</a></li>
			<? endif; ?>

			<li><a class="navbutton" href="forum.php">Forum</a></li>

			<li>
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" class="donate">
					<input type="hidden" name="cmd" value="_s-xclick">
					<input type="hidden" name="hosted_button_id" value="FDREAUXZ574QJ">
					<input class="navbutton donate" type="submit" name="submit" value="Donate here">
					<!-- <img alt="" border="0" src="https://www.paypalobjects.com/en_GB/i/scr/pixel.gif" width="1" height="1"> -->
				</form>
			</li>
		</ul>

		<ul class="loginnav">

			<? if($_SESSION['user_logged_in']||$_SESSION['admin_logged_in']): ?>
				<li><a class="navbutton" href="logout.php">Logout</a></li>
			<? else: ?>
				<li><a class="navbutton" href="login.php">Login</a></li>
				<li><a class="navbutton" href="register.php">Register</a></li>
			<? endif; ?>

		</ul>
	</div>
</nav>