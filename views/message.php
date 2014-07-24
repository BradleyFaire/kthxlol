<?php 
	if($_GET['id'] == 1){
		$message = "<p>Email successfully sent. Please check your email.</p>
	<p>The email may take a few minutes to arrive in your inbox.</p>";
	}elseif($_GET['id'] == 2){
		$message = "<p>Email failed to send.</p>";
	}elseif($_GET['id'] == 3){
		$message = "<p>You have cancelled this registration.</p>";
	}elseif($_GET['id'] == 4){
		$message = "<p>You have successfully changed your password.</p>";
	}
?>

<div class="container">
	<?=$message?>
</div>