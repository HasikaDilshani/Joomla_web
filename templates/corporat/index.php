<?php
/****************************************************
#####################################################
##-------------------------------------------------##
##                CORPORAT                         ##
##-------------------------------------------------##
## Copyright = globbersthemes.com- 2012            ##
## Date      = DECEMBRE 2012                       ##
## Author    = globbers                            ##
## Websites  = http://www.globbersthemes.com       ##
## version (joomla)                                ##
##                                                 ##
#####################################################
****************************************************/

// no direct access
defined('_JEXEC') or die('Restricted access');


?>

  
  <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
  <html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" >
  <head>		
  <jdoc:include type="head" />
  
  <?php           
  $mod_right = $this->countModules( 'position-7' );        
  if ( $mod_right ) { $width = '';         } else { $width = '-full';}        
  ?>
  
  <?php          
  $mod_right = $this->countModules( 'position-7' );        
  if ( $mod_right ) { $width = '';        
  } else { $width = '-full';}        
  ?>  
  
  <?php          
  $text1 = $this->params->get("text1", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent faucibus semper. ");         
  $text2 = $this->params->get("text2", "Maecenas a accumsan felis. Praesent scelerisque volutpat egestas.");		
  $text3 = $this->params->get("text3", "Pellentesque varius, tortor nec ultricies pretium, odio est gravida dolor, et rutrum erat. ");      
  $slidedisable	= $this->params->get("slidedisable");  ?> 

  <?php         
  $title1 = $this->params->get("title1", "01.news and features");          
  $title2  = $this->params->get("title2", "02.about corporat");		
  $title3  = $this->params->get("title3", "03.work and notes");		 
  $title4  = $this->params->get("title4", "04.club events");		 
  $title5  = $this->params->get("title5", "05.latest news");          
  ?>						 

  <?php		 
  JHtml::_('behavior.framework', true);
  $app = JFactory::getApplication();
  $templateparams     = $app->getTemplate(true)->params;  $csite_name	= $app->getCfg('sitename');
  ?>	 

  <link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/defaut.css" type="text/css" />		
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/scroll.js"></script>		 
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/jquery.js"></script>         
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/superfish.js"></script>       
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/hover.js"></script>		 
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/innerfade.js"></script>		
  <script type="text/javascript" src="templates/<?php echo $this->template ?>/js/faded.js"></script>
  
  <script type="text/javascript">				      
  $(document).ready(function() {	     
  $(' .navigation ul  ').superfish({		  
  delay:       800,                            		 
  animation:   {opacity:'show',height:'show'},  		
  speed:       'normal',                          		
  autoArrows:  false,                           		 
  dropShadows: false                            	 
  });	    });    
  </script> 	

  <script type="text/javascript">	   
  $(document).ready(				
  function(){					
  $('#news').innerfade({					
  animationtype: 'slide',					
  speed: 750,						
  timeout: 2000,					
  type: 'random',						
  containerheight: '1em'					
  });								
  });  	 
  </script>   
  
  <script type="text/javascript">	                           	                               
  $(function(){		                              
  $("#faded").faded({			                         
  speed: 4000,			                                 
  crossfade: true,			                             
  autoplay: 5000,			                             
  autorestart: 500,			                              
  autopagination:false		                             
  });	                              
  });  
  </script> 
  
  </head>
  <body>   
 <div id="header">       
    <div class="pagewidth">           
	    <div id="header-top">		                
		    <div id="sitename">	                                
			    <a href="index.php"><img  src="templates/<?php echo $this->template ?>/images/logo.png" width="353" height="62" alt="logotype" /></a>			               
			</div>				   
			    <div id="subscribe">					   
 				    <p>subcribe by <a href="#">rss</a> or <a href="#">email!!!</a></p> 					
				</div>		            
		</div>                
		    <div id="header-bottom">				    
			    <div id="topmenu">					    
				    <div class="navigation">                        	                                       
         				<jdoc:include type="modules" name="position-1" />                    	                               
 					</div>                       
					    <div id="search">						                                                                                      
						    <jdoc:include type="modules" name="position-0" />						                                                                          
						</div>												
				</div>                
			</div>	    
	</div>	
</div>	    
    <div class="pagewidth">            
	    <div id="sub-box">			    
		    <div id="hightlight">					
			    <div id="hightlight-t">HOT NEWS:</div>							                                                                  
				    <div id="hightlight-b">						                                                                               
					    <ul id="news">									                                                                                              
   					        <li><a href="#n1"><?php echo $text1 ?></a></li>	                                                                                      
							<li><a href="#n2"><?php echo $text2 ?></a></li>										                                 
							<li><a href="#n3"><?php echo $text3 ?></a></li>											                              
						</ul>						                                                                  
					</div>		               
			</div>                    
			    <div id="social-links">					    
				    <div id="facebook">					        
					    <a href="index.php"><img src="templates/<?php echo $this->template ?>/images/facebook.jpg" width="28" height="28" alt="facebook" /></a>						
					</div>						
					<div id="twitter">					       
					    <a href="index.php"><img src="templates/<?php echo $this->template ?>/images/twitter.jpg" width="28" height="28" alt="twitter" /></a>						
					</div>						
					<div id="google">					        
					    <a href="index.php"><img src="templates/<?php echo $this->template ?>/images/googleplus.jpg" width="28" height="28" alt="google" /></a>						
					</div>					
				</div>				           
		</div>	        
	</div> 		    
	    <?php $menu = JSite::getMenu(); ?>            
		<?php $lang = JFactory::getLanguage(); ?>            
		<?php if ($menu->getActive() == $menu->getDefault($lang->getTag())) { ?>           
		<?php if ($this->params->get( 'slidedisable' )) : ?>   <?php include "slideshow.php"; ?><?php endif; ?>           
		<?php } ?>

        
		
            <div class="pagewidth">
			    <?php if ($this->countModules('position-7')) { ?>
	                <div id="right">
	                    <jdoc:include type="modules" name="position-7" style="rounded" />
	                </div>
			    <?php } ?>
				    <div id="main<?php echo $width ?>">				                                                               
     				        <jdoc:include type="component" />
				        </div> 
            </div>
			
			<?php if ($this->countModules('position-3') || $this->countModules('position-4') || $this->countModules('position-6') || $this->countModules('position-8')) { ?>
        <div class="pagewidth">		
			<div id="wrapper-box">									                                                
				<div class="box">										                                                    
					<jdoc:include type="modules" name="position-3" style="xhtml" />									                                                
				</div>										                                            
			    <div class="box">										                                                    
					<jdoc:include type="modules" name="position-4" style="xhtml" />									                                                
				</div>										                                           
				<div class="box">										                                                    
					<jdoc:include type="modules" name="position-6" style="xhtml" />									                                                
				</div>											                                       
				<div class="box">										                                                    
					<jdoc:include type="modules" name="position-8" style="xhtml" />									                                               
				</div>								                                            
			</div>
        </div>			
		<?php } ?>
		    <div id="ft">
			    <div class="pagewidth">
				
					<div class="ftb">
					    <?php echo date( 'Y' ); ?>&nbsp; <?php echo $csite_name; ?>&nbsp;&nbsp;<?php require("template.php"); ?>
                    </div>
						<div id="top">
                            <div class="top_button">
                                <a href="#" onclick="scrollToTop();return false;">
						        <img src="templates/<?php echo $this->template ?>/images/top.png" width="30" height="30" alt="top" /></a>
                            </div>
					    </div>			
			    </div>
            </div>		
       		
		
		
</body>
</html>
  
  
  
  
  
  
  
  
  
  
  
  
  