<?php
e($this->renderelement('topheader'));
?>
<?php e($html->css('skin'));?>
<script type="text/javascript">
jQuery(document).ready(function() {
    jQuery('#mycarousel').jcarousel();
});
</script>
</head>
<body>
		
	<div id="wrapper_parrent">		
		<?php e($this->renderelement('search'));?>
		<br clear="all" />
		<div id="wrapper">
		<?php
			e($this->renderelement('frontheader'));			
		?>	
		<div class="sub_body">			
				<div class="upper">
					<div>&nbsp;</div>	
					<?php
					if($session->check('Message.flash')):
						?>
							<h1 class="top"><?php $session->flash();?></h1>							
						<?php						
					endif;
					?>
					<?php				
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
						 e($this->renderElement('rightpanel'));						 
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							e($this->renderElement('pemiumuservariouslogin'));		
						}	
						else {
							e($this->renderElement('rightpanelfreeuser'));
						}					
					}
					?>
					<?php 
					$horsesalearr=$this->requestAction('horse/listlatesthorseforsale') ;
					if(count($horsesalearr)>0) {
					?>
					<div style="float: left; width: 762px;">
					<h2 style="padding:20px 0 0 30px; color:#994f26;">Recently put up for sale </h2>	
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
						?>	
							
						<li jcarouselindex="1" style="float: left; height:120px; list-style: none outside 
						none;" class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 
						jcarousel-item-1-horizontal">
						<?php
						if($image!="") {
							if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
							$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],177,135);
							?>
								<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name']).'/'.$val['Horse']['id']));?>" style="text-decoration:none"><img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="115" height="95"></a>
							<?php
							}
						}
						else {
						?>
							<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name']).'/'.$val['Horse']['id']));?>" style="text-decoration:none"><img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="115" height="95"></a>
						<?php
						}
						?>
							<a href="<?php e($html->url('/horse/details/'.str_replace(" ", "-",$val['Horse']['name']).'/'.$val['Horse']['id']));?>" style="text-decoration:none"><span style="font:normal 13px Arial, Helvetica, sans-serif; text-align:left; display:block; padding:3px 3px 2px 0;"><?php e($val['Horse']['name']);?></span></a>
						</li>
						<?php							
							endforeach;
						}
						?>   
						</ul></div><div disabled="false" style="display: block;" 
						class="jcarousel-prev jcarousel-prev-horizontal"></div><div 
						disabled="false" style="display: block;" class="jcarousel-next 
						jcarousel-next-horizontal"></div></div></div>
					<?php
					}
					?>				
					<div class="content">
						<?php e($homecontent_arr[0]['Content']['content']); ?>
					</div>	
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>								
				</div>				
				<div class="bottom">

					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>				
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>
