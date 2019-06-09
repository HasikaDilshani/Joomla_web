<?php
defined('JPATH_BASE') or die();
class JFormFieldListposition extends JFormField
{
protected $type = 'Listposition';
protected function getInput()
{
$db = JFactory::getDBO();
$query = 'SELECT `position` FROM `#__modules` WHERE  `client_id`=0 AND ( `published` !=-2 AND `published` !=0 ) GROUP BY `position` ORDER BY `position` ASC';
$db->setQuery($query);
$dbpositions = (array) $db->loadAssocList();
$template = $this->form->getValue('template');
$templateXML = JPATH_SITE.'/templates/'.$template.'/templateDetails.xml';
$template = simplexml_load_file( $templateXML );
$options = array();
foreach($dbpositions as $positions) $options[] = $positions['position'];
foreach($template->positions[0] as $position)  $options[] =  (string) $position;
$options = array_unique($options);
$selectOption = array();
sort($selectOption);
foreach($options as $option) $selectOption[] = JHTML::_( 'select.option',$option,$option );
return JHTML::_('select.genericlist', $selectOption, $this->name, 'class="tc-chosen-select '.$this->element['class'].'"', 'value', 'text', $this->value, $this->id);
}
}
