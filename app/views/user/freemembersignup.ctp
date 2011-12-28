<?php
e($this->renderelement('topheader'));
?>
<script src="http://code.jquery.com/jquery-1.4.2.js">
</script>
<script language="javascript">
	$(document).ready(function(){
		$(".post").click(function(){
			$("#post").toggle("slow");
		});	
	});
	$(document).ready(function(){
		$(".forgotpassword").click(function(){
			$("#forgotpassword").toggle("slow");
		});	
	});	
</script>
<script language="javascript">
	function resendemail() {
		var email=document.getElementById("UserEmailAddress").value;
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
				req.open("GET","<?php echo $html->url('/user/resend/');?>"+email,true);	
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
	
	
	function valid() {
		var err=0;
		var firsrname=document.getElementById("UserFirstname").value;
		var lastname=document.getElementById("UserLastname").value;
		var email=document.getElementById("UserEmailAddress").value;
		var retypeemailval=document.getElementById("UserRetypeemailAddress").value;		
		var password=document.getElementById("UserPassword").value;
		var repassword=document.getElementById("UserRepassword").value;
		if(firsrname=="") {
			document.getElementById("firstnameerr").style.color="#FF0000";
			 document.getElementById("UserFirstname").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("firstnameerr").style.color="#994F26";
			document.getElementById("UserFirstname").style.border = "1px solid #7F9DB9";
		}	
		if(lastname=="") {
			document.getElementById("lastnameerr").style.color="#FF0000";
			 document.getElementById("UserLastname").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("lastnameerr").style.color="#994F26";
			 document.getElementById("UserLastname").style.border = "1px solid #7F9DB9";
		}
		if(email=="") {
			 document.getElementById("emailerr").style.color="#FF0000";
			 document.getElementById("UserEmailAddress").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("emailerr").style.color="#994F26";
			document.getElementById("UserEmailAddress").style.border = "1px solid #7F9DB9";
		}
		if(retypeemailval!="") {
			if (echeck(retypeemailval)==false){
				 document.getElementById("emailerr").style.color="#FF0000";
			 	 document.getElementById("UserEmailAddress").style.border = "1px solid #FF0000";
				 err++;	
			}
			else {
				document.getElementById("emailerr").style.color="#994F26";
				document.getElementById("UserEmailAddress").style.border = "1px solid #7F9DB9";
			}		
		}	
		if(retypeemailval=="") {
			if (echeck(retypeemailval)==false){
				 document.getElementById("retypeemailerr").style.color="#FF0000";
			     document.getElementById("UserRetypeemailAddress").style.border = "1px solid #FF0000";
				err++;	
			}
			else {
					document.getElementById("retypeemailerr").style.color="#994F26";
					document.getElementById("UserRetypeemailAddress").style.border = "1px solid #7F9DB9";
			}		
		}
		else {
			if(email!=retypeemailval) {
				 document.getElementById("retypeemailerr").style.color="#FF0000";
			     document.getElementById("UserRetypeemailAddress").style.border = "1px solid #FF0000";
				err++;
			}
			else {
				document.getElementById("retypeemailerr").style.color="#994F26";
				document.getElementById("UserRetypeemailAddress").style.border = "1px solid #7F9DB9";
			}		
		}		
		if(password=="") {
			document.getElementById("password_err").style.color="#FF0000";
			 document.getElementById("UserPassword").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("password_err").style.color="#994F26";
			document.getElementById("UserPassword").style.border = "1px solid #7F9DB9";
		}	
		if(password!=repassword) {
			 document.getElementById("retypepassword_err").style.color="#FF0000";
			 document.getElementById("UserRepassword").style.border = "1px solid #FF0000";
			 err++;		
		} 
		else {
			document.getElementById("retypepassword_err").style.color="#994F26";
			document.getElementById("UserRepassword").style.border = "1px solid #7F9DB9";
		}	
		if(err==0) {
			document.getElementById("msg").innerHTML="<font color=#FF0000>Please Wait...........</font>";
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
				req.open("GET","<?php echo $html->url('/user/addfreeuser/');?>"+firsrname+"/"+lastname+"/"+email+"/"+password,true);	
				req.send(null);					
			}
		}
	}	
	function processrequest() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==1) {
					document.getElementById("info22").style.display="none";
					document.getElementById("personalinfo").className ="personal_info" ;	
					document.getElementById("emailconfirm").className ="payment_details_new_active" ;	
					document.getElementById("mailconfirm").style.display="block";
					document.getElementById("profileimage").style.display="none";
					document.getElementById("msg").innerHTML="";		
					document.getElementById("regmailcontent").innerHTML="A confirmaton e-mail has been sent<br />to your account, please click the link<br />there and you will be guided to complete the registration process.	";					
				}
				else {
					document.getElementById("msg").innerHTML=req.responseText;
				}
			}
		}
	} 
function echeck(str) {
	var at="@"
	var dot="."
	var lat=str.indexOf(at)
	var lstr=str.length
	var ldot=str.indexOf(dot)
	if (str.indexOf(at)==-1){
		  return false
	}
	if (str.indexOf(at)==-1 || str.indexOf(at)==0 || str.indexOf(at)==lstr){
		return false
	}

	if (str.indexOf(dot)==-1 || str.indexOf(dot)==0 || str.indexOf(dot)==lstr){
		return false
	}

	 if (str.indexOf(at,(lat+1))!=-1){
		return false
	 }

	 if (str.substring(lat-1,lat)==dot || str.substring(lat+1,lat+2)==dot){
		return false
	 }
	 if (str.indexOf(dot,(lat+2))==-1){
		return false
	 }
	
	 if (str.indexOf(" ")!=-1){
		return false
	 }
	 return true					
}
function perinfo() {
	document.getElementById("info22").style.display="block";
	document.getElementById("profileimage").style.display="block";	
	document.getElementById("logbox").className ="email_confirmation_new" ;	
	document.getElementById("loginbox").style.display="none";	
	document.getElementById("personalinfo").className ="personal_info_active" ;	
	document.getElementById("emailconfirm").className ="payment_details_new" ;
	document.getElementById("mailconfirm").style.display="none";
}

function paymentdetails() {
	document.getElementById("info22").style.display="none";
	document.getElementById("personalinfo").className ="personal_info" ;	
	document.getElementById("profileimage").style.display="none";
	document.getElementById("logbox").className ="login" ;	
	document.getElementById("loginbox").style.display="none";
	document.getElementById("emailconfirm").className ="email_confirmation" ;	
	document.getElementById("mailconfirm").style.display="none";
}
function showlogbox() {
	document.getElementById("info22").style.display="none";
	document.getElementById("personalinfo").className ="personal_info" ;	
	document.getElementById("profileimage").style.display="none";
	document.getElementById("logbox").className ="email_confirmation_new_active" ;	 
	document.getElementById("loginbox").style.display="block";
	document.getElementById("emailconfirm").className ="payment_details_new" ;	
	document.getElementById("mailconfirm").style.display="none";
}
function emalconfirm() {
	document.getElementById("info22").style.display="none";
	document.getElementById("personalinfo").className ="personal_info" ;	
	document.getElementById("profileimage").style.display="none";
	document.getElementById("logbox").className ="email_confirmation_new" ;	
	document.getElementById("loginbox").style.display="none";
	document.getElementById("emailconfirm").className ="payment_details_new_active" ;	
	document.getElementById("mailconfirm").style.display="block";
}
function login_chk() {
	var err=0;
	var email=document.getElementById("emaillog").value;
	var password=document.getElementById("pass_log").value;
	if(password=="" || password=="Password") {
		 document.getElementById("pass_log").style.border = "1px solid #FF0000";
		 err++;		
	}
	else {
		document.getElementById("pass_log").style.border = "1px solid #7F9DB9";
	}
	if(echeck(email)==false){
		 document.getElementById("emaillog").style.border = "1px solid #FF0000";
		 err++;		
	}
	else {
		 document.getElementById("emaillog").style.border = "1px solid #7F9DB9";
	}
	if(err==0) {
		document.getElementById("loginmsg").innerHTML="<font color=#FF0000>Please Wait ...</font>";	
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
			req.onreadystatechange=processrequestforlog;
			req.open("GET","<?php echo $html->url('/user/freeuserlogin/');?>"+email+'/'+password,true);	
			req.send(null);					
		}	
	}
}

function processrequestforlog() {
	if(req.readyState==4)
		{					
			if(req.status==200)
			{			
				if(req.responseText==0) {	
					document.getElementById("loginmsg").innerHTML="<font color=#FF0000>Invalid Login </font>";
				}
				else {
					window.location.href='<?php e($html->url('/user/freeuserwelcomepage'));?>';
				}
			}
		}
	}
function chkpass() {
	var err=0;
	var emailaddress=document.getElementById("emaillpass").value;
	if(echeck(emailaddress)==false){
		document.getElementById("emaillpass").style.border = "1px solid #FF0000";
		err++;		
	}
	else {
		document.getElementById("emaillpass").style.border = "1px solid #7F9DB9";
	}
	if(err==0) {
		document.getElementById("passmsg").innerHTML="<br><font color=#FF0000>Please Wait ........</font>";
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
			req.onreadystatechange=processrequestforgotpass;
			req.open("GET","<?php echo $html->url('/user/forgotpassword/');?>"+emailaddress,true);	
			req.send(null);					
		}	
	}
}
function processrequestforgotpass() {
	if(req.readyState==4)
		{					
			if(req.status==200)
			{			
				document.getElementById("passmsg").innerHTML=req.responseText; 
			}
		}
	}
</script>
<body>		
	<div id="wrapper_parrent">	
	  <div id="wrapper">		
			<?php
			e($this->renderelement('frontheader'));			
			?>			
			<div class="sub_body">
			
			  <div class="upper">
			  <div>&nbsp;</div>					
					<?php
					e($this->renderElement('rightpanel'));
					?>
					<?php
					if($login!="") { ?>		
						<h1 class="top">You have successfully activated your account</h1>
					<?php
					}
					?>
					
					<div style="float: left; width: 762px;">		
									
					<div class="profile_info">
						<div>
							<div  <?php if($login=="") { ?> class="personal_info_active" <?php } else { ?> class="personal_info" <?php } ?> id="personalinfo" onClick="perinfo()" >Personal Info</div>							
							<div class="payment_details_new" id="emailconfirm" onClick="emalconfirm()" > Email Confirmation</div>
							<div <?php if($login=="") { ?> class="email_confirmation_new" <?php } else { ?> class="email_confirmation_new_active" <?php } ?> id="logbox" onClick="showlogbox()" > Login</div>
							<div style="clear: both; line-height: 0; font-size: 0;"></div>
						</div>
						<form action="" name="frm"  method="post" enctype="multipart/form-data">
						<div class="po_inf_mid help" style="min-height: 500px;">
							<div class="media">
							
							<div id="info22" <?php if($login=="") { ?> style="display:block"<?php } else { ?> style="display:none" <?php } ?>>
							<div style="float:left; margin: 50px 0 0 50px; width: 400px;">
								<div class="form_box">
									<label class="formarea3"><span id="firstnameerr">First Name:</span></label><?php e($form->text('User.firstname',array("size"=>"30")));?>
								</div>
								<div class="form_box">
									<label class="formarea3"><span id="lastnameerr">Last Name:</span></label><?php e($form->text('User.lastname',array("size"=>"30")));?>
								</div>								
								<div class="form_box">
									<label class="formarea3"><span id="emailerr">E-mail:</span></label><?php e($form->text('User.email_address',array("size"=>"30")));?>
									<div class="clear"></div>
								</div>
								<div class="form_box">
									<label class="formarea3"><span id="retypeemailerr">Retype E-mail:</span></label><?php e($form->text('User.retypeemail_address',array("size"=>"30")));?>
									<div class="clear"></div>
								</div>
								<div class="form_box">
									<label class="formarea3"><span id="password_err">Password:</span></label>
									<?php e($form->password('User.password',array("size"=>"30")));?>
									<div class="clear"></div>
								</div>
								<div class="form_box">
									<label class="formarea3"><span id="retypepassword_err">Retype Password:</span></label><?php e($form->password('User.repassword',array("size"=>"30")));?>
								</div>
								
							</div>						
							</div>													
							<span id="loginbox" <?php if($login=="login") { ?> style="display:block"<?php } else { ?> style="display:none" <?php } ?>>									
									
									<div class="signin_box" style="padding-top: 70px; height: 140px; padding-left: 75px; width: 350px;">								
									Email:<input class="mass3" type="text" id="emaillog" name="E Mail" value="E Mail" onFocus="if(this.value=='E Mail')this.value='';" onBlur="if(this.value=='')this.value='E Mail';" /><br />
									Password:<input class="mass3" style="margin-left: 10px;" type="password"  id="pass_log" name="Password" value="Password" onFocus="if(this.value=='Password')this.value='';" onBlur="if(this.value=='')this.value='Password';" /><br><br>
											<input class="mass15" type="button" value="Submit" onClick="login_chk()"  style="cursor:pointer; margin-left: 78px;"/>
									<span id="loginmsg"></span>
									<p  style="color:#994f26;"><span style="padding-right: 25px;">forgot password?</span> <strong><a style="color:#994f26;" href="javascript:void(0)" class="forgotpassword">click here</a></strong></p>
									<span id="forgotpassword" style="display:none">
										<input class="mass3" type="text" id="emaillpass" name="emaillpass" value="E Mail" onFocus="if(this.value=='E Mail')this.value='';" onBlur="if(this.value=='')this.value='E Mail';" />
										<input class="mass15" type="button" value="Submit" onClick="chkpass()"  style="cursor:pointer"/>
										<span id="passmsg"></span>
									</span>								
							</div>	
									
														
							</span>	
							
							
							
							
							
							
							
							<span id="mailconfirm" style="display:none">								
								<div class="box1">
									<!--<h3 style="padding:55px;">
									<span id="regmailcontent">
										Please Fill Up The registration form to recieve an email from us.									
									</span>
									</h3>-->
									<p style="padding: 60px 0 0 30px;"><strong>A confirmation e-mail has been sent to your account, please click the link there and you will be guided to complete the registration process.<br><br>
									Did not receive an email? Check your spam box.<br />or 
										<a href="javascript:void(0)" onClick="resendemail()" style="text-decoration: underline; padding: 0 5px 0 0; font-size: 12px; color: #CBB056;">Click here</a> to resend the e-mail.
										<span id="resendmsg"></span>
									</strong></p>
								</div>							
							</span>		
							<input type="hidden" id="hiddemail" name="hiddemail" value="">
																							
							<span id="profileimage" <?php if(@$emailconfirm!="") { ?> style="display:none" <?php } ?>>
								<div style="float:left; width: 180px; margin-top:50px;">
									<?php
									if($profileimage=="") {?>									
										<img src="<?php e($this->webroot);?>img/profile_img.jpg" alt="" />
									<?php
									}
									else {
									$imagedirectory="profileimage";
									$image=$profileimage;
										if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
											$xy = $rsz->imgResize(rootpth()."profileimage/".$profileimage,164,170);
											?>
											<img src="<?php e($this->webroot);?>img/profileimage/<?php e($profileimage);?>" alt="" width="<?php e($xy[0]);?>" height="<?php e($xy[1]);?>">
											<?php	
										}								
									}
									?>									
									<a href="javascript:void(0)"  class="post"><p>Add Profile Image</p></a>
									<span id="post" style="display:none; margin-bottom: 10px;">
									  <input type="file" name="data[User][image]" onChange="document.frm.submit()">
									</span>
									<span class="form_box" style="float: none;">
										<input type="button" value="Next" onClick="valid()" class="mass000" style="cursor:pointer; margin-left: 50px;">
										<span id="msg"></span>								
									</span>
								</div>
							</span>							
						</div>	
						</div>
					</form>
				<div class="po_inf_btm">&nbsp;</div>						
			  </div>
			  </div>
			  <div style="clear: both; line-height: 0; font-size: 0;"></div>		
			  </div>
				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />				</div>
			</div>
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>
	</div>		
</body>
</html>
