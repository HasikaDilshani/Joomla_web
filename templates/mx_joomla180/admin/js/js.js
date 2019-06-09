jQuery(window).load(function(){
	var widthWind = jQuery(window).height()-120;
	jQuery('#module-form, #style-form').height(widthWind);
	jQuery('.form-horizontal').append("<div class='right-block'></div>");

	jQuery(window).resize(function() {
		var widthWind = jQuery(window).height()-120;
	jQuery('#module-form, #style-form').height(widthWind);
	});

});

jQuery(document).ready(function(){
	var cloneContent = jQuery('.form-inline.form-inline-header').clone();
	jQuery('.form-inline.form-inline-header').remove();
	jQuery('#details').prepend(cloneContent);
	jQuery( "#jform_params_module_background" ).change(function() {
		var backgroundIMG = jQuery('#jform_params_module_background').val();
		if ( backgroundIMG != "" ) {
			jQuery('.form-horizontal').css('background-image', 'url(../' + backgroundIMG + ')');
		}
	}).trigger( "change" );
});