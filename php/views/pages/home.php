<?php $_PAGE = ['Title' => "Bug Report - WhiteCircle"]; ?>

<?php require (LAYOUTS. "general.start.php"); ?>
	
	<header class="header" id="home" style="box-shadow: 0 0 30px 44px #f4f5f6;">
		<section class="container">
			<img src="<?=url('/assets/img/logo.png')?>">
			
			<h1 class="title">White Circle</h1>
			<p class="description">The Incredible <span style="text-shadow: 0 0 3px #62959F;">Addictive</span> Game</p>
			
			<a class="button" href="#report-bug" title="Report Bug">Report Bug</a>
			<a class="button" href="<?=url('/Bugs')?>" title="Verified Bugs">View Reports</a>
		</section>
	</header>

	<section class="container" id="report-bug">
		<br><br>
		
		<?php /* Include: The bug report form */ ?>
		<?php require(PAGES. "report_bug/form.inc.php") ?>
	</section>

<?php require (LAYOUTS. "general.end.php"); ?>