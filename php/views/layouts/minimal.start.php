<html>
<head>
	<?php /* Page Title */ ?>
	<?php if (!empty($_PAGE) && !empty($_PAGE['Title'])): ?>
		<title><?=$_PAGE['Title']?></title>
	<?php else: ?>
		<title>White Circle!</title>
	<?php endif; ?>
	
	<?php /* Load the meta tags */
	include(VIEWS . "layouts/sections/meta.php") ?>
	
	<?php /* Check if $_PAGE has ['Description'] */ ?>
	<?php if (!empty($_PAGE) && !empty($_PAGE['Description'])): ?>
		<meta name="description" content="<?=$_PAGE['Description']?>">
	<?php endif; ?>
	
	<?php /* Load the styles */
	include(VIEWS . "layouts/sections/styles.php") ?></head>
<body>
<?php include (VIEWS. "layouts/sections/top-scripts.php"); ?>

<main class="wrapper">
	<!-- Page Content -->
