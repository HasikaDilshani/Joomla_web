/*---------------------------------------------------------------

# Author - olwebdesign http://www.olwebdesign.com
# Copyright (C) 2008 - 2018 olwebdesign.com. All Rights Reserved.
# Websites: http://www.olwebdesign.com
-----------------------------------------------------------------*/


 jQuery(document).ready(function() {

 	var amount = jQuery(window).scrollTop();
 	if(amount>=123){
 		jQuery('#mx-header').addClass("menu-fixed");
 	}else{
 		jQuery('#mx-header').removeClass("menu-fixed");
 	}
 	
 });


 jQuery(window).scroll(function(e) {
 	var amount = jQuery(window).scrollTop();
 	//var kt = jQuery('#mainbody').offset().top-400;
 	var documentHeight = jQuery(document).height();
 	if(amount>200){
 		jQuery('#mainbody').addClass("loadted");
 	}

 	if(amount>=385){
 		jQuery('#mx-header').addClass("menu-fixed");
 	}else{
 		jQuery('#mx-header').removeClass("menu-fixed");
 	}
 });


