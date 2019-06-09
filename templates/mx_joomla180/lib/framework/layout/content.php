<?php
/*---------------------------------------------------------------
# Package - Sboost Framework 
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2017 mixwebtemplates.com. All Rights Reserved.
# license - PHP files are licensed under  GNU/GPL V2 
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
?>
<div id="mx-maincol" class="clearfix">
<?php
$this->addModules('header1'); //header1
$this->addModules('maintop1, maintop2, maintop3, maintop4', 'mx_xhtml', 'mx-maintop-grid-top'); //maintop1-maintop4
?>
<div class="clr"></div>
<?php $this->addModules('sideleft', 'mx_xhtml'); //sideleft ?>
<div id="inner_content" class="clearfix"> <!--Component Area-->
<?php 
$this->addModules('advert', 'mx_xhtml'); //advert	
$this->addModules('advert1,advert2,advert3,advert4', 'mx_xhtml', 'mx-advert-grid-top'); //advert1-advert4
$this->addModules('advert-mid', 'mx_xhtml'); //advert-mid
$this->addModules('advert5,advert6,advert7,advert8', 'mx_xhtml', 'mx-advert-grid-bottom'); //advert5-advert8	
$this->addModules('advert-bottom', 'mx_xhtml'); //advert-bottom
?>		
<?php if (!$this->hideItem()): ?>
<div class="mx-component-area clearfix">
<div class="mx-inner clearfix">
<?php $this->addModules('pathway'); //pathway position ?>
<jdoc:include type="message" />
<div class="mx-component-area-inner clearfix">
<jdoc:include type="component" />
</div>	
</div>
</div>
<?php endif; ?>
<?php
$this->addModules('info-top', 'mx_xhtml'); //info-top 
$this->addModules('info1,info2,info3,info4', 'mx_xhtml', 'mx-info'); //info1-info4
$this->addModules('info-bottom', 'mx_xhtml'); //info-bottom 
?>
</div>
<?php 
$this->addModules('sideright', 'mx_xhtml'); //sideright
?>
<div class="clr"></div>
</div>