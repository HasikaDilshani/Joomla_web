<?php

/**
 * @package		K2

 */

// no direct access
defined('_JEXEC') or die;

?>

<article class="itemView tc-clearfix">
	<?php if($this->item->params->get('latestItemImage') && !empty($this->item->image)): ?>
	<div class="itemImageBlock">
	   	<a class="itemImage" href="<?php echo $this->item->link; ?>" title="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>">
			<img src="<?php echo $this->item->image; ?>" alt="<?php if(!empty($this->item->image_caption)) echo K2HelperUtilities::cleanHtml($this->item->image_caption); else echo K2HelperUtilities::cleanHtml($this->item->title); ?>" style="width:<?php echo $this->item->imageWidth; ?>px;height:auto;" />
		</a>
	</div>
	<?php endif; ?>
	
	<div class="itemBlock">
		<?php echo $this->item->event->BeforeDisplay; ?>
		<?php echo $this->item->event->K2BeforeDisplay; ?>
		
		<?php if($this->item->params->get('latestItemTitle')): ?>
		<header>			
			<h2>
				<?php if ($this->item->params->get('latestItemTitleLinked')): ?>
					<a href="<?php echo $this->item->link; ?>"><?php echo $this->item->title; ?></a>
				<?php else: ?>
					<?php echo $this->item->title; ?>
				<?php endif; ?>
			</h2>
	  	</header>
	  	<?php endif; ?>
	
	  	<?php echo $this->item->event->AfterDisplayTitle; ?>
	  	<?php echo $this->item->event->K2AfterDisplayTitle; ?>
	  	
	  	<?php if(
	  		$this->item->params->get('latestItemCategory') ||
	  		$this->item->params->get('latestItemDateCreated')
	  	) : ?>
	  	<p class="itemInfoBlock">
	  		<?php if($this->item->params->get('latestItemDateCreated')): ?>
	  		<time datetime="<?php echo JHtml::_('date', $this->item->created, JText::_(DATE_W3C)); ?>" pubdate>
	  			<?php echo JHTML::_('date', $this->item->created, JText::_('j,m.Y')); ?>
	  		</time>
	  		<?php endif; ?>
	  		
	  		<?php if($this->item->params->get('latestItemCategory')) : ?>
	  		<span>
	  			<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
	  			<a href="<?php echo $this->item->category->link; ?>"><?php echo $this->item->category->name; ?></a>
	  		</span>
	  		<?php endif; ?>
	  	</p>
	  	<?php endif; ?>
	
		<div class="itemBody">
			<?php echo $this->item->event->BeforeDisplayContent; ?>
		  	<?php echo $this->item->event->K2BeforeDisplayContent; ?>
	
		  	<?php if($this->item->params->get('latestItemIntroText')): ?>
		  	<div class="itemIntroText">
		  		<?php echo $this->item->introtext; ?>
		  	</div>
		  	<?php endif; ?>
	
		  	<?php echo $this->item->event->AfterDisplayContent; ?>
		  	<?php echo $this->item->event->K2AfterDisplayContent; ?>
		  
		  	<?php if ($this->item->params->get('latestItemReadMore')): ?>
		  	<a class="button" href="<?php echo $this->item->link; ?>">
		  		<?php echo JText::_('K2_READ_MORE'); ?>
		  	</a>
		  	<?php endif; ?>
	  	</div>
	
		<?php echo $this->item->event->AfterDisplay; ?>
	  	<?php echo $this->item->event->K2AfterDisplay; ?>
	</div>
</article>