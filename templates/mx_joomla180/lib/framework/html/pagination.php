<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Sboost Framework   
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2008 - 2015 mixwebtemplates.com. All Rights Reserved.
# Websites: http://www.mixwebtemplates.com
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');

function pagination_list_render($list) {
	// Reverse output rendering for right-to-left display.
	$html = '<ul>';
	$html .= '<li class="pagination-start">' . $list['start']['data'] . '</li>';
	$html .= '<li class="pagination-prev">' . $list['previous']['data'] . '</li>';
	foreach ($list['pages'] as $page)
	{
		$html .= '<li>' . $page['data'] . '</li>';
	}
	$html .= '<li class="pagination-next">' . $list['next']['data'] . '</li>';
	$html .= '<li class="pagination-end">' . $list['end']['data'] . '</li>';
	$html .= '</ul>';
	return $html;
}

function pagination_item_active(&$item) {
	return "<a title=\"" . $item->text . "\" href=\"" . $item->link . "\" class=\"pagenav\">" . $item->text . "</a>";
}

function pagination_item_inactive(&$item) {
	return "<span class=\"pagenav\">" . $item->text . "</span>";
}