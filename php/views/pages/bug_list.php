<?php $_PAGE = ['Title' => "Bug Lists - WhiteCircle"]; ?>

<?php require (LAYOUTS. "general.start.php"); ?>

	<?php require (PAGES. "bugs/modal.php") ?>
	
	<section class="container" id="bugs">
		<a class="button full-width" style="margin-bottom: 50px;" href="<?=url('/')?>">Report a bug</a>
		
		<h3>Active Bugs</h3>
		
		<?php require (PAGES. "bugs/list.php") ?>
		
	</section>

<?php require (LAYOUTS. "general.end.php"); ?>