jQuery(document).ready(function(){
  var arr = [];
  var k = "";
  jQuery('#attrib-presetslide .control-group').each(function(i,n){
      if(jQuery(n).find('.alert-info').length){
          k = "collection" + i;
          arr.push(i);
      }else{
          n.id = k;
      }
  })
  for (var i = 0; i < arr.length; i++) {
    jQuery('#attrib-presetslide #collection'+arr[i]).wrapAll("<div class='collection'></div>");
  };
  jQuery('#attrib-presetslide>.collection').hide();
  jQuery('#attrib-presetslide>.control-group').click(function(){
    jQuery( this ).next().stop( true, true ).toggle( "slow" );
  });
});
jQuery(document).ready(function(){
  var arr = [];
  var k = "";
  jQuery('#attrib-ADVANCED .control-group').each(function(i,n){
      if(jQuery(n).find('.alert-info').length){
          k = "collection" + i;
          arr.push(i);
      }else{
          n.id = k;
      }
  })
  for (var i = 0; i < arr.length; i++) {
    jQuery('#attrib-ADVANCED #collection'+arr[i]).wrapAll("<div class='collection'></div>");
  };
  jQuery('#attrib-ADVANCED>.collection').hide();
  jQuery('#attrib-ADVANCED>.control-group').click(function(){
    jQuery( this ).next().stop( true, true ).toggle( "slow" );
  });
});