<?php

/**
 * @package		K2
 */

// no direct access
defined('_JEXEC') or die;

?>

<?php

// no direct access
defined('_JEXEC') or die;

?>

<section id="k2Container" class="category itemListView tagsView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
	<?php if($this->params->get('show_page_title')): ?>
	<header>
		<h1 class="header"><?php echo $this->escape($this->params->get('page_title')); ?></h1>
	</header>
	<?php endif; ?>
	
	<?php if(count($this->items)): ?>
		<section class="itemList">
			<?php foreach($this->items as $item): ?>			
				<article class="itemView tc-clearfix">
					<?php if($item->params->get('tagItemImage') && !empty($item->imageLarge)): ?>
					<div class="itemImageBlock"> <a class="itemImage" href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>"> <img src="<?php echo $item->imageLarge; ?>" alt="<?php if(!empty($item->image_caption)) echo $item->image_caption; else echo $item->title; ?>" /> </a> </div>
					<?php endif; ?>
					
					<div class="itemBlock">
						<?php if($item->params->get('tagItemTitle')): ?>
						<header>
							<h2>
								<?php if ($item->params->get('tagItemTitleLinked')): ?>
								<a href="<?php echo $item->link; ?>"> <?php echo $item->title; ?> </a>
								<?php else: ?>
								<?php echo $item->title; ?>
								<?php endif; ?>
							</h2>
						</header>
						<?php endif; ?>
						
						<?php if(
							$item->params->get('tagItemCategory') ||
							$item->params->get('tagItemDateCreated')
						) : ?>
						<p class="itemInfoBlock">
							<?php if($item->params->get('tagItemDateCreated')): ?>
							<time datetime="<?php echo JHtml::_('date', $item->created, JText::_(DATE_W3C)); ?>" pubdate>
								<?php echo JHTML::_('date', $item->created, JText::_('j.m.Y')); ?>
							</time>
							<?php endif; ?>
							
							<?php if($item->params->get('tagItemCategory')) : ?>
							<span>
								<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
								<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
							</span>
							<?php endif; ?>
						</p>
						<?php endif; ?>
						
						<div class="itemBody">
							<?php if($item->params->get('tagItemIntroText')): ?>
							<div class="itemIntroText"> <?php echo $item->introtext; ?> </div>
							<?php endif; ?>
							
							<?php if ($item->params->get('tagItemReadMore')): ?>
							<a class="button button-border" href="<?php echo $item->link; ?>"> <?php echo JText::_('K2_READ_MORE'); ?> </a>
							<?php endif; ?>
						</div>
					</div>
				</article>
			<?php endforeach; ?>
		</section>
		
		<?php if($this->params->get('tagFeedIcon',1)): ?>
		<a class="k2FeedIcon" href="<?php echo $this->feed; ?>"><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></a>
		<?php endif; ?>
		
		<?php if($this->pagination->getPagesLinks()): ?>
		<?php echo str_replace('</ul>', '<li class="counter">'.$this->pagination->getPagesCounter().'</li></ul>', $this->pagination->getPagesLinks()); ?>
		<?php endif; ?>
	<?php endif; ?>
</section>
