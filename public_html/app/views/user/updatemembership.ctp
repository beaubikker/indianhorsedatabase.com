<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function frmsub() {
		document.updatemembership.submit();	
	}
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
					<form action="<?php e($html->url('/user/confirmupdatemembership'));?>" method="post" name="updatemembership">			
					<div class="profile_info">
								<h2 class="header2">Upgrade Membership</h2>
					  <div class="box1">
								
								<h3>Choose a Time Period:</h3>
								<div>&nbsp;</div>
								<div class="form_box">
								<label class="formarea">Member time period:</label>
								<select name="data[User][expiration_time_periode]" size="1" class="dropdown1" id="duration">
                                  <option value="6 months" selected="selected">6 Months</option>
                                  <option value="1 Year" >1 Year</option>
                                  <option value="1 Year 6 months" >1.5 Years</option>
                                  <option value="2 Years" >2 Years</option>
                                </select>
								<div class="clear"></div>
							</div>								
								<h3>Payment Method</h3>
								<div class="clear"></div>
								<div class="form_box">
									<label class="formarea">6 Months </label>
									<b>$<?php
									e($seetingarr['Setting']['6_months_proce']);	 	
									?>&nbsp;&nbsp;(<?php e($seetingarr['Setting']['6_month_price_rs'])?>)</b>
									<div class="clear"></div>
									<label class="formarea">1 Year</label>
									<b>$<?php
									e($seetingarr['Setting']['1_year_price']);		
									?>&nbsp;&nbsp;(<?php e($seetingarr['Setting']['1_year_price_rs'])?>)</b>
									<div class="clear"></div>
									<label class="formarea">1 Year 6 Months</label>
									<b>$<?php
									e($seetingarr['Setting']['1_half_year_price']);		
									?>&nbsp;&nbsp;(<?php e($seetingarr['Setting']['1and_half_year_price_rs'])?>)</b>
									<div class="clear"></div>
									<label class="formarea">2 Years</label>
									<b>$<?php
									e($seetingarr['Setting']['2_year_price']);		
									?>&nbsp;&nbsp;(<?php e($seetingarr['Setting']['2_year_price_price_rs'])?>)</b>
									<div class="clear"></div>
									<div class="clear"></div>
								</div>
								<div>&nbsp;</div>									
								<img src="<?php e($this->webroot);?>img/paypal.jpeg" style="cursor:pointer"  onClick="frmsub()">																						
								&nbsp;&nbsp;							
						</div>											
					</div>	
					</form>	
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
