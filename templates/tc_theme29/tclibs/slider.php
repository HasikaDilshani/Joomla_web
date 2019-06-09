<?php
/**
* @subpackage  tc_theme29 Template
*/

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();//define path
$base_url = $this->baseurl;
$tpl_name = $this->template;

$caption         = $this->params->get ('caption');
$menu            = $this->params->get ('menu');
$slides          = $this->params->get('slides');
$shadows         = $this->params->get('shadows');
$headHeigh	     = $this->params->get('headHeigh');
$bannerTime	     = $this->params->get('bannerTime');
$socialCode         = $this->params->get ('socialCode');
$jukenburn_thumb1 	= $this->params->get('jukenburn_thumb1', '' );
$jukenburn_thumb2 	= $this->params->get('jukenburn_thumb2', '' );
$jukenburn_thumb3 	= $this->params->get('jukenburn_thumb3', '' );
$jukenburn_thumb4 	= $this->params->get('jukenburn_thumb4', '' );
$jukenburn_thumb5 	= $this->params->get('jukenburn_thumb5', '' );
$jukenburn_thumb6 	= $this->params->get('jukenburn_thumb6', '' );


(($this->countModules('slider') && $slides == 2) || ($slides == 1) ?

$tcParams .= '<div id="slideshow" class="slideshow">
<div id="slider_wrapper" class="slider_wrapper fullwidthbanner-container" >
<div id="rev-slider" class="rev_slider fullwidthabanner">
<ul>'
.($jukenburn_thumb1 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb1.'">' : '')
.($jukenburn_thumb1 ? '</li>' : '')

.($jukenburn_thumb2 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb2.'">' : '')
.($jukenburn_thumb2 ? '</li>' : '')

.($jukenburn_thumb3 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb3.'">' : '')
.($jukenburn_thumb3 ? '</li>' : '')

.($jukenburn_thumb4 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb4.'">' : '')
.($jukenburn_thumb4 ? '</li>' : '')

.($jukenburn_thumb5 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb5.'">' : '')
.($jukenburn_thumb5 ? '</li>' : '')

.($jukenburn_thumb6 ? '<li data-transition="random" data-slotamount="7" data-masterspeed="1000" > <img src="'.$jukenburn_thumb6.'">' : '')
.($jukenburn_thumb1 ? '</li>' : '').


'</ul>
</div>
</div>' : '')

?>      