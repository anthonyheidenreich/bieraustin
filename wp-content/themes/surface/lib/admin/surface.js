/**
 * Functions file for loading custom Admin JS.
 *
 * @package Surface
 * @subpackage Functions
 */

(function($){
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		
		$( '#surface_tabs' ).tabs({
			cookie: { expires: 1 }
		});
		
	});

	/** jQuery Windows Load */
	$(window).load(function(){
	});	

})(jQuery);