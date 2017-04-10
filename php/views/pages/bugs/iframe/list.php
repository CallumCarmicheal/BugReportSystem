<?php
use CommonMVC\Framework\Eloquent\DatabaseCollection;
use CommonMVC\Framework\Eloquent\DatabaseItem;

if (empty($_BUG_LIST)) goto BLOG_LIST_EOF;
/** @var $_BUG_LIST DatabaseItem[]|DatabaseCollection|mBugReport */

$_PAGE = ['Title' => "Bug Report - WhiteCircle"];
?>

<?php require (LAYOUTS. "minimal.start.php"); ?>

	<?php require (PAGES. "bugs/modal.php"); ?>
	
	<section class="container" id="bugsSection">
		<div class="row">
			<div class="col-md-4 col-sm-4 col-xs-12"><a class="button full-width" href="#bugList_Menu"     >Menu</a></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><a class="button full-width" href="#bugList_Gameplay" >Gameplay</a></div>
			<div class="col-md-4 col-sm-4 col-xs-12"><a class="button full-width" href="#bugList_Other"    >Other</a></div>
		</div> <hr>
		
		<div id="bugList">
			<?php if($_BUG_LIST['Menu']->containsItems()) { ?>
				<br><br> <b id="bugList_Menu">Menu</b>
				<!-- Section -->
				<div id="bugList_Menu_Section">
					<!-- Bugs: -->
					<?=BugReporter::GenerateHTML($_BUG_LIST['Menu']->get())?>
				</div>
				<!-- !Section -->
			<?php } ?>
			
			<?php if($_BUG_LIST['Gameplay']->containsItems()) { ?>
				<br><br> <b id="bugList_Gameplay">Gameplay</b>
				<!-- Section -->
				<div id="bugList_Gameplay_Section">
					<!-- Bugs: -->
					<?=BugReporter::GenerateHTML($_BUG_LIST['Gameplay']->get())?>
				</div>
				<!-- !Section -->
			<?php } ?>
			
			<?php if($_BUG_LIST['Other']->containsItems()) { ?>
				<br><br> <b id="bugList_Other">Other</b>
				<!-- Section -->
				<div id="bugList_Other_Section">
					<!-- Bugs: -->
					<?=BugReporter::GenerateHTML($_BUG_LIST['Other']->get())?>
				</div>
			<!-- !Section -->
			<?php } ?>
		</div>
	
	</section>
<?php require (LAYOUTS. "minimal.end.php"); ?>

<?php BLOG_LIST_EOF: ?>
