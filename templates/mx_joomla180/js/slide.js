/*---------------------------------------------------------------

# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2017 mixwebtemplates.com. All Rights Reserved.
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/


 jQuery(document).ready(function() {

 	///////////////////////// Menu fixed /////////////////////////////////////
 	var amount = jQuery(window).scrollTop();
 	if(amount>=123){
 		jQuery('#mx-header').addClass("menu-fixed");
 	}else{
 		jQuery('#mx-header').removeClass("menu-fixed");
 	}
 	
 });

////////////////////////////////// Loaded ////////////////////////////////////

 jQuery(window).scroll(function(e) {
 	var amount = jQuery(window).scrollTop();
 	//var kt = jQuery('#t3-mainbody').offset().top-400;
 	var documentHeight = jQuery(document).height();
 	if(amount>200){
 		jQuery('#mainbody').addClass("loadted");
 	}
 	///////////////////  Menu position ////////////////////////////////
 	//console.log(amount);
 	if(amount>=385){
 		jQuery('#mx-header').addClass("menu-fixed");
 	}else{
 		jQuery('#mx-header').removeClass("menu-fixed");
 	}
 });


