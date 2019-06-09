<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - olwebdesign http://www.olwebdesign.com
# Copyright (C) 2008 - 2017 olwebdesign.com. All Rights Reserved. 
# Websites: http://www.olwebdesign.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

if ($this->countModules ( 'left or left1 or left2 or left-mid or left3 or left4 or left-bottom' )) {
define('_LEFT', 1);
?>
<div id="mx-leftcol" class="clearfix">
<?php 
$this->addModules('left','mx_xhtml');//position left
$this->addModules('left1,left2','mx_xhtml','mx-left-gridtop');//position left1 and left2
$this->addModules('left-mid','mx_xhtml');//position left-mid
$this->addModules('left3,left4','mx_xhtml','mx-left-gridbottom');//position left3 and left4	
$this->addModules('left-bottom','mx_xhtml');//position left-bottom 			
?>
</div>
<?php
}