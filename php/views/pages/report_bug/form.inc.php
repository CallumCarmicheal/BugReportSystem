<?php if (!empty($BUG_REPORT_STATE)
	      && $BUG_REPORT_STATE == "Success"): ?>
	
	<h3>Submitted</h3>
	<p>Thank you for your bug report!</p>
	
	<a href="<?=url('/Bugs')?>">View all verified reports.</a>
	
	<!-- Scroll to result -->
	<script>$(function() {
		smoothScrollInto('report-bug');
	});</script>
	
<?php else: ?>
	
	<h3>Report bug</h3>
	
	<?php if (!empty($formReport_Error)): ?>
		<pre><code>An error occurred: <?=$formReport_Error?></code></pre>
	<?php endif; ?>
	
	<form action="<?=url('/Home')?>" method="post">
		<fieldset>
			<div class="col-md-3"> <label for="emailField">Email (r.)</label> </div>
			<div class="col-md-9">
				<input id="emailField" name="email" type="email" placeholder="someone@example.com" required <?=$formEmail?>>
			</div>
			<br>
			
			<div class="col-md-3"> <label for="locationType">Bug Type (r.)</label> </div>
			<div class="col-md-9">
				<select id="locationType" name="select" required>
					<option value="1" <?=$formSelect_1?>>Menu</option>
					<option value="2" <?=$formSelect_2?>>Gameplay</option>
					<option value="3" <?=$formSelect_3?>>Other</option>
				</select>
			</div>
			<br>
			
			<div class="col-md-3"> <label for="briefField">Brief description (r.)</label> </div>
			<div class="col-md-9">
				<input id="briefField" name="brief" type="text" placeholder="A small description of the bug" maxlength="120" required <?=$formBrief?>>
			</div>
			<br>
			
			<div class="col-md-3"> <label for="reproduceBug">How to reproduce the bug (r.)</label> </div>
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
			
			<div class="col-md-12">
				<p>Please do not fill in any personal information, this information will be displayed in public domain once verified
					(Brief, Reproduce, Additional Information).
					
					Your email address is only visible to staff,
					if any further information is required you will be
					contacted via email by a staff member.</p>
			</div>
		</fieldset>
	</form>
	
	<a href="<?=url('/Bugs')?>">View all verified reports.</a>

<?php endif; ?>