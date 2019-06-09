<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Sboost Framework   
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2019 mixwebtemplates.com. All Rights Reserved.
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
require_once(dirname(__FILE__).'/lib/sboost.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language;?>" >
<head>
<?php
$sboost->loadHead();
$sboost->addCSS('template.css,joomla.css,menu.css,override.css,modules.css,social.css');
if ($sboost->isRTL()) $sboost->addCSS('template_rtl.css');
$slides          = $this->params->get('slides');
?>
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/custom.js"></script>
<?php if($this->params->get('show_awesome')=='1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/font-awesome.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<?php if($this->params->get('social_api_type', '1') == '1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/social.css" rel="stylesheet" type="text/css" />
<?php endif; ?>
<link href="https://fonts.googleapis.com/css?family=Lato:300,400" rel="stylesheet"> 
<?php if($this->params->get('float')=='1') : ?>
<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/css/slide.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template;?>/js/slide.js"></script> 
<?php endif; ?>
</head>
<?php $sboost->addFeatures('ie6warn'); ?>
<body class="bg <?php echo $sboost->direction ?> clearfix">

<div id="mx-masid">
<div id="mx-top-header" class="clearfix">
<?php 
$sboost->addModules('top-menu'); // module top-menu
?>
<div class="clearfix"></div>
<?php $sboost->addFeatures('social'); //social ?>
<div class="clearfix"></div>
<?php 
$sboost->addModules('login'); // login
$sboost->addModules('search'); // search
?>	
</div>
<div id="mx-header" class="mx-header">
<div class="mx-base">	
<?php 
$sboost->addFeatures('logo');//Logo
?>
<div class="main_menu">
<?php 
$sboost->addModules("mainmenu"); //position mainmenu
?>
</div>
</div>
<div class="clearfix"></div>
</div>
<div class="mx-base-in">
<div id="wrappet">
<div id="topbgr" class="clearfix">
<?php if ($sboost->showSlideItem()): ?>
<div id="slides">
<?php include 'slider/slider.php'; ?>
</div>
<?php endif; ?>
<div class="mx-base clearfix">
<?php
$sboost->addModules("header"); //position header
?>
</div>
<div id="tophead">
<div class="mx-base clearfix">
<?php
$sboost->addModules('top1, top2, top3, top4, top5, top6', 'mx_block', 'mx-userpos'); //positions top1-top6 
?>
</div>
</div>	
</div>
<?php 
$sboost->addModules('top', 'mx_xhtml'); //top 
?>
<div id="wrapper">
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
</div>
<?php if ($this->countModules( 'extra1 or extra2 or extra3 or extra4' )) : ?>
<div id="mainbott">
<div class="mx-base clearfix">
<?php 
$sboost->addModules('extra1, extra2, extra3, extra4', 'mx_block', 'mx_xhtml'); //extra	
?>
</div>
</div>
<?php endif; ?>
<?php if ($this->countModules( 'mainbottom1 or mainbottom2 or mainbottom3 or mainbottom4' )) : ?>
<div id="fobott">
<div class="mx-base clearfix">
<?php 
$sboost->addModules('mainbottom1,mainbottom2,mainbottom3,mainbottom4', 'mx_block', 'mx-mainbottom'); //mainbottom1-mainbottom8	
?>
</div>
</div>
<?php endif; ?>
<div id="map">
<div class="mx-base clearfix">
<?php $sboost->addModules('map', 'mx_xhtml'); //map  ?>
</div>
</div>
<div id="setbottom">
<div class="mx-base clearfix">
<?php $sboost->addModules('bottom', 'mx_xhtml'); //bottom  ?>
</div>
</div>
<?php if ($this->countModules( 'bottom1 or bottom2 or bottom3 or bottom4 or bottom5 or bottom6' )) : ?>
<div id="bottsite" class="clearfix">
<div class="mx-base clearfix">
<?php
$sboost->addModules('bottom1, bottom2, bottom3, bottom4, bottom5, bottom6', 'mx_block', 'mx-bottom', '', false, true); //positions bottom1-bottom6 
?>
</div>
</div>
<?php endif; ?>
</div>
<div id="bottomspot">
<!--Start Footer-->
<div id="mx-footer" class="mx-base">
<div id="mx-bft" class="clearfix">
<div class="cp">
<?php $sboost->addFeatures('copyright,designed')  ?>					
</div>
<?php $sboost->addFeatures('colors');//Template colors ?>
<?php
$sboost->addFeatures('gotop');		
$sboost->addModules("footer-nav"); 
?>
</div>
</div>
<!--End Footer-->
</div>
</div>
</div>

<?php 
$sboost->addFeatures('analytics,jquery,ieonly'); /*--- analytics, jquery features ---*/
?>
<jdoc:include type="modules" name="debug" />
</body>
</html>