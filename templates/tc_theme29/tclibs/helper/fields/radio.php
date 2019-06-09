<?php
/**
 * @package     Joomla.Platform
 * @subpackage  Form
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */
defined('JPATH_PLATFORM') or die;
class JFormFieldRadio extends JFormField
{
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