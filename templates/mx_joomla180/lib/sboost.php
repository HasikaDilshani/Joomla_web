<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Sboost Framework   
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2015 mixwebtemplates.com. All Rights Reserved.
# Websites: http://www.mixwebtemplates.com
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
