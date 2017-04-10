<?php $_PAGE = ['Title' => "Latest Reports - Admin - WhiteCircle"]; ?>

<?php require (LAYOUTS. "general.start.php"); ?>

	<?php require (PAGES. "bugs/modal.php") ?>

	<section class="container" id="latest-reports">
		<h3><?=$_BUG_LIST['Title']?></h3>
		
		<?php require (PAGES. "bugs/list.php") ?>
	</section>

<?php require (LAYOUTS. "general.end.php"); ?>
