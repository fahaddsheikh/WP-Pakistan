jQuery(function($){

  // Set all variables to be used in scope
  var frame,
      metaBox = $('#be_metaboxes.postbox'), // Your meta box id here
      addImgLink = metaBox.find('.upload-custom-img'),
      delImgLink = metaBox.find( '.meta-gallery-images ul li'),
      imgContainer = metaBox.find( '.meta-gallery-images ul'),
      imgIdInput = metaBox.find( '.custom-img-id' );
      
  
  // ADD IMAGE LINK
  addImgLink.on( 'click', function( event ){
    
    event.preventDefault();
    
    // If the media frame already exists, reopen it.
    if ( frame ) {
      frame.open();
      return;
    }
    
    // Create a new media frame
    frame = wp.media({
      title: 'Select or Upload Media Of Your Chosen Persuasion',
      button: {
        text: 'Use this media'
      },
      multiple: false  // Set to true to allow multiple files to be selected
    });

    
    // When an image is selected in the media frame...
    frame.on( 'select', function() {
      
      // Get media attachment details from the frame state
      var attachment = frame.state().get('selection').first().toJSON();

      // Send the attachment URL to our custom image input field.
      imgContainer.append( '<li><img id="'+attachment.id+'" width="150" height="150" class="img-responsive" style="margin-right:3px;" src="'+attachment.url+'"/></li>' );

      // Send the attachment id to our hidden input
      imginputgrabber = metaBox.find( '.custom-img-id' ).val();
      console.log(imginputgrabber);
      
      if (imginputgrabber.length != 0) {
        console.log("NOT NULL");
        imgIdInput.val( imginputgrabber + ',' + attachment.id  );
      }
      else {
        console.log("NULL");
        imgIdInput.val( attachment.id  );
      }
      
      // Hide the add image link
      addImgLink.addClass( 'hidden' );

      // Unhide the remove image link
      delImgLink.removeClass( 'hidden' );
    });

    // Finally, open the modal on click
    frame.open();
  });
  
  
  // DELETE IMAGE LINK
  $(document).on('click', '.meta-gallery-images ul li', function(event) {

    event.preventDefault();
    var imageid = $(this).find( 'img' ).attr("id");
    var attachedimagesstring = $('.custom-img-id').val();

    console.log(imageid);
    console.log(attachedimagesstring);
    var attachedimagesarray = JSON.parse("[" + attachedimagesstring + "]");
    console.log(attachedimagesarray);

    attachedimagesarray = jQuery.grep(attachedimagesarray, function(value) {
      return value != imageid;
    });
    console.log(attachedimagesarray);
    $('.custom-img-id').val(attachedimagesarray);
    $(this).remove();

  });

});