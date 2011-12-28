<?php
e($this->renderelement('topheader'));
?>
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
						<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
					  <div class="po_inf_mid">
							<div class="box1" style="height:400px">				
								<?php 
								$price='';
								if($userarr['User']['expiration_time_periode']=="6 months") {
									$price=$seetingarr['Setting']['6_months_proce'];
									//e($seetingarr['Setting']['6_months_proce']);								
								}
								if($userarr['User']['expiration_time_periode']=="1 Year") {
									$price=$seetingarr['Setting']['1_year_price'];
									//e($seetingarr['Setting']['1_year_price']);								
								}
								if($userarr['User']['expiration_time_periode']=="1 Year 6 months") {
									$price=$seetingarr['Setting']['1_half_year_price'];
									//e($seetingarr['Setting']['1_half_year_price']);								
								}
								if($userarr['User']['expiration_time_periode']=="2 Years") {
									$price=$seetingarr['Setting']['2_year_price'];
									//e($seetingarr['Setting']['2_year_price']);								
								}							
								?>								
								<h3>Your payment is successful.</h3>
								<p>Hello <?php e($userarr['User']['firstname']);?>, </p>
								<p>Thank you for your continued support to the IHD! <br>
									You have chosen a <b><?php e($userarr['User']['membership_exipre_date']);?></b>  membership with the total cost of $<?php e($price);?> 
								<br>
								Your premium membership will expire on <b><?php e($userarr['User']['membership_exipre_date']);?></b>.
								<br>
								<br>
								Please <a href="<?php e($html->url('/user/freeuserlogout'));?>" style="color:#994F26"><b>log out</b></a> and log back in again to activate your purchase and gain access to the premium features.
							   </p>
								</p>
							</div>
						<div class="po_inf_btm">&nbsp;</div>
						<div class="clear"></div>						
					</div>												
					</div>	
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
