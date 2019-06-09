<?php /**  * @copyright	Copyright (C) 2012 AJoomlaTemplates.com - All Rights Reserved. **/ defined( '_JEXEC' ) or die( 'Restricted index access' );

if ($this->countModules("left") && $this->countModules("right")) {$compwidth="6";}
else if ($this->countModules("left") && !$this->countModules("right")) { $compwidth="9";}
else if (!$this->countModules("left") && $this->countModules("right")) { $compwidth="9";}
else if (!$this->countModules("left") && !$this->countModules("right")) { $compwidth="12";}

$user1_count = $this->countModules('user1');
if ($user1_count > 4) { 
$user1_width = $user1_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user1_width = $user1_count > 0 ? ' span' . floor(12 / $user1_count) : '';}

$user2_count = $this->countModules('user2');
if ($user2_count > 4) { 
$user2_width = $user2_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user2_width = $user2_count > 0 ? ' span' . floor(12 / $user2_count) : '';}

$user3_count = $this->countModules('user3');
if ($user3_count > 4) { 
$user3_width = $user3_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user3_width = $user3_count > 0 ? ' span' . floor(12 / $user3_count) : '';}

$user4_count = $this->countModules('user4');
if ($user4_count > 4) { 
$user4_width = $user4_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user4_width = $user4_count > 0 ? ' span' . floor(12 / $user4_count) : '';}

$user5_count = $this->countModules('user5');
if ($user5_count > 4) { 
$user5_width = $user4_count > 0 ? ' span' . floor(12 / 4) : '';} else {
$user5_width = $user4_count > 0 ? ' span' . floor(12 / $user5_count) : '';}

function isMobile() {
if(isset($_SERVER["HTTP_X_WAP_PROFILE"])) {return true;}
if(preg_match("/wap.|.wap/i",$_SERVER["HTTP_ACCEPT"])) {return true;}
if(isset($_SERVER["HTTP_USER_AGENT"])){
$user_agents = array("iphone","ipod","midp", "j2me", "avantg", "docomo", "novarra", "palmos", "palmsource", "240x320", "opwv", "chtml", "pda", "windows ce", "mmp", "blackberry", "mib", "symbian", "wireless", "nokia", "hand", "mobi", "phone", "cdm", "up.b", "audio", "SIE-", "SEC-", "samsung", "HTC", "mot-", "mitsu", "sagem", "sony", "alcatel", "lg", "erics", "vx", "NEC", "philips", "mmm", "xx", "panasonic", "sharp", "wap", "sch", "rover", "pocket", "benq", "java", "pt", "pg", "vox", "amoi", "bird", "compal", "kg", "voda", "sany", "kdd", "dbt", "sendo", "sgh", "gradi", "jb", "dddi", "moto");
foreach($user_agents as $user_string){
if(preg_match("/ipad/i",$_SERVER["HTTP_USER_AGENT"])) {
return false;}
if(preg_match("/".$user_string."/i",$_SERVER["HTTP_USER_AGENT"])) {return true;}
}}return false;}

eval(str_rot13('shapgvba purpx_sbbgre(){$y=\'<n uers="uggc://nwbbzyngrzcyngrf.pbz/wbbzyn-3.0-grzcyngrf/" gnetrg="_oynax" gvgyr="wbbzyn">Wbbzyn 3.0 Grzcyngrf</n> ol <n uers="uggc://jjj.erivrjohvyqre.pbz/vazbgvba-ubfgvat/" gnetrg="_oynax" gvgyr="VaZbgvba">VaZbgvba Ubfgvat Erivrj</n>\';$s=qveanzr(__SVYR__).\'/vaqrk.cuc\';$sq=sbcra($s,\'e\');$p=sernq($sq,svyrfvmr($s));spybfr($sq);vs(fgecbf($p,$y)==0){rpub(\'Cyrnfr xrrc gur sbbgre yvaxf vagnpg!\');qvr;}}purpx_sbbgre();'));
?>