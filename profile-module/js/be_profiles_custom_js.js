jQuery( document ).ready(function($) {
    jQuery(document).on( 'submit', '#be_contact_form', function(e) {
    	e.preventDefault();
	    var form = jQuery(this);
	    var messagename = $("#message_name").val();
		var messageemail = $("#message_email").val();
		var messagesubject = $("#message_subject").val();
		var messagetext = $("#message_text").val();
		var security = $("#submitted").val();
		var postid = $("#postid").val();
		var filter = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
		var testemail = filter.test(messageemail);
		var runajax = 1;

		if (messagename == "") {
			$( ".message_name_error" ).html( "You left this field empty." );
			$( ".message_name_error" ).show();
			var runajax = 0;
		}
		else {
			$( ".message_name_error" ).hide();
		}
		if (messageemail == "") {
			$( ".message_email_error" ).html( "You left this field empty." );
			$( ".message_email_error" ).show();
			var runajax = 0;
		}
		else if (!testemail && messageemail != "") {
			$( ".message_email_error" ).html( "Please enter a valid email." );
			$( ".message_email_error" ).show();
			var runajax = 0;
		}
		else {
			$( ".message_email_error" ).hide();
		}
		if (messagetext == "") {
			$( ".message_text_error" ).html( "You left this field empty." );
			$( ".message_text_error" ).show();
			var runajax = 0;
		}
		else {
			$( ".message_text_error" ).hide();
		}
		if (runajax == 1) {
		    jQuery.ajax({
				url : myAjax.ajaxurl,
				type : 'post',
				dataType : 'text',
				data : {
					action : 'be_profiles_mailer',
					messagename: $("#message_name").val(),
					messageemail: $("#message_email").val(),
					messagesubject: $("#message_subject").val(),
					messagetext: $("#message_text").val(),
					security: $("#submitted").val(),
					postid: $("#postid").val(),
				},
				beforeSend: function () {
					$( ".be_message" ).hide();
					$('.be_ajax_loader').show();
				},
				success: function( data ) {
					$('.be_ajax_loader').hide();
					if (data == "NOT SENT" || data == -1) {
						$( ".be_message" ).html( "<span style='color:#cc0000'>There was a problem. Please try again later.</span>" );
						$( ".be_message" ).show();
						console.log(data);
					}
					else {
						$( ".be_message" ).html( "<span style='color:#008000'>Your message was successfully sent.</span>" );
						$( ".be_message" ).show();
						$('.timescontacted span').hide();
						$('.timescontacted span').html(data);
						$( '.timescontacted span' ).show();
						console.log(data)
						/* Reset Form */
						$("#message_name").val('');
						$("#message_email").val('');
						$("#message_subject").val('');
						$("#message_text").val('');
					}

				},
				error: function(xhr, ajaxOptions, thrownError) {
					console.warn(xhr.status);
	        		console.warn(thrownError);
				}
			});
		}
	    return false;
	})
});