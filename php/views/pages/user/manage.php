<?php $_PAGE = ['Title' => "Manage Account - WhiteCircle"]; ?>

<?php require (LAYOUTS. "general.start.php"); ?>

	<section class="container" id="account">
		
		<h3>Manage Account</h3>
		<br>
		
		<form action="<?=url('/User/Manage')?>" method="post">
			<fieldset>
				<div class="col-md-3"> <label for="currentPasswordField">Current Password</label> </div>
				<div class="col-md-9">
					<input id="currentPasswordField" name="password_C" type="password" required>
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
					<input class="button-primary" style="width: 100%" type="submit" value="Change Password">
				</div>
			</fieldset>
		</form>
		
		<?php if (!empty($error)): ?>
			<pre><code>An error occurred: <?=$error?></code></pre>
		<?php endif; ?>
		
	</section>

<?php require (LAYOUTS. "general.end.php"); ?>
