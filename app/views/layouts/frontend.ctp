<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
$currpage=basename($_SERVER['REQUEST_URI']);
?>

<head>
	<title>Indian Horse Database</title>
	<!-- meta information -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
	<!-- load css files -->
	<?php e($html->css('style'));?>
	<?php e($html->css('skin'));?>
	<?php e($javascript->link('jquery-1'));?> 
	<?php e($javascript->link('jquery'));?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
</head>

<body>
		
	<div id="wrapper_parrent">
	
		<div id="wrapper">
		
			<div class="header"><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>"><img src="<?php e($this->webroot);?>img//logo.png" alt="" /></a></div>
			
			<div class="nav">
			                                                            
 				<ul>
					<li><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>" <?php if($currpage=="indianhorse") { ?> class="active" <?php } ?>>Home</a></li>
					<li><a href="">Find a Horse</a></li>
					<li><a href="">Add a Horse</a></li>
					<li><a href="">Edit a Horse</a></li>
					<li><a href="">Horse for Sale &amp; Stud</a></li>
					<li><a href="">Help</a></li>
					<li><a href="">Contact Us</a></li>
				</ul>		
					
			</div>
			
			<div class="sub_body">
			<div class="upper">
			<div>&nbsp;</div>
					<?php
					e($this->renderElement('rightpanel'));
					if($currpage=="indianhorse") {
					?>				
					<?php 
					$horsesalearr=$this->requestAction('horse/listlatesthorseforsale') ;
					if(count($horsesalearr)>0) {
					?>
					<div style="float: left; width: 762px;">
					<h2 style="padding:20px 0 0 30px; color:#994f26;">Recently put up for sale </h2>	
					<br />		
					<div class=" jcarousel-skin-tango">
						<div style="position: relative; 
					display: block;" class="jcarousel-container 
					jcarousel-container-horizontal">
					<div style="overflow: hidden; position: 
					relative;" class="jcarousel-clip jcarousel-clip-horizontal"><ul 
					style="overflow: hidden; position: relative; top: 0px; margin: 0px; 
					padding: 0px; left: -255px; width: 750px;" id="mycarousel" 
					class="jcarousel-list jcarousel-list-horizontal">
						<?php
						if(is_array($horsesalearr)){ 
							foreach($horsesalearr as $key=>$val) :
							$imagedirectory="horseimage";
							$image=$val['Horse']['image'];
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],177,135);
						?>	
							
						<li jcarouselindex="1" style="float: left; height:120px; list-style: none outside 
						none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
						jcarousel-item-1-horizontal">
						<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="115" 
						height="95">
							<a href="<?php e($html->url('/horse/details/'.$val['Horse']['id']));?>" style="text-decoration:none"><span style="font:normal 13px Arial, Helvetica, sans-serif; text-align:left; display:block; padding:3px 3px 2px 0;"><?php e($val['Horse']['name']);?></span></a>
						</li>
						<?php
							}
							endforeach;
						}
						?>   
							 </ul></div><div disabled="false" style="display: block;" 
							class="jcarousel-prev jcarousel-prev-horizontal"></div><div 
							disabled="false" style="display: block;" class="jcarousel-next 
							jcarousel-next-horizontal"></div></div></div>
						 <?php
						 }
					 }
					 ?>
					<div class="content">
						<?php echo $content_for_layout ?>
					</div>
					<?php
					if($currpage=="indianhorse") {
					?>
					<div class="button">
						<ul>
							<li class="find"><a href="#">Find</a></li>
							<li class="add"><a href="#">Add</a></li>
							<li class="sell"><a href="#">Sell</a></li>
						</ul>
					</div>
					<?php
					}
					?>
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>				
				</div>
				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img//sub_body_footer.png" alt="" />
				</div>
				
			</div>
		
		</div>
		
		<div class="footer">
			<ul>
				<li><a href="" class="active">PRIVACY POLICY</a></li>
				<li>|</li>
				<li><a href="" class="active">CANCELLATION POLICY</a></li>
				<li>|</li>
				<li><a href="<?php e($html->url('/content/terms'));?>" class="active">TERMS OF USE</a></li>
				<li>|</li>
				<li><a href="" class="active">DISCLAIMER</a></li>
				<li>|</li>
				<li><a href="" class="active">SITEMAP</a></li>
				<li>|</li>
				<li><a href="" class="active">CONTACT</a></li>
				<li>|</li>
				<li><a href="" class="active">ADVERTISE</a></li>
			</ul>		
			<p>&copy; 2010 Indianhorses.org All rights reserved.</p>		
		</div>
		
	</div>
		
</body>
</html>
