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
if(!defined('DS')){
define( 'DS', DIRECTORY_SEPARATOR );
}
$docs = JFactory::getDocument();
$sboost_path = (dirname(__file__) . DS . 'framework' . DS . 'base' . DS . 'frame.helper.php');
require_once($sboost_path);
$sboost = new sboostHelper($docs);
