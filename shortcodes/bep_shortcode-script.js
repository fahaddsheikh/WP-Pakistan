// A $( document ).ready() block.
jQuery( document ).ready(function($) {

	$( ".bep_trending-now-display-area" ).each(function( index ) {
	    (function($set){
	        setInterval(function(){
	            var $cur1 = $set.find('.bep_animated_xlong').removeClass('bep_animated_xlong bep_fadeInRight');
	            var $next1 = $cur1.next().length?$cur1.next():$set.children().eq(0);
	            $cur1;
	            $next1.addClass('bep_animated_xlong bep_fadeInRight');
	        },3000);
	    })($(this));
	});
});