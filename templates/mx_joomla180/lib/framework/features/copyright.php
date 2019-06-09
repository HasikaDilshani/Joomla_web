<?php
/*---------------------------------------------------------------
# Package - Sboost Framework  
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2015 mixwebtemplates.com. All Rights Reserved. 
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
if ($this->getParam('showcp')) {
echo JText::_('JU') . ' &copy; ' . $this->getParam('copyright'); 
}
echo '<span class="designed_by">Designed by <a target="_blank" title="mixwebtemplates" href="http://www.mixwebtemplates.com">mixwebtemplates</a><br /></span>';
