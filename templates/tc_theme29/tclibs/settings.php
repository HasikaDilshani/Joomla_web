<?php
defined('_JEXEC') or die('Restricted access');
///  Renderer modules  //
function TCShowModule($name, $style, $customClass = '', $compos = -1){
$modmodule = $modstep = $showlogo = $showmenu = $tcExtPosition = $tcDesktop = $tcTablet = $tcPhone = $tcCustomClass = '';
jimport( 'joomla.application.module.helper' );
$customParams = JFactory::getApplication()->getTemplate(true)->params;
$doc = JFactory::getDocument();
$app = JFactory::getApplication();

//// MENU /////
$menucontrol = $customParams->get("menucontrol", 1);
$menu_name = $customParams->get("menutype", "mainmenu");
$renderer	= $doc->loadRenderer('module');
$module = JModuleHelper::getModule('mod_menu', '$menu_name');
$attribs['style'] = 'none';
$module->params	= "menutype=$menu_name\nshowAllChildren=1\nstartLevel=0\nendLevel=10\nclass_sfx=tc_nav tc-menu\ntag_id=tcdefaultmenu";
if($menucontrol == 1)
$showmenu = '<div id="tc_main_menu" class="tc_menufix clearfix">'.$renderer->render($module, $attribs).'</div>';


//// LOGO /////
if($customParams->get('logo') == 2)
$showlogo .= '<a id="tc_logo" href="'.JURI::root().'"><h1>'.$customParams->get('logotext').'</h1><span>'.$customParams->get('slogan').'</span></a>';
elseif($customParams->get('logo') == 1)
$showlogo .= '<a id="tc_logo" href="'.JURI::root().'"><img src="'.$customParams->get('logoimage').'" alt="Logo" /></a>';
else
$showlogo .= '<a id="tc_logo" href="'.JURI::root().'"><img src="'.JURI::root().'templates/'.$app->getTemplate().'/images/logo.png" alt="Logo" /></a>';


//// MODULES /////
$logopos = $customParams->get('logopos', 'header1');
$menupos = $customParams->get('menupos', 'header2');
$posValue = explode("|", $customParams->get($name));
$posCount = $posValue[0];
$posName = (isset($posValue[1]) ? $posValue[1] : $name+'1:12/0/0/0/');
$modulecount = 0;
for ($i = 0; $i < $posCount; $i++) {
$tcCountPositions = explode(",", $posName);
$tcCountPosition = (isset($tcCountPositions[$i])) ? $tcCountPositions[$i] : '';
if($tcCountPosition != ''){
$tcPositionName = explode(":", $tcCountPosition);
$tcPositionNameValue = $tcPositionName[0];
if(isset($tcPositionName[1]) != ''){
$tcExtPosition = explode("/", $tcPositionName[1]);
if (isset($tcExtPosition[0])) $tcPositionNameGrid = $tcExtPosition[0];
if (isset($tcExtPosition[1])) $tcDesktop = $tcExtPosition[1];
if (isset($tcExtPosition[2])) $tcTablet = $tcExtPosition[2];
if (isset($tcExtPosition[3])) $tcPhone = $tcExtPosition[3];
if (isset($tcExtPosition[4])) $tcCustomClass = $tcExtPosition[4];
}
}
if (count(JModuleHelper::getModules($tcPositionNameValue)) || $logopos == ($tcPositionNameValue) || $menupos == ($tcPositionNameValue) || ($i == $compos && $compos >= 0)) :
$modmodule .='<div class="col-md-'.$tcPositionNameGrid.''.($tcDesktop ? 'hidden-desktop hidden-md hidden-lg' : '').''.($tcTablet ? 'hidden-tablet hidden-sm' : '').''.($tcPhone ? 'hidden-phone hidden-xs' : '').' '.$tcCustomClass.''.($i > 0 ? 'separator_'.$name : '').''.(($i == $compos && $compos >= 0) ? 'tc_component':'tc_block').'">';
$modmodule .=($logopos == $tcPositionNameValue ? $showlogo : '').($menupos == $tcPositionNameValue ? $showmenu : '');
$modmodule .=(($i == $compos && $compos >= 0) ? '<jdoc:include type="message" /><jdoc:include type="component" />' : '');
if (count(JModuleHelper::getModules($tcPositionNameValue)))
$modmodule .='<jdoc:include type="modules" name="'.$tcPositionNameValue.'" style="'.$style.'" />';
$modmodule .='</div>';
$modulecount = $modulecount + 1;
endif;
}
if($modulecount > 0)
$modmodule = '<section class="tc_wrapper_'.$name.' tc_section"><div class="'.$customClass.' tc_group"><div id="tc_'.$name.'" class="tc_'.$name.' row-fluid clearfix">'
.$modmodule.
'</div></div></section>';

return $modmodule;
}
///  Cookies  //
$cookie_prefix = $this->template;
$cookie_time = time()+30000000;
$tc_temp = array('TemplateStyle','Layout');
foreach ($tc_temp as $tprop) {
$tc_session = JFactory::getSession();

if (isset($_REQUEST[$tprop])) {
$$tprop = JRequest::getString($tprop, null, 'get');
$tc_session->set($cookie_prefix.$tprop, $$tprop);
setcookie ($cookie_prefix. $tprop, $$tprop, $cookie_time, '/', false);   
global $$tprop; 
}
}
jimport( 'joomla.application.module.helper' );
$customParams = JFactory::getApplication()->getTemplate(true)->params;
$pageview = JRequest::getVar('view', '');
$pageoption = JRequest::getVar('option', '');
$pageID = JRequest::getVar('Itemid', '');
$slides	     = $this->params->get('slides');
$template_baseurl = $this->baseurl.'/templates/'.$this->template;
$Default_Layout	= $this->params->get("layout", "lbr");
$copyright = $this->params->get("copyright", 1);
$cpright = $this->params->get("cpright", "");
$logo = $this->params->get("logo", 0);
$menuStick = $this->params->get("menuStick", 1);
//FEATURES
$menucontrol = $this->params->get("menucontrol", 1);
$totop = $this->params->get("totop", 1);
$jquery = $this->params->get("jquery", 0);
$document	= JFactory::getDocument();
$jversion = new JVersion;
$document->addStyleSheet($template_baseurl.'/css/bootstrap/css/bootstrap.css');
$document->addStyleSheet($template_baseurl.'/tclibs/menus/css/menu.css');
$document->addStyleSheet($template_baseurl.'/css/template.css');
$document->addStyleSheet($template_baseurl.'/css/font-awesome/css/font-awesome.min.css');
if(!file_exists(JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php')) {
$document->addStyleSheet($template_baseurl.'/css/k2.css');
}

if ($jquery == 1) 
$document->addScript($template_baseurl.'/tclibs/helper/jquery-1.7.2.min.js');
if ($jquery == 2){
if (version_compare($jversion->getShortVersion(), '3.0.0', '<'))
$document->addScript($template_baseurl.'/tclibs/helper/jquery-1.7.2.min.js');
}
$document->addScript($template_baseurl.'/css/bootstrap/js/bootstrap.min.js');
$document->addScript($template_baseurl.'/tclibs/helper/browser-detect.js');
if ($menucontrol == 1) {
$document->addScript($template_baseurl.'/tclibs/menus/jquery.hoverIntent.minified.js');
$document->addScript($template_baseurl.'/tclibs/menus/jquery.menu.js');
}
if(($this->countModules('slider') && $slides == 2) || ($slides == 1)){ 
$document->addStyleSheet($template_baseurl.'/slider/css/style.css');
$document->addScript($template_baseurl.'/slider/js/revslider.js');

$document->addScriptDeclaration('

jQuery(document).ready(function(){
jQuery("#rev-slider").show().revolution({
dottedOverlay: "none",
delay: 7000,
startwidth: 0,
startheight:500,

hideThumbs: 200,
thumbWidth: 200,
thumbHeight: 50,
thumbAmount: 2,

navigationType: "none",
navigationArrows: "verticalcentered",
navigationStyle: "round",

touchenabled: "on",
onHoverStop: "on",

swipe_velocity: 0.7,
swipe_min_touches: 1,
swipe_max_touches: 1,
drag_block_vertical: false,

spinner: "spinner0",
keyboardNavigation: "on",

navigationHAlign: "center",
navigationVAlign: "bottom",
navigationHOffset: 0,
navigationVOffset: 20,

soloArrowLeftHalign: "left",
soloArrowLeftValign: "center",
soloArrowLeftHOffset: 20,
soloArrowLeftVOffset: 0,

soloArrowRightHalign: "right",
soloArrowRightValign: "center",
soloArrowRightHOffset: 20,
soloArrowRightVOffset: 0,

shadow:0,	
fullWidth: "on",
fullScreen: "on",

stopLoop: "off",
stopAfterLoops: -1,
stopAtSlide: -1,

shuffle: "off",

autoHeight: "on",
forceFullWidth: "off",
fullScreenAlignForce: "off",
minFullScreenHeight: 0,
hideNavDelayOnMobile: 1500,

hideThumbsOnMobile: "off",
hideBulletsOnMobile: "off",
hideArrowsOnMobile: "off",
hideThumbsUnderResolution: 0,

hideSliderAtLimit: 0,
hideCaptionAtLimit: 0,
hideAllCaptionAtLilmit: 0,
startWithSlide: 0,
fullScreenOffsetContainer: ""
});
});
');

}

if ($totop == 1) 
$document->addScript($template_baseurl.'/tclibs/helper/scrolltotop.js');
if ($totop == 1) 
$document->addScriptDeclaration("
jQuery(document).ready(function() {
jQuery(document.body).SLScrollToTop({
'text':			'Go to Top',
'title':		'Go to Top',
'className':	'scrollToTop',
'duration':		500
});
});");
if ($menucontrol == 1) 
$document->addScriptDeclaration("
var tcDefaultMenu = jQuery.noConflict();
jQuery(document).ready(function(){
jQuery('#tcdefaultmenu').oMenu({
theme: 'default-menu',
effect: 'fade',
mouseEvent: 'hover'
});
});");
require_once (dirname(__FILE__).DS.'sett.php');
require_once (dirname(__FILE__).DS.'browsers.php');
?>


