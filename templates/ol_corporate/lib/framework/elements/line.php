<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - olwebdesign http://www.olwebdesign.com
# Copyright (C) 2008 - 2017 olwebdesign.com. All Rights Reserved. 
# Websites: http://www.olwebdesign.com
-----------------------------------------------------------------*/
defined('JPATH_BASE') or die;

jimport('joomla.form.formfield');
class JFormFieldLine extends JFormField {
	protected $type = 'Line';
	protected function getInput() {
		$text  	= (string) $this->element['text'];
		return '<div class="line_separator'.(($text != '') ? ' hasText' : '').'" title="'. JText::_($this->element['desc']) .'"><span>' . JText::_($text) . '</span></div>';
	}
}