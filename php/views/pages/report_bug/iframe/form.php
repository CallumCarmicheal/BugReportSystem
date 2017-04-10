<html>
<head>
	<title>Bug Report</title>
	
	<meta charset="utf-8">
	<meta name="viewport"       content="width=device-width, initial-scale=1">
	<meta name="author"         content="">
	<meta name="description"    content="">
	<link rel="icon"            href="https://milligram.github.io/images/icon.png">
	
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">
	<link rel="stylesheet" href="https://milligram.github.io/styles/main.css">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.3.0/milligram.css">
	
	<link rel="stylesheet" type="text/css" href="https://whitecircle.maxlouiscreative.com/wp-content/uploads/2017/04/bootstrap.modal_.css">
</head>

<body>

<main class="wrapper">
	<section class="container" id="formSection">
		<?php if (!empty($error)): ?>
			<pre><code>An error occurred: <?=$error?></code></pre>
		<?php endif; ?>
		
		<form action="<?=url('/IFrame/Report')?>" method="post">
			<fieldset>
				<div class="col-md-3"> <label for="emailField">Email</label> </div>
				<div class="col-md-9">
					<input id="emailField" name="email" type="email" placeholder="someone@example.com" required <?=$formEmail?>>
				</div>
				<br>
				
				<div class="col-md-3"> <label for="locationType">Bug Type (Required)</label> </div>
				<div class="col-md-9">
					<select id="locationType" name="select" required>
						<option value="1" <?=$formSelect_1?>>Menu</option>
						<option value="2" <?=$formSelect_2?>>Gameplay</option>
						<option value="3" <?=$formSelect_3?>>Other</option>
					</select>
				</div>
				<br>
				
				<div class="col-md-3"> <label for="briefField">Brief description</label> </div>
				<div class="col-md-9">
					<input id="briefField" name="brief" type="text" placeholder="A small description of the bug" maxlength="120" required <?=$formBrief?>>
				</div>
				<br>
				
				<div class="col-md-3"> <label for="reproduceBug">How to reproduce the bug (required)</label> </div>
				<div class="col-md-9">
						<textarea id="reproduceBug" name="reproduce" maxlength="3000" required
						          style="resize: vertical;"><?=$formReproduce?></textarea>
				</div>
				<br>
				
				<div class="col-md-3"> <label for="additionalInformation">Additional Information</label> </div>
				<div class="col-md-9">
						<textarea id="additionalInformation" name="information" maxlength="3000"
						          style="resize: vertical;"><?=$formInformation?></textarea>
				</div>
				
				
				<?php /* Check if recaptcha is enabled if it is show the recaptcha form! */
				    if (RECAPTCHA_ENABLED): ?>
					    <div class="col-md-3"></div>
						<div class="col-md-9">
							<?= Lib\GoogleRecaptcha::Create() ?>
						</div>
					    <div class="col-md-12">&nbsp;</div>
				<?php endif; ?>
				
				<div class="col-md-12">
					<input class="button-primary" style="width: 100%" type="submit" value="Report">
				</div>
			</fieldset>
		</form>
	</section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type='text/javascript' src='https://whitecircle.maxlouiscreative.com/wp-content/uploads/2017/04/bootstrap.min_.js'></script>
</body>
</html>