/*
 * eFuncDr - jQuery Resize and Drag
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 */
;(function($){
	"use strict";
	$.fn.extend({
		eFuncDr: function(options) {
			var defaults = { //default values for plugin options
				width: 720,
				gridTotal: 12,
				gridStep: 60,
				gridCols: 6,
				nav: true,
				popupTitle: 'Title',
				popupContent: 'Content'
			}
			var options =  $.extend(defaults, options);
			return this.each(function(){
				var opts = options,
				    obj = $(this),
					textarea = obj.children('textarea').hide(),
					blockName = textarea.data('name'),
					gridValue = textarea.text().indexOf('|') != -1 ? textarea.text().split("|") : (textarea.text()+'|').split("|"),
					posValue = (gridValue[1] != null || gridValue[1] != '') ? gridValue[1].split(",") : '',
					current = gridValue[0] - 1,
					next = current+1,
					blockActiveName = '',
					showDesktops, showTablets, showPhones, customClass,
					colsNumber = Math.round(opts.gridTotal / (current+1));
					
			    obj.append('<div class="tc-blocks clearfix" />').addClass('tc-blocks-container clearfix');
				for (var i=0; i<opts.gridCols; i++){
					var posItem = '<span class="colnumber">'+colsNumber+'</span><span class="colname">'+blockName+(i+1)+'</span>';
					obj.children('.tc-blocks').append('<div class="block-grid tcGrid'+colsNumber+'"><div class="tc-block-content"><span class="tc-edit-block">Edit</span><span class="tc-devides"><i class="d">1</i><i class="t">1</i><i class="m">1</i><b class="customClass">&nbsp;</b></span><div class="tc-content-inside">'+posItem+'</div></div></div>');
				}
				var blocks = $('.tc-blocks > div', obj),
					blocksNav = $('.pager > a', obj);
				blocks.hide().removeClass((blocks.attr('class')).match(/tcGrid\d+/g).toString());
				for (var i=0; i <= current; i++){
					if(posValue == ''){
						blockActiveName += (i != 0 ? ',':'')+blockName+(i+1)+':'+colsNumber+'/0/0/0/';
						colsNumber = colsNumber;
						blockName = blockName;
						showDesktops = showTablets = showPhones = 0;
						customClass = '';
					}else{
						var colsNumberFirst = posValue[i].split(":");
						if(colsNumberFirst[1].indexOf('/') != -1){
							blockActiveName = posValue;
							var colsNumberSplit = colsNumberFirst[1].split("/");
							colsNumber = colsNumberSplit[0];
							showDesktops = colsNumberSplit[1]; showTablets = colsNumberSplit[2]; showPhones = colsNumberSplit[3]; customClass = colsNumberSplit[4];
						}else{
							blockActiveName += (i != 0 ? ',':'')+colsNumberFirst[0]+':'+colsNumberFirst[1]+'/0/0/0/';
							colsNumber = colsNumberFirst[1];
							showDesktops = showTablets = showPhones = 0;
							customClass = '';
						}
						blockName = colsNumberFirst[0];
					}
					blocks.eq(i).fadeIn().addClass('tcGrid'+colsNumber).find('.colnumber').text(colsNumber).end().find('.colname').text(blockName+(posValue == '' ? (i+1) : '')).end()
							.find('.d').text(showDesktops).end().find('.t').text(showTablets).end().find('.m').text(showPhones).end().find('.customClass').text(customClass);
					blocks.eq(i).find('.tc-devides > i').each(function(index, element) {
                        if(parseInt($(this).text()) == 1) $(this).addClass('disable');
                    });
					textarea.text((current+1)+'|'+blockActiveName);
				}
				
				if(opts.nav){
					obj.append('<div class="pager btn-group" />');
					blocks.each(function(index) {
						$('.pager', obj).append('<a href="#" class="btn"><span>'+(index+1)+'</span></a>');
					});
					blocksNav = $('.pager > a', obj);
					blocksNav.eq(current).addClass('active');
				}
				if(blocksNav){
					$('span', blocksNav).click(function(e) {
						e.preventDefault();
						next = $(this).parent().index();
						rotate();
						return false;
					});
				}
				var rotate = function(){
					var blockActiveNext = '',
						colsNumberNext = '',
						colsNumberNextSplit = '',
						showDevices = '';				
					blocks.attr('class','').addClass('block-grid ui-resizable').hide();
					for (var i=0; i <= next; i++){
						if(posValue == ''){
							colsNumberNext = Math.round(opts.gridTotal / (next+1));
							blockActiveNext += (i != 0 ? ',':'')+blocks.eq(i).find('.colname').text()+':'+colsNumberNext+'/0/0/0/';
							showDesktops = showTablets = showPhones = 0;
							customClass = '';
						}else{
							if(posValue[i] != null){
								var rotateNumberNext = posValue[i].split(":");
								if(rotateNumberNext[1].indexOf('/') != -1){
									showDevices = rotateNumberNext[1];
									colsNumberNextSplit = rotateNumberNext[1].split("/");
									colsNumberNext = colsNumberNextSplit[0];
									showDesktops = colsNumberNextSplit[1]; showTablets = colsNumberNextSplit[2]; showPhones = colsNumberNextSplit[3]; customClass = colsNumberNextSplit[4];
								}else{
								colsNumberNext = rotateNumberNext[1];
								showDevices = rotateNumberNext[1]+'/0/0/0/';
								showDesktops = showTablets = showPhones = 0;
								customClass = '';
								}
							}else{
								colsNumberNext = opts.gridTotal;
								showDevices = opts.gridTotal+'/0/0/0/';
								showDesktops = showTablets = showPhones = 0;
								customClass = '';
							}
							blockActiveNext += (i != 0 ? ',':'')+blocks.eq(i).find('.colname').text()+':'+showDevices;
						}
						blocks.eq(i).removeAttr('style').fadeIn().addClass('tcGrid'+(colsNumberNext)).find('.colnumber').text(colsNumberNext).end()
								.find('.d').text(showDesktops).end().find('.t').text(showTablets).end().find('.m').text(showPhones).end().find('.customClass').text(customClass);
						textarea.empty().text((next+1)+'|'+blockActiveNext);
					};
					if(blocksNav){
						blocksNav.eq(current).removeClass('active')
							.end().eq(next).addClass('active');
					}
					current = next;
					next = current >= blocks.length-1 ? 0 : current+1;
				};
				//obj.children('.tc-blocks').sortable();
				obj.find('.tc-edit-block').click(function(e) {
					var tcparent = $(this).parent();
					$(this).addClass('tc-edit-block-in');
                    tcparent.append('<div class="tc-popover right"><div class="arrow"></div><h3 class="popover-title">'+opts.popupTitle+'</h3><div class="popover-content">'+opts.popupContent+'</div></div>');
					$('.tc-popover',obj).find('select option').filter(function() { 
						return $(this).val() == tcparent.find('.colname').text(); 
					}).attr('selected', true);
					tcparent.find('.tc-devides > i').each(function(index, element) {
                        if(parseInt($(this).text()) == 1)
							$('.tc-popover',obj).find('.visibleDevaices > input').eq(index).attr("checked", "checked");
                    });
					$('.tc-popover',obj).find('.inputClass').attr('value', tcparent.find('.tc-devides > b').text());
					if($(this).nextAll('.tc-popover').is(':hidden'))
						tcparent.children('.tc-popover').show();
                });
				$(document).mouseup(function(e) {
					var currentValue = textarea.text().split("|");
					var currentPosValue = currentValue[1].split(",");
					if(!$(e.target, obj).parents('.tc-popover').length || $(e.target, obj).is('button')){
					    obj.mouseup(function(e){
							if($(e.target, obj).is('button') && $(e.target, obj).hasClass('save')){
								var posText = $(e.target, obj).parents('.tc-popover').find('select option:checked').attr('value');
								var customClassText = $(e.target, obj).parents('.tc-popover').find('.inputClass').val();
								var targetBlock = $(e.target, obj).parents('.block-grid');
								targetBlock.find('.colname').empty().text(posText).end().find('.customClass').empty().text(customClassText);
								$('.tc-popover',obj).find('.visibleDevaices > input').each(function(index, element) {
									if($(this).is(':checked'))
										targetBlock.find('.tc-devides > i').eq(index).text('1').addClass('disable');
									else
										targetBlock.find('.tc-devides > i').eq(index).text('0').removeClass('disable');
								});
								currentPosValue[targetBlock.index()] = targetBlock.find('.colname').text()+':'+targetBlock.find('.colnumber').text()+'/'+targetBlock.find('.d').text()+'/'+targetBlock.find('.t').text()+'/'+targetBlock.find('.m').text()+'/'+targetBlock.find('.customClass').text();
								textarea.empty().text(currentValue[0]+'|'+currentPosValue.toString());
							}
						})
						obj.find('.tc-popover').remove().end().find('.tc-edit-block').removeClass('tc-edit-block-in');
					}
                });
				
				obj.find('.block-grid').resizable({
					containment: obj.children('.tc-blocks'),
					grid: opts.gridStep,
					handles: 'e',
					stop: function() {
						var currentValue = textarea.text().split("|");
						var currentPosValue = currentValue[1].split(",");
						$(this).find('.colnumber').empty().text(Math.round(opts.gridTotal*$(this).width()/opts.width));
						currentPosValue[$(this).index()] = $(this).find('.colname').text()+':'+$(this).find('.colnumber').text()+'/'+$(this).find('.d').text()+'/'+$(this).find('.t').text()+'/'+$(this).find('.m').text()+'/'+$(this).find('.customClass').text();
						textarea.empty().text(currentValue[0]+'|'+currentPosValue.toString());
					}
				});
			});
		}
	});
})(jQuery);