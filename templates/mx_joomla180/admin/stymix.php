<?php

defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');

class JFormFieldSTYMix extends JFormField{


	protected function getInput(){
		$doc = JFactory::getDocument();

		$doc->addStyleSheet(JURI::root().'templates/mx_joomla180/admin/css/style.css');
		$doc->addScript(JURI::root().'templates/mx_joomla180/admin/js/admin.js');
		$doc->addScript(JURI::root().'templates/mx_joomla180/admin/js/js.js');
	}
}
