<?php

/**
 * @package		K2

 */

// no direct access
defined('_JEXEC') or die;

?>

<section id="k2Container" class="category itemListView genericView<?php if($this->params->get('pageclass_sfx')) echo ' '.$this->params->get('pageclass_sfx'); ?>">
          <?php if($this->params->get('show_page_title') || JRequest::getCmd('task')=='search' || JRequest::getCmd('task')=='date'): ?>
          <header>
               <h1><?php echo $this->escape($this->params->get('page_title')); ?></h1>
          </header>
          <?php endif; ?>
          <?php if(JRequest::getCmd('task')=='search' && $this->params->get('googleSearch')): ?>
          <!-- Google Search container -->
          <div id="<?php echo $this->params->get('googleSearchContainer'); ?>"></div>
          <?php endif; ?>
          <?php if(count($this->items)): ?>
          <div class="itemList">
                <?php foreach($this->items as $item): ?>
                <article class="itemView tc-clearfix">
                     <?php if($this->params->get('genericItemImage') && !empty($item->imageGeneric)): ?>
                     <div class="itemImageBlock">
                         <a class="itemImage" href="<?php echo $item->link; ?>" title="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>"> 
                         	<img src="<?php echo $item->imageGeneric; ?>" alt="<?php if(!empty($item->image_caption)) echo K2HelperUtilities::cleanHtml($item->image_caption); else echo K2HelperUtilities::cleanHtml($item->title); ?>" style="width:<?php echo $this->params->get('itemImageGeneric'); ?>px; height:auto;" />
                         </a>
                     </div>
                     <?php endif; ?>
                     
                     <div class="itemBlock">     
                          <?php if($this->params->get('genericItemTitle')): ?>
                          <header>
                                <h2>
                                      <?php if ($this->params->get('genericItemTitleLinked')): ?>
                                      <a href="<?php echo $item->link; ?>"><?php echo $item->title; ?></a>
                                      <?php else: ?>
                                      <?php echo $item->title; ?>
                                      <?php endif; ?>
                                </h2>
                           </header>
                           <?php endif; ?>
                            
                           <?php if(
                           		$this->params->get('genericItemCategory') ||
                           		$item->params->get('genericItemDateCreated')
                           ): ?>
                           <p class="itemInfoBlock">
	                           <?php if($item->params->get('genericItemDateCreated')): ?>
	                           <time datetime="<?php echo JHtml::_('date', $item->created, JText::_(DATE_W3C)); ?>" pubdate>
	                           	<?php echo JHTML::_('date', $item->created, JText::_('j.m.Y')); ?>
	                           </time>
	                           <?php endif; ?>
	                           
	                           <?php if($this->params->get('genericItemCategory')) : ?>
	                           <span>	
	                           		<span><?php echo JText::_('K2_PUBLISHED_IN'); ?></span>
	                           		<a href="<?php echo $item->category->link; ?>"><?php echo $item->category->name; ?></a>
	                           </span>
	                           <?php endif; ?>
						   </p>
						   <?php endif; ?>

                            <div class="itemBody">
	                            <?php if($this->params->get('genericItemIntroText')): ?>
	                            <div class="itemIntroText">
	                            	<?php echo $item->introtext; ?>
	                            </div>
	                            <?php endif; ?>
	                            
	                            <?php if ($this->params->get('genericItemReadMore')): ?>
	                            <a class="button button-border" href="<?php echo $item->link; ?>">
	                            	<?php echo JText::_('K2_READ_MORE'); ?>
	                            </a>	
	                            <?php endif; ?>
                            </div>
                     </div>
                </article>
                <?php endforeach; ?>
          </div>
          
          <?php if(count($this->items) && $this->params->get('genericFeedIcon',1)): ?>
          <a class="k2FeedIcon" href="<?php echo $this->feed; ?>"><?php echo JText::_('K2_SUBSCRIBE_TO_THIS_RSS_FEED'); ?></a>
          <?php endif; ?>
          <?php if($this->pagination->getPagesLinks()): ?>
          <?php echo str_replace('</ul>', '<li class="counter">'.$this->pagination->getPagesCounter().'</li></ul>', $this->pagination->getPagesLinks()); ?>
          <?php endif; ?>
          <?php else: ?>
          <?php if(!$this->params->get('googleSearch')): ?>
          <!-- No results found -->
          <div id="genericItemListNothingFound">
                    <p><?php echo JText::_('K2_NO_RESULTS_FOUND'); ?></p>
          </div>
          <?php endif; ?>
          <?php endif; ?>
</section>
