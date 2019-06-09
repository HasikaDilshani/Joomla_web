<?php
defined('JPATH_BASE') or die();
jimport('joomla.html.html');
jimport('joomla.form.formfield');
require_once dirname(dirname(__FILE__)).'/positions.php';
class JFormFieldGridscript extends JFormField
{   
protected $type = 'Gridscript';
protected function getInput()
{ 
$doc = JFactory::getDocument();
$template = $this->form->getValue('template');
$jversion = new JVersion;
if (version_compare($jversion->getShortVersion(), '3.0.0', '<')){
$doc->addScript(JURI::root().'templates/'.$template.'/tclibs/helper/jquery-1.7.2.min.js');
}else{
$doc->addStyleSheet(JURI::root().'media/jui/css/chosen.css');
$doc->addScript(JURI::root().'media/jui/js/chosen.jquery.min.js');
$doc->addScriptDeclaration( 'jQuery.noConflict(); jQuery(document).ready(function() {jQuery("#jform_params_menutype, .tc-chosen-select").chosen();});' );
}
$doc->addScript(JURI::root().'templates/'.$template.'/tclibs/helper/jquery-custom.min.js');
$doc->addScript(JURI::root().'templates/'.$template.'/tclibs/helper/jquery-eFuncDr.js');
$doc->addScriptDeclaration("jQuery.noConflict(); jQuery(document).ready(function() {jQuery('.tcPosition').eFuncDr({popupTitle: 'Edit', popupContent: '".SelectLayout::getPositions()."'});});");
$doc->addStyleSheet(JURI::root().'templates/'.$template.'/tclibs/helper/style.css');

$html = array();
$class = $this->element['class'] ? ' class="tcScript '.(string) $this->element['class'].'"' : '';
$html[] = '<div id="'.$this->id.'"'.$class.'>
<div class="alert alert-warning">Based on Bootstrap Grid, you can add up to 6 module positions to a spotlight area which can be resized by adjusting the resizer bar to the left/right.<br/>You can change the module position by clicking on the configuration icon on the top right.</div><div id="tcblocked"> </div>
<script type="text/javascript">
jQuery.noConflict();
jQuery(document).ready(function() {';
$html[] = "jQuery('#style-form > div:first > fieldset').children(':not(ul)').hide();	
jQuery('.tcPosition', '#style-form').closest('.pane-slider, .control-group').addClass('tcLayout');
jQuery('.lbr, .lb', '#style-form').find('.block-grid:eq(1)').prepend('<div class=\"component\"><i>message</i>Component</div>');
jQuery('.br', '#style-form').find('.block-grid:eq(0)').prepend('<div class=\"component\"><i>message</i>Component</div>');
jQuery('.lbr', '#style-form').find('.block-grid:eq(2)').addClass('right-block');
jQuery('.'+jQuery('#jform_params_layout option:checked').attr('value')).show();
jQuery('#jform_params_layout').change(function(){jQuery('.main-content').hide();jQuery('.'+jQuery(this).val()).show();});
jQuery('.logo1,.logo2', '#style-form').closest('li, .control-group').hide(); 
jQuery('#jform_params_layoutscript', '#style-form').parent().addClass('tc-alert');
jQuery('.logoType > input', '#style-form').click(function(){jQuery('.logo1,.logo2', '#style-form').closest('li, .control-group').hide(); 		jQuery('.logo'+jQuery(this).val()).closest('li, .control-group').show();});";
$html[] = '});</script></div>';
return implode($html);
}
}
