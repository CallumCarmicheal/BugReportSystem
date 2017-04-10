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
	bugReport.Modals.Edit.Save          = $('#MODAL_EDIT_REPORT_SAVE');
	
	var current_id = -1;
	
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
			
			vModal.
			
			vModal.Email.val(report.email);
			vModal.Type.val(report.bug_type);
			
			vModal.Description.val(report.brief);
			vModal.Reproduce.val(report.reproduce);
			vModal.Information.val(report.information);
			
			// Show the modal
			vModal.Modal.modal('show');
		});
	});
	
	bugReport.Modals.View.Delete.on('click', function() {
		Web.Prompt("Delete ;(");
	});
	
	// On save (Edit)
});


