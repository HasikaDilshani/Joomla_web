<?php
/**
 * @package		Joomla.Site
 * @subpackage	com_search
 * @copyright	Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 */

// no direct access
defined('_JEXEC') or die;
?>

<ul class="list-group search-results<?php echo $this->pageclass_sfx; ?>">
<?php foreach($this->results as $result) : ?>
<li class="list-group-item">
	<h4 class="result-title">
		<?php echo $this->pagination->limitstart + $result->count.'. ';?>
		<?php if ($result->href) :?>
			<a href="<?php echo JRoute::_($result->href); ?>"<?php if ($result->browsernav == 1) :?> target="_blank"<?php endif;?>>
				<?php echo $this->escape($result->title);?>
			</a>
		<?php else:?>
			<?php echo $this->escape($result->title);?>
		<?php endif; ?>
        
        <?php if ($result->section) : ?>
            <span class="result-category">
                <span class="small<?php echo $this->pageclass_sfx; ?>">
                    (<?php echo $this->escape($result->section); ?>)
                </span>
            </span>
        <?php endif; ?>
	</h4>
	
	<div class="result-text">
		<?php echo $result->text; ?>
        <?php if ($this->params->get('show_date')) : ?>
		<p><span class="result-created<?php echo $this->pageclass_sfx; ?>">
			<?php echo JText::sprintf('JGLOBAL_CREATED_DATE_ON', $result->created); ?>
		</span></p>
	<?php endif; ?>
	</div>
</li>    
<?php endforeach; ?>
</ul>

<div class="tc-pagination text-center">
	<?php echo $this->pagination->getPagesLinks(); ?>
</div>
