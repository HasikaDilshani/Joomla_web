
;(function($){
"use strict";
$.fn.oMenu = function(options){ //define the defaults for the plugin and how to call it	
var defaults = { //set default options  
width: '100%',
orientation: true, // TRUE = Horizontal, FALSE = Vertical
mouseEvent: 'hover', // 'click', 'hover'
speed: 400,
effect: 'slide', // 'fade', 'blind', 'slide', 'fold', 'bounce'
cols: 1,
colsWidth: 220,
theme: 'theme1-red',
easing: 'swing',
stick: true,
onLoad : function(){},
beforeOpen : function(){},
beforeClose: function(){}
};
var options = $.extend(defaults, options); //call in the default otions	
return this.each(function(){ //The element that is passed into the design  
var obj = $(this),
opts = options,  
classParent = 'tc-menu',
classSubContainer = 'sub-container',
classSubGroup = 'mega-group',
classSubMenu = 'sub-menu',
classHover = 'mega-hover',
videoTag = 'iframe, video, audio',
orientation;
if(opts.orientation){ 
obj.addClass('oHorizontal').width(opts.width);
orientation = 'oHorizontal-wrapper navbar-inner';
}else{
obj.addClass('oVertical').width(opts.width);
orientation = 'oVertical-wrapper';
}
obj.addClass('main-'+classParent).wrap('<div class="'+orientation+' '+(opts.theme).replace("-", " ")+' '+classParent+'-wrapper clearfix" />').children(':last').addClass('menu-item-last')
.end().children(':first').addClass('menu-item-first').end().children().show();
if(opts.stick){
obj.before('<span class="menu-stick">Menu</span>').addClass('tc-menu-stick');
$(document).click(function(e){
if(obj.css('display') == 'none' && $(e.target).is('.menu-stick')){
obj.show().closest('body').removeClass('oMenuStickClose').addClass('oMenuStickOpen').append('<div class="oMenuOverwrite"/>');					
}else{
if(!$(e.target).is('li, a', obj))
obj.hide().closest('body').removeClass('oMenuStickOpen').addClass('oMenuStickClose').find('.oMenuOverwrite').remove();
}
});
}
megaSetup();
function menuOpen(self){
if(opts.mouseEvent == 'hover') var self = $(this);
var subNav = $('> .'+classSubContainer, self);
self.addClass(classHover);
subNav.find(videoTag).show();
switch(opts.effect){
default:
case 'fade':
subNav.fadeIn(opts.speed, opts.easing);
break;
case 'blind':
subNav.slideDown(opts.speed, opts.easing);
break;
case 'slide':
subNav.animate({'width': 'toggle'}, opts.speed, opts.easing);
break;
case 'fold':
subNav.animate({'width': 'toggle', 'height': 'toggle'}, opts.speed, opts.easing);
break;
case 'bounce':
subNav.css({'display':'block', 'margin-top': 100, 'opacity': 0}).animate({'margin-top': 0, 'opacity': 1}, opts.speed, opts.easing);
break;
}
opts.beforeOpen.call(this); // beforeOpen callback;
}
function menuClose(self){
if(opts.mouseEvent == 'hover') var self = $(this);
var subNav = $('> .'+classSubContainer, self);
var videosrc = $(videoTag, subNav).attr('src');
subNav.find(videoTag).removeAttr('src').hide().attr('src',videosrc);
switch(opts.effect){
default:
case 'fade':
subNav.fadeOut(opts.speed /2);
break;
case 'blind':
subNav.slideUp(opts.speed /2);
break;
case 'slide':
subNav.animate({'width': 'toggle'}, opts.speed/2);
break;
case 'fold':
subNav.animate({'width': 'toggle', 'height': 'toggle'}, opts.speed/2);
break;
case 'bounce':
subNav.animate({'margin-top': 100, 'opacity': 0}, opts.speed/2).hide();
break;
}
self.removeClass(classHover);
opts.beforeClose.call(this); // beforeClose callback;
}
function megaSetup(){
var arrow = '<span class="tc-menu-icon">&nbsp;</span>';
var subWrap = '<div class="'+classSubContainer+'"><div class="'+classSubContainer+'-inner"></div></div>';
var $oCols = $('*[class*="mega-cols"]', obj);
$('> li', obj).each(function(){ //Set Width of sub
var $mainSub = $('> ul,> .'+classSubMenu, this);
var $primaryLink = $('> a', this);
if($mainSub.length){
$primaryLink.addClass(classParent).append(arrow);
$mainSub.addClass(classSubMenu+' clearfix').wrap(subWrap);
$mainSub.wrapInner('<div class="row-fluid" />');						
if($('ul', $mainSub).length){
$(this).addClass(classParent+'-li').find('.'+classSubContainer).addClass('mega');
$('li', $mainSub).each(function(){
if($(this).hasClass(classSubGroup)){
$(this).addClass(classSubGroup+'-header');
if($('> ul', this).length){
$(this).addClass(classSubGroup);
$('> a', this).addClass(classSubGroup+'-title');
$(this).children('ul').wrap('<div class="'+classSubGroup+'-wrap clearfix" />');
}
}else{
$(this).find('> ul').addClass(classSubMenu+' clearfix').wrap(subWrap);
if($(this).find('.'+classSubContainer).length){
$('> a', this).addClass(classParent).append(arrow);
$('.'+classSubContainer, obj).find('.'+classSubContainer).css('left', opts.colsWidth);
}
}
});			
} else {
$('.'+classSubContainer, this).addClass('non-mega');
}
}
if(!opts.orientation){
$('.'+classSubContainer, obj).css('left', opts.colsWidth); var $top = 0;
}else var $top = $(this).outerHeight(true);
$(this).children('.'+classSubContainer).css({'top': $top, 'position':'absolute', 'z-index':999}).end()
.find('.'+classSubMenu+' li:not(".'+classSubGroup+'")').width(opts.colsWidth);
});
if(opts.mouseEvent == 'hover'){
$('li', obj).hoverIntent({
sensitivity: 2,
interval: 20,
over: menuOpen,
timeout: 100,
out: menuClose
}); 
}else if(opts.mouseEvent == 'click'){
$(document).mouseup(function(e){
obj.find('li').removeClass(classHover).find('.'+classSubContainer).hide();
});
$('a.'+classParent, obj).click(function(e){
$(this).parents('.'+classSubContainer).show().end().parents('li').addClass(classHover);
e.preventDefault();
menuOpen($(this).parent());		
});
}
opts.onLoad.call(this); // onLoad callback;
}
});
};
})(jQuery);