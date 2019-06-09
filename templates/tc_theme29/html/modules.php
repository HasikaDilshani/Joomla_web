<?php
/**
 * @copyright	Copyright (C) 2008 - 2009  All rights reserved.
 * @license		
 */// no direct accessdefined('_JEXEC') or die('Restricted access');function modChrome_tc_xhtml($module, $params, $attribs){ ?><div class="module <?php echo $params->get('moduleclass_sfx'); ?>">	<div class="mod-wrapper">		<?php if ($module->showtitle != 0) { ?><h3 class="header">	<?php echo '<span>'.$module->title.'</span>'; ?> </h3><?php } ?><div class="mod-content clearfix">	<?php echo $module->content; ?></div></div></div><div style="clear:both;"></div><?php}