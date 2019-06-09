<?php
jimport('joomla.filesystem.file');
jimport('joomla.filesystem.folder');
class SelectLayout
{
public static function getTplPositions($clientId = 0, $template = '')
{
$positions = array();
$templateBaseDir = $clientId ? JPATH_ADMINISTRATOR : JPATH_SITE;
$filePath        = JPath::clean($templateBaseDir . '/templates/' . $template . '/templateDetails.xml');
if (is_file($filePath)) {
$xml = simplexml_load_file($filePath);
if (!$xml) {
return false;
}
if ($xml->getName() != 'extension' && $xml->getName() != 'metafile') {
unset($xml);
return false;
}
$positions = (array) $xml->positions;
if (isset($positions['position'])) {
$positions = $positions['position'];

} else {
$positions = array();
}
}
return $positions;
}
public static function getPositions()
{
$path     = JPATH_SITE;
$lang     = JFactory::getLanguage();
$clientId = 0;
$state    = 1;
$templates      = array_keys(self::getTemplates($clientId, $state));
$templateGroups = array();
// Add positions from templates
foreach ($templates as $template) {
$options = array();
$positions = self::getTplPositions($clientId, $template);
if (is_array($positions))
foreach ($positions as $position) {
$text      = self::getTranslatedModulePosition($clientId, $template, $position) . ' [' . $position . ']';
$options[] = self::createOption($position, $text);
}
$templateGroups[$template] = self::createOptionGroup(ucfirst($template), $options);
}
// Add custom position to options
$customGroupText                  = JText::_('Custom positions');
$customPositions                  = self::getDbPositions($clientId);
$templateGroups[$customGroupText] = self::createOptionGroup($customGroupText, $customPositions);
return '<fieldset class="visibleDevaices"><legend>Hidden on</legend><input type="checkbox"/><span>Desktop</span><input type="checkbox"/><span>Tablet</span><input type="checkbox"/><span>Phone</span></fieldset>'.str_replace(array("\r\n", "\r", "\n"), "", trim(JHtml::_('select.groupedlist', $templateGroups, '', array(
'id' => 'tpl-positions-list',
'list.select' => '',
'list.attr' => 'multiple="multiple" size="10"'
)))).'<div class="classSuffix">Class Suffix<input class="inputClass" /></div><button class="none">'.JText::_("JCANCEL").'</button><button class="save">'.JText::_("JAPPLY").'</button>';
}
public static function getDbPositions($clientId)
{
$db    = JFactory::getDbo();
$query = $db->getQuery(true)
->select('DISTINCT(position)')
->from('#__modules')
->where($db->quoteName('client_id') . ' = ' . (int) $clientId)->order('position');
$db->setQuery($query);
try {
$positions = $db->loadColumn();
$positions = is_array($positions) ? $positions : array();
}
catch (RuntimeException $e) {
JError::raiseWarning(500, $e->getMessage());
return;
}
// Build the list
$options = array();
foreach ($positions as $position) {
if ($position) {
$options[] = JHtml::_('select.option', $position, $position);
}
}
return $options;
}
public static function createOption($value = '', $text = '')
{
if (empty($text)) {
$text = $value;
}
$option        = new stdClass;
$option->value = $value;
$option->text  = $text;
return $option;
}
public static function createOptionGroup($label = '', $options = array())
{
$group          = array();
$group['value'] = $label;
$group['text']  = $label;
$group['items'] = $options;
return $group;
}
public static function isTranslatedText($langKey, $text)
{
return $text !== $langKey;
}
public static function getTranslatedModulePosition($clientId, $template, $position)
{
// Template translation
$lang = JFactory::getLanguage();
$path = $clientId ? JPATH_ADMINISTRATOR : JPATH_SITE;
$lang->load('tpl_' . $template . '.sys', $path, null, false, false) 
|| $lang->load('tpl_' . $template . '.sys', $path . '/templates/' . $template, null, false, false) 
|| $lang->load('tpl_' . $template . '.sys', $path, $lang->getDefault(), false, false) 
|| $lang->load('tpl_' . $template . '.sys', $path . '/templates/' . $template, $lang->getDefault(), false, false);
$langKey = strtoupper('TPL_' . $template . '_POSITION_' . $position);
$text    = JText::_($langKey);
// Avoid untranslated strings
if (!self::isTranslatedText($langKey, $text)) {
// Modules component translation
$langKey = strtoupper('COM_MODULES_POSITION_' . $position);
$text    = JText::_($langKey);
// Avoid untranslated strings
if (!self::isTranslatedText($langKey, $text)) {
// Try to humanize the position name
$text = ucfirst(preg_replace('/^' . $template . '\-/', '', $position));
$text = ucwords(str_replace(array(
'-',

'_'
), ' ', $text));
}
}
return $text;
}
public static function getTemplates($clientId = 0, $state = '', $template = '')
{
$db = JFactory::getDbo();
// Get the database object and a new query object.
$query = $db->getQuery(true);
// Build the query.
$query
->select('element, name, enabled')
->from('#__extensions')
->where('client_id = ' . (int) $clientId)
->where('type = ' . $db->quote('template'));
if ($state != '') {
$query->where('enabled = ' . $db->quote($state));
}
if ($template != '') {
$query->where('element = ' . $db->quote($template));
}
// Set the query and load the templates.
$db->setQuery($query);
$templates = $db->loadObjectList('element');
return $templates;
}
}