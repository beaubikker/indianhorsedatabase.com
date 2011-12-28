<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Artscapes by Lilly | Pastels, Pen and Pencil, and Poetry</title>
<?php
 e($html->css('style')); 
 e($html->css('lightbox')); 
?>
<!--dropdown area start -->
<?php
echo $javascript->link('jquery');
?>
<script type="text/javascript">
	var $j = jQuery.noConflict();
		$j(document).ready(function(){
		$j('.menu-nav li').hover(
			function() {
				$j(this).addClass("active");
				$j(this).find('> .ulwrapper').stop(false, true).fadeIn();
				//Cufon.refresh()
			},
			function() {
				$j(this).removeClass("active");        
				$j(this).find('div').stop(false, true).fadeOut('fast');
				//Cufon.refresh()
			}
		);
		$j('.ulwrapper').hover(
			function() {
				$j('.parent').addClass("active_tab");
			},
			function() {
				$j('.parent').removeClass("active_tab");        
			}
		);
		$j('.ulwrapper .ulwrapper').hover(
			function() {
				$j('.ulwrapper .parent').addClass("active_tab2");
			},
			function() {
				$j('.ulwrapper .parent').removeClass("active_tab2");        
			}
		);
	});
	

	</script>
<!--dropdown area end -->

<!--home gallery area start -->
<?php
 e($html->css('jq_fade')); 
 e($html->css('reset')); 
 echo $javascript->link('jquery_new');
 echo $javascript->link('jquery.innerfade');
?>
	<?php
	$currpage=basename($_SERVER['REQUEST_URI']) ;
	?>
	<?php
	if($currpage=="") { ?>	
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
					
					$('ul#portfolio').innerfade({
						speed: 1000,
						timeout: 5000,
						type: 'sequence',
						containerheight: '220px'
					});
					
					$('.fade').innerfade({
						speed: 1000,
						timeout: 6000,
						type: 'random_start',
						containerheight: '1.5em'
					});
					
					$('.adi').innerfade({
						speed: 'slow',
						timeout: 5000,
						type: 'random',
						containerheight: '150px'
					});

			});
  	</script>
	<?php
	}
	?>
<!--home gallery area end -->

</head>

<body>
	<div id="wrap_area">
		<!--main area start -->
		<div id="wrapper">
			<!--header area start -->
			<div id="header_area" >
				<div class="header_top" style="cursor:pointer" onclick="window.location.href='http://www.artscapesbylilly.com/'">
					<?php
					e($html->image('logo.png'));
					?>
				</div>
				<!--<div class="bulet_area"><img src="<?php e($this->webroot);?>img/bulet.jpg" alt="" /></div>-->
				<div class="menu_area">
					<!--menu area start -->
					<ul id="menu" class="menu-nav">
						
						<li><a href="<?php e($html->url('/content/about'));?>" <?php if($currpage=="about") { ?> class="select" <?php } ?> target="_self">About the Artist</a></li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li><a href="<?php e($html->url('/gallery/show/Pastels'));?>" <?php if($currpage=="Pastels") { ?> class="select" <?php } ?> target="_self">Pastels</a></li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li><a href="<?php e($html->url('/gallery/show/pen'));?>" <?php if($currpage=="pen") { ?> class="select" <?php } ?> target="_self">Pen and Pencil</a></li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li class="bulet"><a href="javascript:void(0)" <?php if($currpage=="paintings" || $currpage=="Sketches" || $currpage=="Works" || $currpage=="Early" || $currpage=="step") { ?> class="select" <?php }  else { ?> class="area_img" <?php } ?>>Additional Art</a>
						<div style="display: none;" class="ulwrapper">
						<ul>
							<li class="select" id="sf-59"><a href="<?php e($html->url('/gallery/paintings'));?>" target="_self" class="select"><strong>
								<?php if($currpage=="paintings") { ?>								
									<font color="#40A2A6">Paintings, Pottery, and More</font>
								<?php
								}
								else { 
								?>
									Paintings, Pottery, and More
								<?php
								}
								?>
							</strong></a></li>
							<li class="" id="sf-61"><a href="<?php e($html->url('/gallery/show/Sketches'));?>" target="_self"><strong>
								<?php if($currpage=="Sketches") { ?>								
									<font color="#40A2A6">Sketches</font>
								<?php
								}
								else { 
								?>
									Sketches
								<?php
								}
								?>						
							</strong></a></li>
							<li class="" id="sf-61"><a href="<?php e($html->url('/gallery/show/Works'));?>" target="_self"><strong>
							<?php if($currpage=="Works") { ?>								
									<font color="#40A2A6">Works in Progress</font>
								<?php
								}
								else { 
								?>
									Works in Progress
								<?php
								}
								?>							
							</strong></a></li>
							<li class="" id="sf-61"><a href="<?php e($html->url('/gallery/show/Early'));?>" target="_self"><strong>
							<?php if($currpage=="Early") { ?>								
									<font color="#40A2A6">Early Works</font>
								<?php
								}
								else { 
								?>
									Early Works
								<?php
								}
								?>						
							</strong></a></li>
							<li class="" id="sf-61"><a href="<?php e($html->url('/gallery/step'));?>" target="_self"><strong>
							<?php if($currpage=="step") { ?>								
									<font color="#40A2A6">Step By Step Demo</font>
								<?php
								}
								else { 
								?>
									Step By Step Demo
								<?php
								}
								?>							
							</strong></a></li>
						</ul>
						</div>
						</li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li><a href="<?php e($html->url('/content/poetry'));?>" <?php if($currpage=="poetry") { ?> class="select" <?php } ?> target="_self">Poetry &amp; Prose</a></li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li><a href="<?php e($html->url('/content/commison'));?>" <?php if($currpage=="commison") { ?> class="select" <?php } ?>>Commissions &amp; Pro Bono</a></li>
						<li class="divider_area"><img src="<?php e($this->webroot);?>img/line.jpg" alt="" /></li>
						<li><a href="<?php e($html->url('/content/contact'));?>" <?php if($currpage=="contact") { ?> class="select" <?php } ?>>Contact</a></li>
						</ul>
					<!--menu area end -->
				</div>
				<!--banner area start -->
				<?php
				if($currpage=="") { ?>
				<div class="banner_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/banner.jpg" alt="" />											
					</div>
				</div>
				<?php
				}
				?>
				<?php
				if($currpage=="about") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/about_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="pen") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/pen_pencil_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="Pastels") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/pastels_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="paintings") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/paintings_pot.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="Early") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/early_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="step") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/step_by_step_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				
				if($currpage=="privacy") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/privacy_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				
				if($currpage=="terms") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/terms_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="sitemap") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/sitemap_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				
				
				if($currpage=="Sketches") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/sketches_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="Works") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/working_progress_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				
				if($currpage=="poetry") { ?>
				<div class="about_area">
					<div>						
							<img src="<?php e($this->webroot);?>img/poetry_banner.png" alt="" width="992" height="279" />											
					</div>
				</div>
				<?php
				}
				if($currpage=="commison") { ?>
				<div class="about_area">
					<div>						
						<img src="<?php e($this->webroot);?>img/commissions_banner.png" alt="" />												
					</div>
				</div>
				
				<?php				
				}
				if($currpage=="contact") { ?>
				<div class="about_area">
					<div>						
						<img src="<?php e($this->webroot);?>img/contact_banner.png" alt="" />												
					</div>
				</div>
				
				<?php				
				}
				?>
				<!--banner area end -->
			</div>
			<!--header area end -->
			<!--body area start -->
			<?php echo $content_for_layout ?>
			
			
			<div class="clear"></div>
			<!--body area end -->
			<div>&nbsp;</div>
			
		</div>
		<div class="clear"></div>
		<!--main area end -->
	</div>
	<!--footer area start -->
	<div id="footer_area">
		<div class="footer_bg">
			<div class="footer_left_area">
				<?php echo $html->link('Home', array(
						'controller' => 'content',
						'action' => 'home'));							
			?>  -  
			
			<?php echo $html->link('Sitemap', array(
						'controller' => 'content',
						'action' => 'sitemap'));							
			?> 
			  - <?php echo $html->link('Contact', array(
						'controller' => 'content',
						'action' => 'contact'));							
			?>  -  <?php echo $html->link('Privacy', array(
						'controller' => 'content',
						'action' => 'privacy'));							
						?>  - <?php echo $html->link('Terms And Condition', array(
						'controller' => 'content',
						'action' => 'terms'));							
						?>
			</div>
			<div class="footer_right_area">
				© 2010, Velocity Businesses, LLC and Lilly Deng, All Rights Reserved.<br />
				No image or portion of this website may be reprinted without written permission.<br />
				<a href="http://www.massoftind.com" target="_blank">
					<?php
					e($html->image('design-credit.png'));
					?>	
				</a>	
				</span>		
			</div>
			<div class="clear"></div>
		</div>
	</div>
	<!--footer area end -->
</body>
</html>
