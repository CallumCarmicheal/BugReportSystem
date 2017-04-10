<div id="MODAL_REPORT_VIEW" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div id="MODAL_REPORT_VIEW_INFORMATION" report_id="-1" style="display:none"></div>
			<div class="modal-header">
				<h4 class="modal-title" id="MODAL_REPORT_VIEW_Title" style="display: inline-flex">Modal Header</h4>
			</div>
			<div class="modal-body" id="MODAL_REPORT_VIEW_Body">
				<div class="row">
					<div class="col-md-3">ID</div>
					<div class="col-md-9 value-id"></div>
				</div> <hr class="reset-margin">
				
				<div class="row">
					<div class="col-md-3">Fixed</div>
					<div class="col-md-9 value-fixed"></div>
				</div> <hr class="reset-margin">
				
				<?php if(Authentication::isLoggedIn()): ?>
					<!-- IF [ADMIN] -->
					<div class="row section-email">
						<div class="col-md-3 word-break">Visible</div>
						<div class="col-md-9 word-break value-visible"></div>
					</div> <hr class="reset-margin">
					
					<div class="row section-email">
						<div class="col-md-3 word-break">Reported by</div>
						<div class="col-md-9 word-break value-email"></div>
					</div> <hr class="reset-margin">
				<?php endif; ?>
				
				<div class="row">
					<div class="col-md-3">Bug Type</div>
					<div class="col-md-9 value-bugtype"></div>
				</div> <hr class="reset-margin">
				
				
				<div class="row">
					<div class="col-md-3 word-break">How to reproduce</div>
					<div class="col-md-9 word-break value-reproduce"></div>
				</div> <hr class="reset-margin">
				
				<!-- IF NOT NULL [RESULT.ADDITIONAL_INFORMATION] -->
				<div class="row section-info">
					<div class="col-md-3 word-break">Additional Information</div>
					<div class="col-md-9 word-break value-info"></div>
				</div>
			</div>
			<div class="modal-footer">
				<?php if (Authentication::isLoggedIn()): ?>
					<!-- Edit Button -->    <input class="button button-clear"    id="MODAL_REPORT_VIEW_delete" type="submit" value="Delete">
					<!-- Delete Button -->  <button class="button button-outline" id="MODAL_REPORT_VIEW_edit"                       >Edit</button>
				<?php endif; ?>
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>

<?php if (Authentication::isLoggedIn()): ?>
	<div id="MODAL_EDIT_REPORT" class="modal fade" role="dialog">
		<div class="modal-dialog">
			<!-- Modal content-->
			<div class="modal-content">
				
				<div class="modal-header">
					<h4 class="modal-title" id="MODAL_EDIT_REPORT_Title"></h4>
				</div>
				
				<div class="modal-body" id="MODAL_EDIT_REPORT_Body">
					<div class="row">
						<div class="col-md-3"> <label for="MODAL_EDIT_REPORT_Email">Email</label> </div>
						<div class="col-md-9">
							<input id="MODAL_EDIT_REPORT_Email" name="email" type="email" placeholder="someone@example.com" required value="">
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3"> <label for="MODAL_EDIT_REPORT_Type">Bug Type</label> </div>
						<div class="col-md-9">
							<select id="MODAL_EDIT_REPORT_Type" name="select" required>
								<option value="1">Menu</option>
								<option value="2">Gameplay</option>
								<option value="3">Other</option>
							</select>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3"> <label for="MODAL_EDIT_REPORT_Brief">Brief description</label> </div>
						<div class="col-md-9">
							<input id="MODAL_EDIT_REPORT_Brief" name="brief" type="text" placeholder="A small description of the bug"
							       maxlength="120" required value="">
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3"> <label for="MODAL_EDIT_REPORT_Reproduce">How to reproduce the bug</label> </div>
						<div class="col-md-9">
							<textarea id="MODAL_EDIT_REPORT_Reproduce" name="reproduce" maxlength="3000" required
					                  style="resize: vertical;"></textarea>
						</div>
					</div> <hr class="reset-margin">
					
					<div class="row">
						<div class="col-md-3"> <label for="MODAL_EDIT_REPORT_Information">Additional Information</label> </div>
						<div class="col-md-9">
							<textarea id="MODAL_EDIT_REPORT_Information" name="information" maxlength="3000"
							          style="resize: vertical;"></textarea>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input class="button button-clear" data-dismiss="modal" type="submit" value="Cancel">
					<button type="button" class="btn btn-default">Save</button>
				</div>
			</div>
		</div>
	</div>
<?php endif; ?>
