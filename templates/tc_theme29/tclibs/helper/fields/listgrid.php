<?php
defined('JPATH_BASE') or die;
jimport('joomla.form.formfield');
class JFormFieldListgrid extends JFormField{
	protected $type = 'Listgrid';
	protected function getInput(){
		// Initialize some field attributes.
		$class = $this->element['class'] ? (string) $this->element['class'] : '';
		$disabled = ((string) $this->element['disabled'] == 'true') ? ' disabled="disabled"' : '';
		$columns = $this->element['cols'] ? ' cols="' . (int) $this->element['cols'] . '"' : '';
		$rows = $this->element['rows'] ? ' rows="' . (int) $this->element['rows'] . '"' : '';

		// Initialize JavaScript field attributes.
		$onchange = $this->element['onchange'] ? ' onchange="' . (string) $this->element['onchange'] . '"' : '';

		return '<div id="tcPosition'.$this->id.'" class="tcPosition tc-main-blocks '.$class.'"><textarea name="'.$this->name.'" data-name="'.str_replace('jform_params_','',$this->id).'" id="'.$this->id.'" '.$columns.$rows.$disabled.$onchange.'>'
			. htmlspecialchars($this->value, ENT_COMPAT, 'UTF-8') . '</textarea></div>';
	}
}
