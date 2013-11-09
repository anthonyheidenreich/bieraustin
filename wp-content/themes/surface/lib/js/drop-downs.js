/**
 * Functions file for loading custom JS for Surface drop downs.
 *
 * @package Surface
 * @subpackage Functions
 */

(function($){
	
	/** Surface Dorp Downs */
	function surfaceMenu() {
		
		$( '.menu1 ul' ).supersubs({			
			
			minWidth: 16,
			maxWidth: 27,
			extraWidth: 1		
		
		}).superfish({		
			
			delay: 100,
			speed: 'fast',
			animation: { opacity:'show', height:'show' },
			//autoArrows: false,
			dropShadows: false
	  
	  });
	  
	}
	
	/** jQuery Document Ready */
	$(document).ready(function(){
		surfaceMenu();
	});

})(jQuery);