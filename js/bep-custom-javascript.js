// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    console.log( "ready!" );

    // Checks if the .bep-seach div exists. 
    // if exists = true then: move the search bar template inside the .bep-search div.
    if ( $( ".bep-search" ).length ) {
    	$( ".bep-search" ).append( $( ".header-search-wrap" ) );
    	console.log("bep-search exists");
    }

    // Checks if the .page-profiles div exists. 
    // if exists = true then: 
    // Add post_type = profiles to add search for profiles.
    // Remove radius functionality.
    // Remove radius value from form as an input type.
    
    if ( $( ".page-profiles" ).length ) {
    	$( ".bep-search form .searchinput-wrap" ).append( $( "<input type='hidden' name='post_type' value='profile'>" ) );
    	$( ".radius" ).remove();
    	$( "input[name='a']" ).remove();
    	console.log("page-profiles exists");
    }

});