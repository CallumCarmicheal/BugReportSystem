<html>
<head>
	<title>Authentication - White Circle</title>
	
	<?php /* Load the meta tags */
	include(VIEWS . "layouts/sections/meta.php") ?>
	
	<?php /* Check if $_PAGE has ['Description'] */ ?>
	<?php if (!empty($_PAGE) && !empty($_PAGE['Description'])): ?>
		<meta name="description" content="<?=$_PAGE['Description']?>">
	<?php endif; ?>
	
	<?php /* Load the styles */
	include(VIEWS . "layouts/sections/styles.php") ?>
</head>

<body>

<main class="wrapper">
	<nav class="navigation">
		<section class="container">
			<a class="navigation-title float-left" href="<?= url ('/') ?>">
				<h1 class="title">White Circle</h1>
			</a>
			
			<ul class="navigation-list float-right">
				<?php if (isset($_AUTH_PAGE) && $_AUTH_PAGE == "Login"): ?>
					<li class="navigation-item">
						<a class="navigation-link" href="<?= url('/Authentication/Register') ?>">Register</a>
					</li>
				<?php else: ?>
					<li class="navigation-item">
						<a class="navigation-link" href="<?= url('/Authentication/Login')    ?>">Login</a>
					</li>
				<?php endif; ?>
			</ul>
		</section>
	</nav>
	
	<br>
	<br>
	
	<!-- Page Content -->