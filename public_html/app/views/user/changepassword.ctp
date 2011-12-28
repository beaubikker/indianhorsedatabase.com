<?php
e($this->renderelement('topheader'));
?>
<script type="text/javascript">
	$(document).ready(function(){
		$(".changepass").click(function(){
			$("#changepass").toggle("slow");
		});	
	});	
	function Chkvalid() {
		var err=0;
		var password=document.getElementById("UserPassword").value
		var newpassword=document.getElementById("UserNewpassword").value
		var UserConpassword=document.getElementById("UserConpassword").value
		if(password=="") {
			document.getElementById("UserPassword").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("UserPassword").style.border = "1px solid #7F9DB9";
		}
		if(newpassword.length<6) {
			document.getElementById("UserNewpassword").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("UserNewpassword").style.border = "1px solid #7F9DB9";
		}
		if(newpassword!="") {
			if(UserConpassword!=newpassword) {
				document.getElementById("UserConpassword").style.border = "1px solid #FF0000";
				err++;			
			}
			else {
				document.getElementById("UserConpassword").style.border = "1px solid #7F9DB9";
			}
		}
		if(err==0) {
			document.getElementById("passmsg").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=processrequest;
				req.open("GET","<?php echo $html->url('/user/changepasswordvalid/');?>"+password+"/"+newpassword,true);	
				req.send(null);					
			}
		}
	}	
	function processrequest() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{				
				document.getElementById("passmsg").innerHTML=req.responseText;			
			}
		}
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
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>						
						<div class="po_inf_mid">	
							<div class="ihd25">					
								<h3 class="big90">Password</h3>
								<a href="javascript:void(0)" class="changepass" style="float:right; text-align: right; width:65px; padding: 10px 20px 5px; color: #994F26; text-decoration:none; font-size: 14px;line-height: 22px;">hide</a>
								<hr class="line_base" />
								<p class="big921">Do not use the same password that you use for other online accounts.
Your new password must be at least 6 characters in length.
Use a combination of letters, numbers, and punctuation.
Passwords are case-sensitive. Remember to check your CAPS lock key.</p>
							</div>	
							<div>&nbsp;</div>
							<span id="changepass">
							<form action="" name="changepass" method="post">
								<div>
									<div class="form_box">
										<label class="formarea3"><strong>Old Password:</strong><br />(required)</label>									
											<?php e($form->password('User.password',array("size"=>"30")));?>									
										<div class="clear"></div>
									</div>
									<div class="form_box">
										<label class="formarea3"><strong>New Password:</strong><br />(required)</label>
										<?php e($form->password('User.newpassword',array("size"=>"30")));?>	
										<div class="clear"></div>
									</div>
									
									<div class="form_box">
										<label class="formarea3"><strong>Confirm Password:</strong><br />(required)</label>
										<?php e($form->password('User.conpassword',array("size"=>"30")));?>	
										<div class="clear"></div>
									</div>												
									<input class="submit_btn001" type="button" value="Change Password"  onClick="Chkvalid()" style="cursor:pointer"/>
									<span id="passmsg"></span>														
							</div>
						</form>
						</span>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>		
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>
					<div>&nbsp;</div>								
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