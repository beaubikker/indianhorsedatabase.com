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
								<p>Congratulations! You can now access all the features of a Premium Member of the Indian Horse Database!<br>
								  You have chosen a <b><?php e($userarr['User']['expiration_time_periode']);?></b> membership with the total cost of $<?php e($price);?> 
								  <br>
							    Your Premium Membership will expire on <b><?php e($userarr['User']['membership_exipre_date']);?></b> <br>
							    Now please confirm your email address:<br>
							    Do this by going to your inbox and clicking on the link in the email we&rsquo;ve sent you.<br>
							    <br>
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
