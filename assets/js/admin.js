/**
 * Created by CallumCarmicheal on 09/04/2017.
 */

$(function() {
	// Go-To buttons
	$('#_ADMIN_STATS_FIXED')      .on('click', function() { Web.Redirect("/Administration/Reports/Fixed");           });
	
	$('#_ADMIN_STATS_VISIBLE')    .on('click', function() { Web.Redirect("/Administration/Reports/Visible");         });
	
	$('#_ADMIN_STATS_TOTAL')      .on('click', function() { Web.Redirect("/Administration/Reports/All");             });
	
	$('#_ADMIN_STATS_UNCONFIRMED').on('click', function() { Web.Redirect("/Administration/Reports/Unconfirmed");     });
	
	
	bugReport.Modals.Edit.Modal         = $('#MODAL_EDIT_REPORT');
	bugReport.Modals.Edit.Title         = $('#MODAL_EDIT_REPORT_Title');
	bugReport.Modals.Edit.Email         = $('#MODAL_EDIT_REPORT_Email');
	bugReport.Modals.Edit.Type          = $('#MODAL_EDIT_REPORT_Type');
	bugReport.Modals.Edit.Description   = $('#MODAL_EDIT_REPORT_Brief');
	bugReport.Modals.Edit.Reproduce     = $('#MODAL_EDIT_REPORT_Reproduce');
	bugReport.Modals.Edit.Information   = $('#MODAL_EDIT_REPORT_Information');
	bugReport.Modals.Edit.Visible       = $('#MODAL_EDIT_REPORT_Visible');
	bugReport.Modals.Edit.Fixed         = $('#MODAL_EDIT_REPORT_Fixed');
	bugReport.Modals.Edit.Save          = $('#MODAL_EDIT_REPORT_SAVE');
	
	var current_id      = -1;
	var current_report  = bugReport.JsonModal;
	
	// Admin buttons
	bugReport.Modals.View.Edit.on('click', function() {
		// Get the id from info
		var report_id   = bugReport.Modals.View.Information.attr('report_id');
			current_id      = -1;
		
		// Get the bug report information
		bugReport.GetReport(report_id, function(data) {
			// Check for any errors
			var $this  = $(this);
			var vModal = bugReport.Modals.Edit;
			var report = bugReport.JsonModal;
				report = data;
			
			// Set the current report
			current_report = report;
			
			// Hide the information modal
			bugReport.Modals.View.Modal.modal('hide');
			
			// Check if there was a error
			if (report.error) {
				Web.Prompt(
					"An error occurred",
					"Failed to retrieve report information: " + report.message
				); return;
			}
			
			// Report is valid so set the data
			current_id = report.id;
			
			vModal.Title.html("ID: " + report.id + ", " + report.brief);
			
			vModal.Email.val(report.email);
			vModal.Type.val(report.bug_type);
			
			vModal.Description.val(report.brief);
			vModal.Reproduce.val(report.reproduce);
			vModal.Information.val(report.information);
			
			vModal.Visible.prop('checked', report.visible);
			vModal.Fixed.prop('checked', report.fixed);
			
			// Show the modal
			vModal.Modal.modal('show');
		});
	});
	
	bugReport.Modals.View.Delete.on('click',
	function() {
		// Check if the user is sure that he wants to delete the
		// selected report
		bugReport.GetReport(
			bugReport.Modals.View.Information.attr('report_id'),
			function (data) {
				// Allow for property hinting
				var report = bugReport.JsonModal;
					report = data;
				
				// Check if there was a error
				if (report.error) {
					Web.Prompt(
						"An error occurred",
						"Failed to retrieve report information: " + report.message
					); return;
				}
				
				// Hide the edit modal
				bugReport.Modals.View.Modal.modal('hide');
				
				Web.Confirm(
					'Are you sure you want to delete?',
					'ID: ' + data.id + ", Brief: " + data.brief,
				function (del) {
					if (!del) {
						console.log("Delete Cancelled");
						return;
					}
						
					bugReport.DeleteReport(data.id,
					function(response) {
						if (response.error == true) {
							Web.Prompt(
								"Failed to delete report",
								"The report deletion failed, server returned: " +
								response.message + ". <br><br>" +
								"Press okay to refresh the page!",
							function () {
								// There was no form data so this will allow
								// us to use this function without reposting
								// form data.
								window.location.reload(true);
							}); return;
						}
						
						Web.Prompt(
							"Successfully deleted report!",
							response.message + "<br><br>Press okay to refresh the page!",
						function () {
							// There was no form data so this will allow
							// us to use this function without reposting
							// form data.
							window.location.reload(true);
						});
					});
				});
			}
		);
	});
	
	function validateData(value, name) {
		if (isNullOrWhitespaced(value)) {
			// Hide the modal
			bugReport.Modals.Edit.Modal.modal('hide');
			
			// Display the error
			Web.Prompt(
				'Invalid input',
				'Please enter in a value for ' + name + ", this is a required field.",
			function() {
				// Show the modal
				bugReport.Modals.Edit.Modal.modal('show');
			});
			
			return true;
		} return false;
	}
	
	// On save (Edit)
	bugReport.Modals.Edit.Save.on('click', function() {
		var url     = Web.Url('/API/Report/Update');
		var report  = {
			id:             -1,
			email:          "",
			type:           0,
			brief:          "",
			reproduce:      "",
			information:    "",
			visible:        false,
			fixed:          false,
			
			is_valid:       "TRUE"
		};
		
		var vModal          = bugReport.Modals.Edit;
		report.id           = current_report.id;
		report.email        = vModal.Email.val();
		report.type         = vModal.Type.val();
		report.brief        = vModal.Description.val();
		report.reproduce    = vModal.Reproduce.val();
		report.information  = vModal.Information.val();
		report.visible      = vModal.Visible.is(':checked') ? "T" : "F";
		report.fixed        = vModal.Fixed.is(':checked')   ? "T" : "F";
		
		// Confirm required fields are entered
		if (validateData(report.email,      "Email"))                   return;
		if (validateData(report.brief,      "Brief description"))       return;
		if (validateData(report.reproduce,  "Reproduce instructions"))  return;
		if (!validateEmail(report.email)) {
			// Hide the modal
			bugReport.Modals.Edit.Modal.modal('hide');
			
			// Display the error
			Web.Prompt(
				'Invalid input',
				'Please enter in a valid email address',
				function() {
					// Show the modal
					bugReport.Modals.Edit.Modal.modal('show');
				});
			return;
		}
		
		
		$.ajax({
			type:       "POST",
			url:        url,
			data:       report,
			success:    function(response) {
				vModal.Modal.modal('hide');
				
				if (response.error) {
					Web.Prompt(
						"An error occurred",
						"Failed to delete report: " + response.message,
					function() {
						if (!response.dont_refresh) {
							// There was no form data so this will allow
							// us to use this function without reposting
							// form data.
							window.location.reload(true);
						} else {
							vModal.Modal.modal('show');
						}
					}); return;
				}
				
				Web.Prompt(
					"Deleted report!",
					response.message + "<br><br>Press okay to refresh the page!",
					function() {
						// There was no form data so this will allow
						// us to use this function without reposting
						// form data.
						window.location.reload(true);
					}
				);
			},
			dataType:   "json"
		});
		
	});
	
	// Delete report
	bugReport.DeleteReport = function(id, callback) {
		var url = Web.Url("/API/Report/Delete");
		
		$.ajax({
			type:       "POST",
			url:        url,
			data:       { id: id, confirm: 1 },
			success:    callback,
			dataType:   "json"
		});
	};
	
	// Check if query modal exists
	if ($('#MODAL_QUERY')[0] != null) {
		// Query
		bugReport.Modals.Query.Modal         = $('#MODAL_QUERY');
		bugReport.Modals.Query.Email         = $('#MODAL_QUERY_Email');
		bugReport.Modals.Query.Type          = $('#MODAL_QUERY_Type');
		bugReport.Modals.Query.Description   = $('#MODAL_QUERY_Brief');
		bugReport.Modals.Query.Reproduce     = $('#MODAL_QUERY_Reproduce');
		bugReport.Modals.Query.Information   = $('#MODAL_QUERY_Information');
		bugReport.Modals.Query.Visible       = $('#MODAL_QUERY_Visible');
		bugReport.Modals.Query.Fixed         = $('#MODAL_QUERY_Fixed');
		bugReport.Modals.Query.Start         = $('#MODAL_QUERY_Start');
		
		// Perform the query
		function query() {
			var url             = Web.Url("/API/Report/Query");
			var vModal          = bugReport.Modals.Query;
			var query           = {
				email:          "",
				type:           0,
				brief:          "",
				reproduce:      "",
				information:    "",
				visible:        1,
				fixed:          1,
			};
			
			query.email        = vModal.Email.val();
			query.type         = vModal.Type.val();
			query.brief        = vModal.Description.val();
			query.reproduce    = vModal.Reproduce.val();
			query.information  = vModal.Information.val();
			query.fixed        = vModal.Fixed.val();
			
			query.Visible      = vModal.Visible.val();
			
			$.ajax({
				type:       "POST",
				url:        url,
				data:       query,
				success:    function(response) {
					
					if (response.error) {
						Web.Prompt(
							"An error occurred",
							"Failed to delete report: " + response.message,
							function() {
								vModal.Modal.modal('show');
							}); return;
					}
					
					// Set the html
					$('#bugList').html(response.HTML);
					
					// Rebind the click event
					$('.bug-report').on('click', bugReport.List.OnItemClick);
					
					// Hide the modal
					bugReport.Modals.Query.Modal.modal('hide');
				}, dataType:   "json"
			});
		}
		
		// Start the query
		bugReport.Modals.Query.Start.on('click', query);
		bugReport.Modals.Query.Email.keypress(function(e)           {if(e.which == 13) query();});
		bugReport.Modals.Query.Description.keypress(function(e)     {if(e.which == 13) query();});
	}
});


