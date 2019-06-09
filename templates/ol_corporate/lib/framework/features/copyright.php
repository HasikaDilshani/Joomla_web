<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - olwebdesign http://www.olwebdesign.com
# Copyright (C) 2008 - 2017 olwebdesign.com. All Rights Reserved. 
# Websites: http://www.olwebdesign.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
if ($this->getParam('showcp')) {
echo JText::_('JU') . ' &copy; ' . $this->getParam('copyright'); 
}
echo '<span class="designed_by">Designed by <a target="_blank" title="olwebdesign" href="http://www.olwebdesign.com">olwebdesign</a><br /></span>';
