<?php
defined( '_JEXEC' ) or die( 'Restricted index access' );
$Layout = $Default_Layout;
$mainurl = $_SERVER['PHP_SELF'] . rebuildQueryString($tc_temp);
foreach ($tc_temp as $tprop) {
$tc_session = JFactory::getSession();
if ($tc_session->get($cookie_prefix.$tprop)) {
$$tprop = $tc_session->get($cookie_prefix.$tprop);
} elseif (isset($_COOKIE[$cookie_prefix. $tprop])) {
$$tprop = JRequest::getVar($cookie_prefix. $tprop, '', 'COOKIE', 'STRING');
}    
}
function rebuildQueryString($tc_temp) {
if (!empty($_SERVER['QUERY_STRING'])) {
$parts = explode("&", $_SERVER['QUERY_STRING']);
$newParts = array();
foreach ($parts as $val) {
$val_parts = explode("=", $val);
if (!in_array($val_parts[0], $tc_temp)) {
array_push($newParts, $val);
}
}
if (count($newParts) != 0) {
$qs = implode("&amp;", $newParts);
} else {
return "?";
}
return "?" . $qs . "&amp;";
} else {
return "?";
} 
}
/////// Select Layouts ///////
if($this->countModules('right and left') && $Layout == "lbr") :
$component = TCShowModule('lbr', 'tc_xhtml', 'tc_aside', 1);
else :
if(($this->countModules('right') && $Layout == "br") || ($this->countModules('right') && $Layout == "lbr")) :
$component = TCShowModule('br', 'tc_xhtml', 'tc_aside', 0);
else :
if(($this->countModules('left') && $Layout == "lb") || ($this->countModules('left') && $Layout == "lbr")) :
$component = TCShowModule('lb', 'tc_xhtml', 'tc_aside', 1);
else :
if((!$this->countModules('right and left') && ($Layout == "lbr")) || (!$this->countModules('right') && ($Layout == "br")) || (!$this->countModules('left') && ($Layout == "lb"))) :
$component = '<div class="col-md-12 tc_component"><jdoc:include type="component" /><jdoc:include type="modules" name="inset" style="tc_xhtml" /></div>';
endif;
endif;
endif;
endif;
?>