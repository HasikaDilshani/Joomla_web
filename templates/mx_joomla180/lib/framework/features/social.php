<?php
/*---------------------------------------------------------------
# Package - Joomla Template based on Sboost Framework   
# ---------------------------------------------------------------
# Author - mixwebtemplates http://www.mixwebtemplates.com
# Copyright (C) 2010 - 2015 mixwebtemplates.com. All Rights Reserved.
# Website: http://www.mixwebtemplates.com 
-----------------------------------------------------------------*/
//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
// URL for Social API
$cur_url = (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];
$cur_url = preg_replace('@%[0-9A-Fa-f]{1,2}@mi', '', htmlspecialchars($cur_url, ENT_QUOTES, 'UTF-8'));

?>
			<?php if(
				$this->getParam('social_api_type', '1') == '1' && 
				(
					$this->getParam('popup_fb', '1') == '1' ||
					$this->getParam('popup_twitter', '1') == '1' ||
					$this->getParam('popup_gplus', '1') == '1' ||
					$this->getParam('popup_pinterest', '1') == '1' ||
					$this->getParam('popup_linkedin', '0') == '1' ||
					$this->getParam('popup_digg', '0') == '1' ||
					$this->getParam('popup_vk', '0') == '1' || 
					$this->getParam('popup_stumbleupon', '0') == '1'
				)
			) : ?>
			<div id="soc_div">	
			<span class="item-social-icons">
				
				<?php if($this->getParam('popup_fb', '1') == '1') : ?>
				<a href="https://www.facebook.com/sharer.php?u=<?php echo $cur_url; ?>" target="_blank" title="Facebook" class="facebook icon-share-popup"><i class="fa fa-facebook"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_twitter', '1') == '1') : ?>
				<a href="http://twitter.com/intent/tweet?source=sharethiscom&amp;url=<?php echo $cur_url; ?>" target="_blank" title="Twitter" class="twitter icon-share-popup"><i class="fa fa-twitter"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_gplus', '1') == '1') : ?>
				<a href="https://plus.google.com/share?url=<?php echo $cur_url; ?>" target="_blank" title="Google+" class="google icon-share-popup"><i class="fa fa-google-plus"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_pinterest', '1') == '1') : ?>
				<a href="javascript:void((function()%7Bvar%20e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e)%7D)());" title="Pinterest" class="pinterest  icon-share-popup"><i class="fa fa-pinterest-p"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_linkedin', '0') == '1') : ?>
				<a href="https://www.linkedin.com/cws/share?url=<?php echo $cur_url; ?>" target="_blank" title="LinkedIn" class="linkedin icon-share-popup"><i class="fa fa-linkedin"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_digg', '0') == '1') : ?>
				<a href="http://digg.com/submit?url=<?php echo $cur_url; ?>" target="_blank" title="digg" class="digg icon-share-popup"><i class="fa fa-digg"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_vk', '0') == '1') : ?>
				<a href="http://vkontakte.ru/share.php?url=<?php echo $cur_url; ?>" target="_blank" title="VK" class="vk icon-share-popup"><i class="fa fa-vk"></i></a>
				<?php endif; ?>
				
				<?php if($this->getParam('popup_stumbleupon', '0') == '1') : ?>
				<a href="http://www.stumbleupon.com/badge/?url=<?php echo $cur_url; ?>" target="_blank" title="stumbleupon" class="stumbleupon icon-share-popup"><i class="fa fa-stumbleupon"></i></a>
				<?php endif; ?>
			</span>
			</div>			
			<?php endif; ?>