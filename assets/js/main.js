/**
 * Created by CallumCarmicheal on 05/04/2017.
 */

function isFunction(functionToCheck) {
	var getType = {};
	return functionToCheck && getType.toString.call(functionToCheck) === '[object Function]';
}

function isNullOrWhitespaced(str){
	var b1 = str === null || str.match(/^\s*$/) !== null;
	var b2 = str.trim() == "";
	
	return b1 || b2;
}

function validateEmail(email) {
	var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
	return regex.test(email);
}

var Web;
var bugReport;

Web = {
	Modals: {
		Confirm: {
			Modal:  null,
			Yes:    null,
			No:     null,
			Title:  null,
			Body:   null,
			
			fClearHandlers: function() {}
		},
		
		Prompt: {
			Modal:  null,
			Okay:   null,
			Title:  null,
			Body:   null,
			
			fClearHandlers: function() {}
		}
	},
	
	Url: function()         { return "undef"; },
	
	Redirect: function(url) {
		window.location = Web.Url(url);
	},
	
	Confirm: function(title, content, callback=null) {
		// Store our elements locally to make it
		// easier to access
		var elements = Web.Modals.Confirm;
		
		// Clear any events
		elements.fClearHandlers();
		
		// Store values
		elements.Title.html(title);
		elements.Body.html(content);
		
		function returnValue(value) {
			// Remove modal event
			elements.Modal.off('hidden.bs.modal');
			
			// Hide the modal
			elements.Modal.modal('hide');
			
			if (callback !== null && isFunction(callback))
				callback(value);
			
			// Ensure that we dont use the callback twice
			callback = null;
		}
		
		// Setup events
		elements.Yes.on('click', function() { returnValue(true); });
		elements.No.on ('click', function() { returnValue(false); });
		
		// If modal is closed by clicking out of bounds, Assume No!
		elements.Modal.on('hidden.bs.modal', function () {
			console.log("Modal clicked out of bounds, assuming no!");
			returnValue(false);
		});
		
		// Show the modal
		elements.Modal.modal('show');
	},
	
	Prompt: function(title, content, callback=null) {
		// Store our elements locally to make it
		// easier to access
		var elements = Web.Modals.Prompt;
		
		// Clear any events
		elements.fClearHandlers();
		
		// Store values
		elements.Title.html(title);
		elements.Body.html(content);
		
		function returnValue() {
			// Hide the modal
			elements.Modal.modal('hide');
			
			if (callback !== null && isFunction(callback))
				callback();
			
			// Ensure that we dont use the callback twice
			callback = null;
		}
		
		// Setup events
		elements.Okay.on('click', function() { returnValue(true); });
		
		// If modal is closed by clicking out of bounds, Assume No!
		elements.Modal.on('hidden.bs.modal', function () {
			console.log("Modal clicked out of bounds, returning.");
			returnValue();
		});
		
		// Show the modal
		elements.Modal.modal('show');
	},
};

bugReport = {
	
	JsonModal: {
		id:                  false,
		bug_type:            false,
		reproduce:           "",
		brief:               "",
		information:         "",
		date_created:        "",
		date_lastedited:     "",
		fixed:               false,
		admin:               false,

		// IF [ADMIN]
		email:               "",
		visible:             false,
		
		// IF [ERROR]
		error:               false,
		message:             "",
	},
	
	Modals: {
		View: {
			Modal:       null,
			Title:       null,
			Body:        null,
			
			Information: null,
			Edit:        null,
			Delete:      null,
			
			fClearHandlers: function() {}
		},
		
		Edit: {
			Modal:          null,
			
			Title:          null,
			Email:          null,
			Type:           null,
			Description:    null,
			Reproduce:      null,
			Information:    null,
			Fixed:          null,
			Visible:        null,
			
			Save:           null
		},
		
		Query: {
			Modal:          null,
			
			Email:          null,
			Type:           null,
			Description:    null,
			Reproduce:      null,
			Information:    null,
			Fixed:          null,
			Visible:        null,
			
			Start:          null
		}
	},
	
	GetReport: function(id, callback=null) {
		var url = Web.Url("/API/Report/GetInformation");
		
		$.ajax({
			type:       "POST",
			url:        url,
			data:       { id: id },
			success:    callback,
			dataType:   "json"
		});
	},
	
	GetBugType: function(type) {
		switch (type) {
			case 1: return "Menu";
			case 2: return "Gameplay";
			case 3: return "Other";
		} return "Unknown";
	},
	
	List: {
		// Jquery callback
		OnItemClick: function() {
			var $this = $(this);
			var id = $this.attr('bug_id');
			
			bugReport.GetReport(id, function(data) {
				var vModal = bugReport.Modals.View;
				var report = bugReport.JsonModal;
					report = data;
					
				if (report.error) {
					Web.Prompt(
						"An error occurred",
						"Failed to retrieve report information: " + report.message
					);
					
					return;
				}

				vModal.Information.attr("report_id", report.id);
				vModal.Title.html(report.brief);
				
				$(vModal.Body.find('.value-id')[0])
					.html(report.id);
				
				$(vModal.Body.find('.value-bugtype')[0])
					.html(bugReport.GetBugType(report.bug_type));
				
				$(vModal.Body.find('.value-reproduce')[0])
					.html(report.reproduce);
				
				$(vModal.Body.find('.value-fixed')[0])
					.html(report.fixed ? "Yes" : "No");
				
				if (report.information != null) {
					$(vModal.Body.find('.value-info')[0])
						.html(report.information);
				}
				
				if (report.admin) {
					$(vModal.Body.find('.value-email')[0])
						.html(report.email);
					
					$(vModal.Body.find('.value-visible')[0])
						.html(report.visible ? "Yes" : "No");
				}
				
				$(vModal.Modal).modal('show');
			});
		}
	}
};

function smoothScrollInto(selector) {
	var target = $(selector);
	//target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
	if (target.length) {
		$('html, body').animate({
			scrollTop: target.offset().top - 60
		}, 1000);
		return false;
	}
}

$(function() {
	$(document).bind('pageinit', function () {
		$.mobile.defaultPageTransition = 'none';
	});
	
	// Scroll to elements
	$('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
			var target = $(this.hash);
			target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
			if (target.length) {
				$('html, body').animate({
					scrollTop: target.offset().top - 60
				}, 1000);
				return false;
			}
		}
	});
	
	var back_to_top = $('#back-to-top');
	if (back_to_top.length) {
		var scrollTrigger = 100, // px
			backToTop = function () {
				var scrollTop = $(window).scrollTop();
				if (scrollTop > scrollTrigger) {
					back_to_top.addClass('show');
				} else {
					back_to_top.removeClass('show');
				}
			};

		backToTop();
		
		$(window).on('scroll', function () { backToTop(); });
		back_to_top.on('click', function (e) {
			e.preventDefault();
			$('html,body').animate({
				scrollTop: 0
			}, 700);
		});
	}
	
	// Tooltip only Text
	$('.masterTooltip').hover(function(){
		// Hover over code
		var title = $(this).attr('title');
		$(this).data('tipText', title).removeAttr('title');
		
		$('<p class="tooltip"></p>')
			.html(title)
			.appendTo('body')
			.fadeIn('slow');
	}, function() {
		// Hover out code
		$(this).attr('title', $(this).data('tipText'));
		$('.tooltip').remove();
	}).mousemove(function(e) {
		var mousex = e.pageX + 20; //Get X coordinates
		var mousey = e.pageY + 10; //Get Y coordinates
		$('.tooltip')
			.css({ top: mousey, left: mousex })
	});
	
	// Open the bug information on click
	$('.bug-report').on('click', bugReport.List.OnItemClick);
	
	// Bug Report Modal
	bugReport.Modals.View = {
		Modal:       $('#MODAL_REPORT_VIEW'),
		Title:       $('#MODAL_REPORT_VIEW_Title'),
		Body:        $('#MODAL_REPORT_VIEW_Body'),
		
		Information: $('#MODAL_REPORT_VIEW_INFORMATION'),
		
		Edit:        $('#MODAL_REPORT_VIEW_edit'),
		Delete:      $('#MODAL_REPORT_VIEW_delete'),
		
		fClearHandlers: function() {}
	};
	
	// Set modal helpers
	Web.Modals.Confirm = {
		Modal:  $('#MODAL_PUBLIC_CONFIRM'),
		Yes:    $('#MODAL_PUBLIC_CONFIRM_YES'),
		No:     $('#MODAL_PUBLIC_CONFIRM_NO'),
		Title:  $('#MODAL_PUBLIC_CONFIRM_TITLE'),
		Body:   $('#MODAL_PUBLIC_CONFIRM_BODY'),
		
		fClearHandlers: function() {
			Web.Modals.Confirm.Yes.off('click');
			Web.Modals.Confirm.No .off('click');
		}
	};
	Web.Modals.Prompt = {
		Modal:  $('#MODAL_PUBLIC_OKAY'),
		Okay:   $('#MODAL_PUBLIC_OKAY_YES'),
		Title:  $('#MODAL_PUBLIC_OKAY_TITLE'),
		Body:   $('#MODAL_PUBLIC_OKAY_BODY'),
		
		fClearHandlers: function() {
			Web.Modals.Prompt.Okay.off('click');
		}
	};
});