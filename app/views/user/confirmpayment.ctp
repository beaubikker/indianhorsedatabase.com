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
					<form action="<?php e($html->url('/user/payment'));?>" method="post">			
					<div class="profile_info">
						<div class="po_inf_mid">
						<p>&nbsp;</p>
							<div class="box1">
								<h3>Confirm Your Payment.</h3>
								<p><strong>
								Hello <?php e($userarr['User']['firstname']);?>,
								<br>
								You Have Subscribed for <?php e($userarr['User']['expiration_time_periode']);?>
								<br>
								Your amount is - $
								<?php 
								$price='';
								if($userarr['User']['expiration_time_periode']=="6 months") {
									$price=$seetingarr['Setting']['6_months_proce'];
									e($seetingarr['Setting']['6_months_proce']);								
								}
								if($userarr['User']['expiration_time_periode']=="1 Year") {
									$price=$seetingarr['Setting']['1_year_price'];
									e($seetingarr['Setting']['1_year_price']);								
								}
								if($userarr['User']['expiration_time_periode']=="1 Year 6 months") {
									$price=$seetingarr['Setting']['1_half_year_price'];
									e($seetingarr['Setting']['1_half_year_price']);								
								}
								if($userarr['User']['expiration_time_periode']=="2 Years") {
									$price=$seetingarr['Setting']['2_year_price'];
									e($seetingarr['Setting']['2_year_price']);								
								}							
								?>
								<input type="submit" class="mass1" value="Pay" style="background-color:#333333; color:#FFFFFF">
								<input type="hidden" name="price" value="<?php e($price);?>">
								</strong></p>
							</div>
						<div class="po_inf_btm">&nbsp;</div>
						<div class="clear"></div>						
					</div>		
					<div class="clear"></div>
									
				</div>	
					</form>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>		
			  </div>						
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