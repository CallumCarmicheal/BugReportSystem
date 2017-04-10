<?php
use CommonMVC\Framework\Eloquent\DatabaseCollection;
use CommonMVC\Framework\Eloquent\DatabaseItem;

if (empty($_BUG_LIST)) goto BLOG_LIST_EOF;
/** @var $_BUG_LIST DatabaseItem[]|DatabaseCollection|mBugReport */
?>

<div class="row">
	<div class="col-md-4"><a class="button full-width" href="#bugList_Menu"     >Menu</a></div>
	<div class="col-md-4"><a class="button full-width" href="#bugList_Gameplay" >Gameplay</a></div>
	<div class="col-md-4"><a class="button full-width" href="#bugList_Other"    >Other</a></div>
</div> <hr>

<br><br> <b id="bugList_Menu">Menu</b>
<!-- Section-->
<?php if($_BUG_LIST['Menu']->containsItems()) { ?>
	<!-- Bugs: -->
	<?=BugReporter::GenerateHTML($_BUG_LIST['Menu']->get())?>
<?php } else { ?>
	<div>No bugs</div>
<?php } ?>
<!-- !Section -->

<br><br> <b id="bugList_Gameplay">Gameplay</b>
<!-- Section-->
<?php if($_BUG_LIST['Gameplay']->containsItems()) { ?>
	<!-- Bugs: -->
	<?=BugReporter::GenerateHTML($_BUG_LIST['Gameplay']->get())?>
<?php } else { ?>
	<div>No bugs</div>
<?php } ?>
<!-- !Section -->


<br><br> <b id="bugList_Other">Other</b>
<!-- Section-->
<?php if($_BUG_LIST['Other']->containsItems()) { ?>
	<!-- Bugs: -->
	<?=BugReporter::GenerateHTML($_BUG_LIST['Other']->get())?>
<?php } else { ?>
	<div>No bugs</div>
<?php } ?>
<!-- !Section -->

<?php BLOG_LIST_EOF: ?>