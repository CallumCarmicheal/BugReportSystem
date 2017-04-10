<?php $_PAGE = ['Title' => "Latest Reports - Admin - WhiteCircle"]; ?>

<?php require (LAYOUTS. "general.start.php"); ?>

	<?php require (PAGES. "bugs/modal.php") ?>

	<div id="MODAL_QUERY" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title">Query Reports</h4>
				</div>
				
				<div class="modal-body" id="MODAL_QUERY_Body">
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Email">Email</label> </div>
						<div class="col-md-9 col-sm-8">
							<input id="MODAL_QUERY_Email" name="email" type="email" placeholder="someone@example.com" required value="">
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Type">Bug Type</label> </div>
						<div class="col-md-9 col-sm-8">
							<select id="MODAL_QUERY_Type" name="select" required>
								<option value="1" selected="selected">Any</option>
								<option value="2">Menu</option>
								<option value="3">Gameplay</option>
								<option value="4">Other</option>
							</select>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Brief">Brief description</label> </div>
						<div class="col-md-9 col-sm-8">
							<input id="MODAL_QUERY_Brief" name="brief" type="text" placeholder="A small description of the bug"
							       maxlength="120" required value="">
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Reproduce">How to reproduce the bug</label> </div>
						<div class="col-md-9 col-sm-8">
								<textarea id="MODAL_QUERY_Reproduce" name="reproduce" maxlength="3000" required
								          style="resize: vertical;"></textarea>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Information">Additional Information</label> </div>
						<div class="col-md-9 col-sm-8">
								<textarea id="MODAL_QUERY_Information" name="information" maxlength="3000"
								          style="resize: vertical;"></textarea>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Visible">Visible</label> </div>
						<div class="col-md-9 col-sm-8">
							<select id="MODAL_QUERY_Visible" name="select" required>
								<option value="1" selected="selected">Any</option>
								<option value="2">Visible</option>
								<option value="3">Hidden</option>
							</select>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3 col-sm-4"> <label for="MODAL_QUERY_Fixed">Fixed</label> </div>
						<div class="col-md-9 col-sm-8">
							<select id="MODAL_QUERY_Fixed" name="select" required>
								<option value="1" selected="selected">Any</option>
								<option value="2">Fixed</option>
								<option value="3">Not Fixed</option>
							</select>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<input class="button button-clear" data-dismiss="modal" type="submit" value="Cancel">
					<button type="button" id="MODAL_QUERY_Start" class="btn btn-default">Query</button>
				</div>
			</div>
		</div>
	</div>
	
	<section class="container" id="latest-reports">
		<h3>All bug reports</h3>
		
		<div class="row">
			<div class="col-md-12 col-sm-12 col-xs-12">
				<button class="button full-width"
				        data-toggle="modal"
				        data-target="#MODAL_QUERY">Query</button>
			</div>
		</div>
		
		<?php require (PAGES. "bugs/list.php") ?>
	</section>

<?php require (LAYOUTS. "general.end.php"); ?>
