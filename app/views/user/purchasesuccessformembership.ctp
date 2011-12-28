<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function resend(email) {
		if(email=="") {
			document.getElementById("resendmsg").innerHTML="<font color=#FF0000>Please Fill your registration form</font>";
		}
		else {
			document.getElementById("resendmsg").innerHTML="<font color=#FF0000>Sending Please wait..........</font>";
			if(window.XMLHttpRequest)
			{
				req = new XMLHttpRequest();
			}
			if(window.ActiveXObject)
			{
				req = new ActiveXObject("Microsoft.XMLHTTP");
			}		
			if(req)
			{
				req.onreadystatechange=processrequestresend;
				req.open("GET","<?php echo $html->url('/user/resendpaid/');?>"+email,true);	
				req.send(null);					
			}		
		}	
	}	
	
	function processrequestresend() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{	
				document.getElementById("resendmsg").innerHTML="<font color=#FF0000>"+req.responseText+"</font>";				
			}
		}
	} 
</script>
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
							    <br>
							   Please log in again to activate your membership.								</p>
							</div>
						<div class="po_inf_btm">&nbsp;</div>
						<div class="clear"></div>						
					</div>
												
					</div>	
					</div>	
									
				</div>			
							
			</div>	
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</div>		
</body>
</html>
