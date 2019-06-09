<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2019 mixwebtemplates.com. All Rights Reserved. 
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

jimport('joomla.filesystem.file');
class sboostHelper {
var $API;
var $sboostPath;
var $sboostUrl;
var $theme;
var $themePath;
var $themeUrl;
var $basePath;
var $baseUrl;
var $style;
var $direction;

//initialize 
function __construct($_this){
$this->API=$_this;
$this->theme=$_this->template;
$this->basePath=JPATH_BASE;
$this->baseUrl=$_this->baseurl;
$this->themePath=$this->basePath .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR. $this->theme;	
$this->themeUrl=$this->baseUrl . '/templates/'. $this->theme;		
$this->sboostPath=$this->basePath .DIRECTORY_SEPARATOR. 'templates' .DIRECTORY_SEPARATOR. $this->theme .DIRECTORY_SEPARATOR. 'lib' .DIRECTORY_SEPARATOR.'framework';		
$this->sboostUrl= $this->baseUrl . '/templates/'. $this->theme .DIRECTORY_SEPARATOR. 'lib' .DIRECTORY_SEPARATOR.'framework';
}

//get parameter
function getParam($paramName, $default=null){
return $this->API->params->get($paramName, $default);
}

//set parameter
function setParam($paramName, $paramValue){
return $this->API->params->set($paramName, $paramValue);
}

function import($path) {//import file
$path=str_replace( '.', DIRECTORY_SEPARATOR, $path );
$filepath=$path . '.php';

if(JFile::exists('templates'. DIRECTORY_SEPARATOR. $this->theme . DIRECTORY_SEPARATOR . $filepath)) { //cheack template path
require_once('templates'. DIRECTORY_SEPARATOR. $this->theme . DIRECTORY_SEPARATOR . $filepath);
} elseif(JFile::exists($this->sboostPath . DIRECTORY_SEPARATOR . $filepath)) { //if not found, then check from sboost path
require_once($this->sboostPath . DIRECTORY_SEPARATOR . $filepath);
} 
}

function layout() {
$layout_type  = isset($_COOKIE[$this->theme . '_layout']) ? $_COOKIE[$this->theme . '_layout'] : $this->API->params->get('layout_type');
if(isset($_GET['layout']) AND is_numeric($_GET['layout'])) {
setcookie($this->theme . '_layout', $_GET['layout'], time() + 3600, '/'); 
$layout_type = $_GET['layout'];
}
return $layout_type;	
}

/**
* Load mainbody
*
*/	
function loadLayout() {//load mainbody layout
$left_width			= (int) ('25');
$right_width		= (int) ('27');
$sideleft	 			= (int)  ('20');
$sideright				= (int)  ('30');
$unit 				= ("percent") ? "%" : "px"; 
$this->import('layout.left');
$this->import('layout.content');
$this->import('layout.right');	

$width = ("percent") ? 100 : $main_width;

if (defined('_LEFT') && defined('_RIGHT')) {
$content_width	= ($width -($left_width+$right_width));
} elseif (defined('_LEFT') || defined('_RIGHT')) {
$content_width	= ($width -(defined('_LEFT') ? $left_width : $right_width));
} else {
$content_width	= $width;
}

$c_width = ("percent") ? 100 : $content_width;

//Calculate sideleft and sideright width	
if ($this->countModules('sideleft and sideright')) {
$inner_width	= ($c_width -($sideleft+$sideright));
} elseif ($this->countModules('sideleft or sideright')) {
$inner_width	= ($c_width -($this->countModules('sideleft') ? $sideleft : $sideright));
} else {
$inner_width	= $c_width;
}

$this->API->addStyleDeclaration('#mx-maincol {width:' . $content_width . $unit .'}');	 $this->API->addStyleDeclaration('#inner_content {width: ' . $inner_width . $unit .';} ');	

}

/**
* function to add multiple features
*
*/	
function addFeatures($features) {
$features 	= explode(",",$features);
foreach ($features as $feature) {
$feature = trim($feature);//remove whitespace
$this->import("features.$feature");
}
}

/**
* Add feature function
*
*/	
function addFeature($feature) {
$this->import("features.$feature");
}	


function addJS ($srcs) {//add javascript
$srcs = explode (',',$srcs);
if (!is_array($srcs)) $srcs = array($srcs);   
foreach ($srcs as $src) {
if(JFile::exists($this->themePath .DIRECTORY_SEPARATOR. 'js' .DIRECTORY_SEPARATOR. $src)) { //cheack template path
$this->API->addScript($this->themeUrl . '/js/' . $src);
} elseif(JFile::exists($this->sboostPath . '/js/' . $src)) { //if not found, then check from sboost path
$this->API->addScript($this->sboostUrl . '/js/' . $src);
}		
}
}

function addCSS ($srcs) {//Add stylesheets
$srcs = explode (',',$srcs);
if (!is_array($srcs)) $srcs = array($srcs);   
foreach ($srcs as $src) {
if(JFile::exists($this->themePath .DIRECTORY_SEPARATOR. 'css' .DIRECTORY_SEPARATOR. $src)) { //cheack template path
$this->API->addStyleSheet($this->themeUrl . '/css/' . $src);
} elseif(JFile::exists($this->sboostPath . '/css/' . $src)) { //if not found, then check from sboost path
$this->API->addStyleSheet($this->sboostUrl . '/css/' . $src);
}		
}
}	

function addInlineJS($code) {//add inline js code
$this->API->addScriptDeclaration($code); 
}

function addInlineCSS($code) {//add inline css code
$this->API->addStyleDeclaration($code);	
}

function hideItem() {//Itemid for hiding component area
if ($this->getParam('hide_component')) {	
$menu = new JSite;
$menu = $menu->getMenu();
if (isset($menu->getActive()->id)) {
$Itemid = $menu->getActive()->id;//Detect active menu item
$hide_menu_items = $this->getParam('hide_menu_items');//Itemid to hide component area
if ($hide_menu_items=='') return;//empty item
if (!is_array($hide_menu_items)) $hide_menu_items = array($hide_menu_items);
if (in_array($Itemid, $hide_menu_items)) return true;
} 
}	
}

function showSlideItem() {//Itemid for hiding slider header	
if ($this->getParam('hide_slider')) {
$menu = new JSite;
$menu = $menu->getMenu();
if (isset($menu->getActive()->id)) {
$Itemid = $menu->getActive()->id;//Detect active menu item
$show_slider_items = $this->getParam('show_slider_items');//Itemid to hide slider header
if ($show_slider_items=='') return;//empty item
if (!is_array($show_slider_items)) $show_slider_items = array($show_slider_items);
if (in_array($Itemid, $show_slider_items)) return true;
} 	
}
}

function getSiteName() {//get site name
$app = JFactory::getApplication();
return $app->getCfg('sitename');
}

function countModules($modules) {
return $this->API->countModules($modules);//Count Modules
}

function renderModules($mods,$style='mx_raw',$class='') {//Load modules
$output='';
foreach($mods as $mod) {
$output	.='<div style="width:' . $mod['width'] . '" class="mx-block '. $mod['sep'] . '">';
$output	.='<div id="' . $mod['name'] . '" class="mod-block ' . $class . $mod['extra-css'] . '">';
$output	.='<jdoc:include type="modules" name="' . $mod['name'] . '" style="' . $style . '" />';
$output	.='</div>';	
$output	.='</div>';		
}	
echo $output;
}

/**
* Function to load single ot multiple module
*
*/
function addModules($modPos, $style='mx_raw', $gridId='', $width='', $equalHeight = false, $fluid = false) {
$output='';
$mods = $this->getModules($modPos, $width);//get active modules
$modCnt = count((array)$mods);
if ($mods) {
if ($gridId) {//gridId
$output .= '<div id="' . $gridId . '" class="mx-modCol' . $modCnt . ' clearfix">';
}

if ($fluid) {//full width
$output .= '<div class="mx-base clearfix">';
}

if ($gridId || $fluid) {
$output .= '<div class="mx-inner clearfix">';
}

foreach($mods as $mod) {
if ($gridId) {
$output	.= '<div style="width:' . $mod['width'] . '" class="mx-block '. $mod['sep'] . '">';
$output	.= '<div id="mx-' . $mod['name'] . '" class="mod-block mx-' . $mod['name'] . ' ' . $mod['extra-css'] . '">';
} else {
$output	.= '<div id="mx-' . $mod['name'] . '" class="clearfix">';			
$output	.= '<div class="mx-inner clearfix">';
}
$output	.= '<jdoc:include type="modules" name="' . $mod['name'] . '" style="' . $style . '" />';
$output	.= '</div>';	
$output	.= '</div>';		
}	

if ($gridId || $fluid) {
$output .= '</div>';
}			

if ($fluid) {//full width
$output .= '</div>';
}	

if ($gridId) {//gridId
$output .= '</div>';
}


echo $output;
}
return false;
}

/**
* Check modules to load
*
*/
function hasModule($position){	
$position = explode (',',$position);
if (!is_array($position)) $position = array($position);           
if(is_array($position)){    
$modcount=0;
$modules=array();
foreach($position as $val){
$val=trim($val);
if($this->API->countModules($val)){
array_push($modules,$val);
$modcount++;
} 
}

if($modcount==0){
return false;
}
return $modules; 
}

}

function getModules($pos, $width=''){
$activeMod	= $this->hasModule($pos);
$max		= count((array)$activeMod);

if ($width !="") {
$width = explode (",", $width);
$wcount = count ($width);

if ($max > $wcount) {
$ws = array();
for ($i=$wcount - 1; $i<$max; $i++) {
$ws[] .= round(($width[$wcount-1]/($max + 1 -$wcount)),3);
} 				
array_pop($width);//remove last value from the array

foreach ($ws as $w) {
array_push ($width, $w);//add new width
}

} else {
$ws = "";
for ($i=$max - 1; $i<$wcount; $i++) {
$ws += $width [$i];
} 
for ($i=0; $i<($wcount - $max) + 1; $i++) {
array_pop($width);
}
array_push ($width, $ws);
}

} else {
$ws = array();
for ($i=0; $i<$max; $i++) {
$ws[] .= round((100/$max),3);	
}	
$width= $ws;
}

$count=1;
if(is_array($activeMod)){
$modules = array();
foreach($activeMod as $id=>$val){
if($count==1){
$modules[$count] = array(
'name'=>$val,
'width'=>$width[$id] . "%",
'extra-css'=> ($max==1) ? ' single' : ' first',
'sep'=> ($max==1) ? '' : ' separator'
);  
}
elseif($count==$max){
$modules[$count] = array(
'name'=>$val,
'width'=>$width[$id] . "%",
'extra-css'=> ' last',
'sep'=> ''
);  
} 
else{
$modules[$count] = array(
'name'=>$val,
'width'=>$width[$id] . "%",
'extra-css'=> '',
'sep'=> ' separator'
);  
}

$count++;
}  
return $modules;
}
return false;
}

/**
* Detect IE
*
*/
function isIE($version = false) {   
$agent=$_SERVER['HTTP_USER_AGENT'];  
$found = strpos($agent,'MSIE ');  
if ($found) { 
if ($version) {
$ieversion = substr(substr($agent,$found+5),0,1);   
if ($ieversion == $version) return true;
else return false;
} else {
return true;
}

} else {
return false;
}
if (stristr($agent, 'msie'.$ieversion)) return true;
return false;        
}

/**
* Get menu
*
*/
function getMenu() {
$menutype  = isset($_COOKIE[$this->theme . '_menu']) ? $_COOKIE[$this->theme . '_menu'] : $this->API->params->get('mxmenu','css');
if(isset($_GET['menu'])) {
setcookie($this->theme . '_menu', $_GET['menu'], time() + 3600, '/'); 
$menutype = $_GET['menu'];
}
return $menutype;
}	


/**
* Get language direction
*
*/
function getDirection() {
$direction  = isset($_COOKIE[$this->theme . '_direction']) ? $_COOKIE[$this->theme . '_direction'] : $this->API->params->get('direction','ltr');
if(isset($_GET['direction'])) {
setcookie($this->theme . '_direction', $_GET['direction'], time() + 3600, '/'); 
$direction = $_GET['direction'];
}

if(($direction=='rtl') || ($this->API->direction == 'rtl')) $direction='rtl';
else $direction='ltr';

$this->direction = $direction;

return $direction;		
}

/**
* Check RTL website
*
*/
function isRTL()
{
if ($this->getDirection()=="rtl") {
return true;
}
return false;
}	

/**
* Load Head
*
*/	
function loadHead() {
echo '<jdoc:include type="head" />';
$this->getDirection();//rtl or ltr
JHtml::_('behavior.framework', true);
$this->addFeatures('jquery,bootstrap');//bootstarp & jQuery since 1.9.5		
$this->API->addStylesheet($this->baseUrl."/templates/system/css/system.css");
$this->API->addStylesheet($this->baseUrl."/templates/system/css/general.css");
echo '<link href="' . $this->themeUrl . '/images/favicon.ico" rel="shortcut icon" type="image/x-icon" />';
}

/**
* add favicon
*
*/
function favicon($src='favicon.ico') {
return;
}

/**
* Detect frontpage
*/
function isFrontPage(){
return (JRequest::getVar( 'view' ) == 'featured');   
}

/**
* Add jQuery
*
*/	
function addJQuery($usecdn=false) {
if (JVERSION>=3) {
JHtml::_('jquery.framework');
} else {
$scripts = (array) array_keys( $this->API->_scripts );
$hasjquery=false;
foreach($scripts as $script) {
if (preg_match("/\b(jquery|jquery-latest).([0-9\.min|max]+).(.js)\b/i", $script)) {
$hasjquery = true;
}  
}

if( !$hasjquery ) {
if( $usecdn ) $this->addJS( 'http://code.jquery.com/jquery-latest.min.js' );
else $this->addJS( 'jquery.min.js' );
}
$this->addJS( 'jquery-noconflict.js' );
}
}	

function replaceUrl($matches) {//replace url with absolute path
$url = str_replace(array('"', '\''), '', $matches[1]);
$url = $this->fixUrl($url);
return "url('$url')";
}

function fixUrl($url) {
global $absolute_url;
$base = dirname($absolute_url);
if (preg_match('/^(\/|http)/', $url))
return $url;
/*absolute or root*/
while (preg_match('/^\.\.\//', $url)) {
$base = dirname($base);
$url = substr($url, 3);
}

$url = $base . '/' . $url;
return $url;
}	

function realPath($strSrc) {//Real path of css or js file
if (preg_match('/^https?\:/', $strSrc)) {
if (!preg_match('#^' . preg_quote(JURI::base()) . '#', $strSrc)) return false; //external css
$strSrc = str_replace(JURI::base(), '', $strSrc);
} else {
if (preg_match('/^\//', $strSrc)) {
if (!preg_match('#^' . preg_quote(JURI::base(true)) . '#', $strSrc)) return false; //same server, but outsite website
$strSrc = preg_replace('#^' . preg_quote(JURI::base(true)) . '#', '', $strSrc);
}
}
$strSrc = str_replace('//', '/', $strSrc);
$strSrc = preg_replace('/^\//', '', $strSrc);
return $strSrc;
}	

}