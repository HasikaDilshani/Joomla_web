<?php

//no direct accees
defined ('_JEXEC') or die ('resticted aceess');
$app = JFactory::getApplication();
$doc = JFactory::getDocument(); 
$tpath = $this->baseurl.'/templates/'.$this->template;
$templateparams = &$app->getTemplate(true)->params;
$off_sitedate		= $this->params->get('off_sitedate');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap/css/bootstrap.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/TimeCircles.css" type="text/css" />
<style type="text/css">
.wrap{width:960px;background:#fff;margin:60px auto;padding:10px}
.offline_bg .wrap{background:#fff;text-shadow:1px 1px #FFF;max-width:740px;margin:5px auto;width: auto}
body,.offline_bg{background:#EFEFEF}
</style>
</head>

<body class="offline_bg">
	<div class="wrap">
	<jdoc:include type="message" />
	<div id="frame" class="outline">
<?php echo JHtml::_('content.prepare', $templateparams->get('off_content')); ?>
		<form action="<?php echo JRoute::_('index.php', true); ?>" method="post" name="login" id="form-login">
			
			<input type="text" id="username" name="username" class="inputbox" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" alt="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" required>
			<input type="password" id="password" name="password" class="inputbox" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" alt="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" required>
			<?php if (JPluginHelper::isEnabled('system', 'remember')) : ?>
			<div class="remember-field">
				<label id="remember-lbl" for="remember"><?php echo JText::_('JGLOBAL_REMEMBER_ME') ?></label>
				<input id="remember" type="checkbox" name="remember" class="inputbox" value="yes"  alt="<?php echo JText::_('JGLOBAL_REMEMBER_ME') ?>" />
			</div>
			<?php endif; ?>
			<input type="submit" id="loginBtn" class="btn" name="Submit" value="<?php echo JText::_('JLOGIN'); ?>">
			<input type="hidden" name="option" value="com_users" />
			<input type="hidden" name="task" value="user.login" />
			<input type="hidden" name="return" value="<?php echo base64_encode(JURI::base()); ?>" />
			<?php echo JHTML::_( 'form.token' ); ?>

		</form>
<?php if($this->params->get('off_sitedate',1)) : ?>
	<h3>Time until <?php echo JHtml::_('content.prepare', $templateparams->get('off_day')); ?>/<?php echo JHtml::_('content.prepare', $templateparams->get('off_month')); ?>/<?php echo JHtml::_('content.prepare', $templateparams->get('off_year')); ?></h3>
<div class="someTimer" data-date="<?php echo JHtml::_('content.prepare', $templateparams->get('off_year')); ?>-<?php echo JHtml::_('content.prepare', $templateparams->get('off_month')); ?>-<?php echo JHtml::_('content.prepare', $templateparams->get('off_day')); ?> 00:00:00" ></div>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script> 
<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/tclibs/helper/TimeCircles.js"></script> 
<script>
 var timeCircles = $(".someTimer").TimeCircles();
</script>
<?php endif; ?>
	</div>
	</div>
</body>
</html>
