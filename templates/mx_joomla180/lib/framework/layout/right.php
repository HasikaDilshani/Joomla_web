<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2017 mixwebtemplates.com. All Rights Reserved. 
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

if ($this->countModules ( 'right or right1 or right2 or right-mid or right3 or right4 or right-bottom' )) {
define('_RIGHT', 1);

?>
<div id="mx-rightcol">
<?php 
$this->addModules('right','mx_xhtml');//position right
$this->addModules('right1,right2','mx_xhtml','mx-right-gridtop');//position right1 and right2
$this->addModules('right-mid','mx_xhtml');//position right-mid
$this->addModules('right3,right4','mx_xhtml','mx-right-gridbottom');//position right3 and right4	
$this->addModules('right-bottom','mx_xhtml');//position right-bottom 				
?>
</div>
<?php
}