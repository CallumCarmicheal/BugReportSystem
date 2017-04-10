<?php

$_AUTH_PAGE = "Login";

$formUsername    = "";

// Check if the post contains: email
if (Input::contains('username', 'p')) {
	$value = Input::escape(Input::get('username', 'p'));
	$formUsername = ' value="'. $value. '" ';
}

// Escape our html for the error response
if (!empty($error))
	$error = Input::escape($error); ?>

<?php require (LAYOUTS. "auth/auth.start.php"); ?>
	
	<section class="container" id="formSection">
		
		<h3>Administration Login</h3>
		<br>
		
		<form action="<?=url('/Authentication/Login')?>" method="post">
			<fieldset>
				<div class="col-md-3"> <label for="usernameField">Username</label> </div>
				<div class="col-md-9">
					<input id="usernameField" name="username" type="text" placeholder="Admin ;)" required
						<?=$formUsername?>>
				</div>
				<br>
				
				<div class="col-md-3"> <label for="passwordField">Password</label> </div>
				<div class="col-md-9">
					<input id="passwordField" name="password" type="password" required>
				</div>
				<br>
				
				<?php /* Check if recaptcha is enabled if it is show the recaptcha form! */
				if (RECAPTCHA_ENABLED): ?>
					<div class="col-md-3"></div>
					<div class="col-md-9">
						<?= Lib\GoogleRecaptcha::Create() ?>
					</div>
					<div class="col-md-12">&nbsp;</div>
				<?php endif; ?>
				
				<div class="col-md-12">
					<input class="button-primary" style="width: 100%" type="submit" value="Login">
				</div>
			</fieldset>
		</form>
		
		<?php if (!empty($error)): ?>
			<pre><code>An error occurred: <?=$error?></code></pre>
		<?php endif; ?>
	</section>


<?php require (LAYOUTS. "auth/auth.end.php"); ?>