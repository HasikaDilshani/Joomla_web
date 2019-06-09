<?php
defined('_JEXEC') or die;
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');
$output ='';
$jversion = new JVersion;
if (version_compare($jversion->getShortVersion(), '3.0.0', '<')){
$output .= '<div class="categories-list'.$this->pageclass_sfx.'">';
if ($this->params->get('show_page_heading')) :
$output .='<h1>'.$this->escape($this->params->get('page_heading')).'</h1>';
endif;
if ($this->params->get('show_base_description')) :
if($this->params->get('categories_description')) :
$output .= JHtml::_('content.prepare', $this->params->get('categories_description'), '', 'com_content.categories');
else:
if ($this->parent->description) :
$output .= '<div class="category-desc">'.JHtml::_('content.prepare', $this->parent->description, '', 'com_content.categories').'</div>';
endif;
endif;
endif;
$output .= '</div>';
$output .= $this->loadTemplate('items');
}else{
$output .= JLayoutHelper::render('joomla.content.categories_default', $this);
$output .= $this->loadTemplate('items').'</div>';
}
echo $output;
?>