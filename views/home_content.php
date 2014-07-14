<?php 

	$home = new Model(tb_pages);

	if($_GET['id']){
		$home->load($_GET['id']);
	}else{
		$home->load(1);
	}

?>

<div class="container">

	<?= $home->content ?>

 </div>