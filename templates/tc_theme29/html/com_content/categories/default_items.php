<?php
defined('_JEXEC') or die;
$class = 'first';
$lang	= JFactory::getLanguage();
if (count($this->items[$this->parent->id]) > 0 && $this->maxLevelcat != 0) :
?>
<ul class="list-group">
<?php foreach($this->items[$this->parent->id] as $id => $item) : ?>
<?php
if ($this->params->get('show_empty_categories_cat') || $item->numitems || count($item->getChildren())) :
if (!isset($this->items[$this->parent->id][$id + 1]))
{
$class = 'last';
}
?>
<li class="list-group-item <?php echo $class; ?>" >
<?php $class = ''; ?>
<h3 class="panel-header item-title">
<a href="<?php echo JRoute::_(ContentHelperRoute::getCategoryRoute($item->id));?>">
<?php echo $this->escape($item->title); ?></a>
<?php if ($this->params->get('show_cat_num_articles_cat') == 1) :?>
<span class="badge badge-info pull-right">
<?php echo $item->numitems; ?>
</span>
<?php endif; ?>
<?php if (count($item->getChildren()) > 0) : ?>
<a href="#category-<?php echo $item->id;?>" data-toggle="collapse" data-toggle="button" class="btn btn-mini pull-right"><span class="icon-plus glyphicon glyphicon-cog"></span></a>
<?php endif;?>
</h3>
<?php if ($this->params->get('show_description_image') && $item->getParams()->get('image')) : ?>
<img src="<?php echo $item->getParams()->get('image'); ?>"/>
<?php endif; ?>
<?php if ($this->params->get('show_subcat_desc_cat') == 1) :?>
<?php if ($item->description) : ?>
<div class="category-desc">
<?php echo JHtml::_('content.prepare', $item->description, '', 'com_content.categories'); ?>
</div>
<?php endif; ?>
<?php endif; ?>
<?php if (count($item->getChildren()) > 0) :?>
<div id="category-<?php echo $item->id;?>">
<?php
$this->items[$item->id] = $item->getChildren();
$this->parent = $item;
$this->maxLevelcat--;
echo $this->loadTemplate('items');
$this->parent = $item->getParent();
$this->maxLevelcat++;
?>
</div>
<?php endif; ?>
</li>
<?php endif; ?>
<?php endforeach; ?>
</ul>
<?php endif; ?>