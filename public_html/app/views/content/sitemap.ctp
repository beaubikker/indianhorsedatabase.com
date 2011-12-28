<?php
e($this->renderelement('topheader'));
?>
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
					$chksession=$this->requestaction('/user/chksession');
					if($chksession=="") {
						 e($this->renderElement('rightpanel'));						 
					}
					else {
						$usertype=$this->requestaction('/user/usertype');
						if($usertype=="P") {
							$chklogincounter=$this->requestaction('/user/chklogincounter');
							if($chklogincounter<=0) {
								e($this->renderElement('rightpanelpremiumfirst'));	
							}
							else {
								e($this->renderElement('pemiumuservariouslogin'));	
							}	
						}	
						else {
							e($this->renderElement('rightpanelfreeuser'));
						}					
					}
					?>
					<div style="float: left; width: 762px;">
					<h1 class="top">Site Map</h1>				
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid" style="min-height: 500px;">
							<ul class="brand">				
								<li><a href="<?php echo $html->url(array("controller" => "content","action" => "front"));?>">Home</a></li>
								<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "findahorse"));?>">Find a horse</a></li>
								<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "addhorse"));?>">Add a horse</a></li>
								<li><a href="<?php echo $html->url(array("controller" => "horse","action" => "salehorse"));?>">Horse for Sale &amp; Stud</a></li>
								<li><a href="<?php e($html->url('/content/help'));?>">Help</a></li>
								<li><a href="<?php e($html->url('/content/privacy'));?>">Privacy Policy</a></li>
								<li><a href="<?php e($html->url('/content/cancellation'));?>">Cancellation Policy</a></li>
								<li><a href="<?php e($html->url('/content/terms'));?>">Terms of Use</a></li>
								<li><a href="#">Disclaimer</a></li>		
								<li><a href="<?php e($html->url('/content/sitemap'));?>">Sitemap</a></li>	
								<li><a href="<?php e($html->url('/content/contact'));?>">Contact</a></li>	
								<li><a href="#">Advertise</a></li>			
							</ul>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
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