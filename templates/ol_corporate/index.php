<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Sboost Framework   
# ---------------------------------------------------------------
# Author - olwebdesign http://www.olwebdesign.com
# Copyright (C) 2008 - 2017 olwebdesign.com. All Rights Reserved.
# Websites: http://www.olwebdesign.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
require_once(dirname(__FILE__).'/lib/sboost.php');
?>
<!DOCTYPE html >
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language;?>" >
<head>
<?php
$sboost->loadHead();
$sboost->addCSS('template.css,joomla.css,menu.css,override.css,modules.css,ama.css');
if ($sboost->isRTL()) $sboost->addCSS('template_rtl.css');
?>
<?php if($this->params->get('float')=='1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/slide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/slide.js"></script> 
<?php endif; ?>
<?php if($this->params->get('social_api_type', '1') == '1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/social.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php if($this->params->get('show_awesome')=='1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/custom.js"></script>
</head>
<?php $sboost->addFeatures('ie6warn'); ?>
<body class="bg <?php echo $sboost->direction ?> clearfix">

<div id="mx-top-header" class="mx-base">
<?php 
$sboost->addFeatures('logo');//Logo
?>
<?php $sboost->addFeatures('social'); //social ?>	
<?php 
$sboost->addModules('top-menu'); // module top-menu
?>
<div class="clearfix"></div>
</div>
<div id="mx-mainsite" class="mx-base">
<?php if ($this->countModules( 'mainmenu' )) : ?>
<div id="mx-header" class="mx-header">
<div class="mx-base clearfix">	
<div class="main_menu">
<?php 
$sboost->addModules("mainmenu"); //position mainmenu
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php endif; ?>
<?php if ($sboost->showSlideItem()): ?>
<?php include 'slider/slider.php'; ?> 
<?php endif; ?>
<?php 
$sboost->addModules('top', 'mx_xhtml'); //top 
?>
<?php if ($this->countModules( 'top1 or top2 or top3 or top4 or top5 or top6' )) : ?>
<div id="mx-coce">
<?php
$sboost->addModules('top1, top2, top3, top4, top5, top6', 'mx_block', 'mx-userpos'); //positions top1-top6 
?>
</div>
<?php endif; ?> 
<?php $sboost->addModules('section', 'mx_xhtml'); //section  ?>
<div id="mx-basebody">	
<div class="mx-base main-bg clearfix">
<?php 
$sboost->addModules("breadcrumbs"); //breadcrumbs
?>
<div class="clearfix">
<?php $sboost->loadLayout(); //mainbody ?>
</div>
</div>
</div>
<?php if ($this->countModules( 'pricing' )) : ?>
<div id="mx-coceb">
<?php $sboost->addModules('pricing', 'mx_xhtml'); //pricing  ?>
</div>
<?php endif; ?> 
<?php if ($this->countModules( 'map' )) : ?>
<div id="botmap">
<?php $sboost->addModules('map', 'mx_xhtml'); //map  ?>
</div>
<?php endif; ?> 
<?php if ($this->countModules( 'extra1 or extra2' )) : ?>
<div id="botmap">
<div class="mx-base clearfix">
<?php
$sboost->addModules('extra1, extra2', 'mx_block', 'mx-hed'); //position extra
?>
</div>
</div>
<?php endif; ?> 
<?php $sboost->addModules('bottom', 'mx_xhtml'); //bottom  ?>
<?php if ($this->countModules( 'bottom1 or bottom2 or bottom3 or bottom4 or bottom5 or bottom6' )) : ?>
<div id="bottsite" class="clearfix">
<?php
$sboost->addModules('bottom1, bottom2, bottom3, bottom4, bottom5, bottom6', 'mx_block', 'mx-bottoms', '', false, true); //positions bottom1-bottom6 
?>
</div>
<?php endif; ?> 

<!--Start Footer-->
<div id="mx-footer" class="mx-base">
<div id="mx-bft" class="clearfix">
<?php $sboost->addFeatures('colors');//Template colors ?>
<div class="cp">
<?php $sboost->addFeatures('copyright,designed')  ?>					
</div>
<?php
$sboost->addFeatures('gotop');		
$sboost->addModules("footer-nav"); 
?>
</div>
</div>
<!--End Footer-->
</div>

<?php 
$sboost->addFeatures('analytics,jquery,ieonly'); /*--- analytics, jquery features ---*/
?>
<jdoc:include type="modules" name="debug" />

</body>
</html>