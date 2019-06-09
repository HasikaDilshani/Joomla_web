
jQuery(document).ready(function() {
//Start main menu slideDown on hover
	function meinMenuResize(){
		var widthWindow = jQuery(window).width();
		if (widthWindow <= 1024) {
			jQuery('.main_menu li').hover(function() {
    		 jQuery('>ul', this).stop().show();           
		 },
		function() {
	     	jQuery('>ul', this).stop().show();                                 
	    });
		} else{
			jQuery('.main_menu li ul').hide()
			jQuery('.main_menu li').hover(function() {
    		 jQuery('>ul', this).stop().slideDown(600);           
		 },
		function() {
	     	jQuery('>ul', this).stop().slideUp(300);                                 
	    });
		};
	};
	meinMenuResize();	

//End animation effects
});