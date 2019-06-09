<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
defined('JPATH_PLATFORM') or die;
class JFormFieldRadio extends JFormField
{protected $type = 'Radio';protected function getInput(){$html = array();// Initialize some field attributes.$class     = !empty($this->element['class']) ? ' class="radio btn-group btn-group-yesno ' . $this->element['class'] . '"' : ' class="radio btn-group btn-group-yesno"';$required  = $this->required ? ' required aria-required="true"' : '';$autofocus = $this->autofocus ? ' autofocus' : '';$disabled  = $this->disabled ? ' disabled' : '';$readonly  = $this->readonly;// Start the radio field output.$html[] = '<fieldset id="' . $this->id . '"' . $class . $required . $autofocus . $disabled . ' >';// Get the field options.$options = $this->getOptions();// Build the radio field output.foreach ($options as $i => $option){// Initialize some option attributes.$checked = ((string) $option->value == (string) $this->value) ? ' checked="checked"' : '';$class = !empty($option->class) ? ' class="' . $option->class . '"' : '';$disabled = !empty($option->disable) || ($readonly && !$checked);$disabled = $disabled ? ' disabled' : '';// Initialize some JavaScript option attributes.$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';$onchange = !empty($option->onchange) ? ' onchange="' . $option->onchange . '"' : '';$html[] = '<input type="radio" id="' . $this->id . $i . '" name="' . $this->name . '" value="'. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $required . $onclick. $onchange . $disabled . ' />';$html[] = '<label for="' . $this->id . $i . '"' . $class . ' >'. JText::alt($option->text, preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->fieldname)) . '</label>';$required = '';}// End the radio field output.$html[] = '</fieldset>';return implode($html);}protected function getOptions()
	{
		$options = array();
		foreach ($this->element->children() as $option)
		{
			// Only add <option /> elements.
			if ($option->getName() != 'option')
			{
				continue;
			}
			$disabled = (string) $option['disabled'];
			$disabled = ($disabled == 'true' || $disabled == 'disabled' || $disabled == '1');
			// Create a new option object based on the <option /> element.
			$tmp = JHtml::_(
				'select.option', (string) $option['value'], trim((string) $option), 'value', 'text',
				$disabled
			);
			// Set some option attributes.
			$tmp->class = (string) $option['class'];
			// Set some JavaScript option attributes.
			$tmp->onclick = (string) $option['onclick'];
			$tmp->onchange = (string) $option['onchange'];
			// Add the option object to the result set.
			$options[] = $tmp;
		}
		reset($options);
		return $options;
	}
}
