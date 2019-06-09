<?php /**  * @copyright	Copyright (C) 2012 AJoomlaTemplates.com - All Rights Reserved. **/ defined( '_JEXEC' ) or die( 'Restricted access' ); ?>
<script>
	 jQuery(function() {
      jQuery("<select />").appendTo("nav");
      jQuery("<option />", {
         "selected": "selected",
         "value"   : "",
         "text"    : "Select page..."
      }).appendTo("nav select");
      jQuery("nav a").each(function() {
       var el = $(this);
       jQuery("<option />", {
           "value"   : el.attr("href"),
           "text"    : el.text()
       }).appendTo("nav select");
      });
      jQuery("nav select").change(function() {
        window.location = $(this).find("option:selected").val();
      });
	 
	 });
</script>
<body class="mobile">
<div id="header-w">
    <div id="header-m">
    <?php if ($logotype == 'image' ) : ?>
    <?php if ($logo != null ) : ?>
    <div class="logo"><a href="<?php echo $this->baseurl ?>"><img src="<?php echo $this->baseurl ?>/<?php echo htmlspecialchars($logo); ?>" alt="<?php echo htmlspecialchars($templateparams->get('sitetitle'));?>" /></a></div>
    <?php else : ?>
    <div class="logo"><a href="<?php echo $this->baseurl ?>/"><img src="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/images/logo.png" border="0"></a></div>
    <?php endif; ?><?php endif; ?>
        	<?php if ($this->countModules('menu')) : ?>
        	<nav><div id="navr"><div id="navl"><div id="nav">
		    	<jdoc:include type="modules" name="menu" style="none" />  
            </div></div></div></nav>
        	<?php endif; ?>    
	</div>            
</div>
<div id="main">  
	<div id="wrapper-w"><div id="wrapper-m">  
        <div id="comp-w">
						<?php if ($this->countModules('user1-m')) : ?>
                                <div id="user1" class="row-fluid">
                                    <jdoc:include type="modules" name="user1-m" style="ajgrid" grid="<?php echo $user2_width; ?>" />
                                    <div class="clr"></div> 
                                </div>
                        <?php endif; ?>      
                        <div id="comp" class="row-fluid">
                            <div id="comp-i">
                            	<jdoc:include type="message" />
                                <jdoc:include type="component" />
                                <div class="clr"></div>                              
                            </div>
                        </div>                                            
						<?php if ($this->countModules('user2-m')) : ?>
                                <div id="user2" class="row-fluid">
                                    <jdoc:include type="modules" name="user2-m" style="ajgrid" grid="<?php echo $user3_width; ?>" />
                                    <div class="clr"></div> 
                                </div>
                        <?php endif; ?> 
        
        </div>
		<div class="clr"></div>
        </div>
  </div></div>
</div>
<div id="footer-m"><div id="footer">
        <?php if ($this->countModules('copyright')) : ?>
            <div class="copy">
                <jdoc:include type="modules" name="copyright"/>
            </div>
        <?php endif; ?>
<div class="clr"></div>
</div></div>
<jdoc:include type="modules" name="debug" style="none" />
</body>