<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2015 mixwebtemplates.com. All Rights Reserved. 
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
if ($this->getParam('bootstrap',0)){
if (JVERSION>=3) {
// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');		
// Load optional rtl Bootstrap css and Bootstrap bugfixes
JHtmlBootstrap::loadCss();
} else {
$this->addCSS('bootstrap.min.css,bootstrap-responsive.min.css,bootstrap-extended.css');
$this->addJQuery();
$this->addJS('bootstrap.min.js');
}
}