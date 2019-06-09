<?php
/**
 * @version    $Id$
 * @package    SUN Framework
 * @author     JoomlaShine Team <support@joomlashine.com>
 * @copyright  Copyright (C) 2012 JoomlaShine.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * Websites: http://www.joomlashine.com
 * Technical Support:  Feedback - http://www.joomlashine.com/contact-us/get-support.html
 */
// if (($this->error->getCode()) == '404') {
// header('Location: ' . $this->baseurl . '/index.php?option=com_content&view=article&id=119');
// exit;
// }
// No direct access to this file.
defined('_JEXEC') or die;


$sunfwParams = SunFwSite::getInstance();
$sunfwParams1 = json_encode($sunfwParams);
$sunfwParams1 = json_decode($sunfwParams1);
$custom_404_data = $sunfwParams1->custom_404_data;
?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet" />
<?php
if (!empty($custom_404_data) && (int) $custom_404_data->enabled && !empty($custom_404_data->article))
{
	SunFwSite::getInstance()->render('error', $this);
}else {
$app             = JFactory::getApplication();
$doc             = JFactory::getDocument();
$user            = JFactory::getUser();

$this->language  = $doc->language;
$this->direction = $doc->direction;

// Output document as HTML5.
if (is_callable(array($doc, 'setHtml5')))
{
    $doc->setHtml5(true);
}


// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option   = $app->input->getCmd('option', '');
$view     = $app->input->getCmd('view', '');
$layout   = $app->input->getCmd('layout', '');
$task     = $app->input->getCmd('task', '');
$itemid   = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if($task == "edit" || $layout == "form" )
{
    $fullWidth = 1;
}
else
{
    $fullWidth = 0;
}

$image_404_path = $this->baseurl . '/templates/' . $this->template . "/images/404.png";

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo $this->title; ?> <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php // Use of Google Font ?>
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/bootstrap.css" rel="stylesheet" />
    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/css/template.css" rel="stylesheet" />
    
    <?php if ($app->get('debug_lang', '0') == '1' || $app->get('debug', '0') == '1') : ?>
        <link href="<?php echo JUri::root(true); ?>/media/cms/css/debug.css" rel="stylesheet" />
    <?php endif; ?>

    <link href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" rel="shortcut icon" type="image/vnd.microsoft.icon" />

</head>
<body class="site <?php echo $option
    . ' view-' . $view
    . ($layout ? ' layout-' . $layout : ' no-layout')
    . ($task ? ' task-' . $task : ' no-task')
    . ($itemid ? ' itemid-' . $itemid : '')
    . ($params->get('fluidContainer') ? ' fluid' : '');
?>">
<!-- Body -->
<div class="body jsn-error-page">
    <div class="jsn-error-inner sunfw-content">
        <div class="container">
                    <!-- Begin Content -->
            <div class="table">
                <div class="table-cell">
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <img src="<?php echo $image_404_path; ?>" alt="Error 404" />
                        </div>     
                        <div class="col-xs-12 col-md-6"> 
                            <div class="content-inner">       
                                <div class="content-info">                                
                                    <h3>Oops ! <?php echo htmlspecialchars($this->error->getMessage(), ENT_QUOTES, 'UTF-8');?> </h3>
                                    <p><?php echo JText::_('JERROR_LAYOUT_PLEASE_CONTACT_THE_SYSTEM_ADMINISTRATOR'); ?><a href="<?php echo JUri::base();?>"><?php echo ' '.JText::_('TPL_GO_TO_HOME');?></a></p>                              
                                </div>  
                                <div class="content-action">                           
                                    <div class="jsn-search">
                                        <?php echo $doc->getBuffer('modules', 'search-404', array('style' => 'xhtml')); ?>
                                    </div> 
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
                    <!-- End Content -->
        </div>
    </div>
</div>
<?php echo $doc->getBuffer('modules', 'debug', array('style' => 'none')); ?>
</body>
</html>
<?php
}
?>