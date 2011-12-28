<script language="javascript">
	function Chklogin() {
		var err=0;
		var email=document.getElementById("emaillogfront").value;
		var password=document.getElementById("passlogfront").value;
		var rem='';
		if(document.getElementById("rem").checked==true) {
			rem='yes' ;
		}
		else {
			rem='no' ;
		}
		if(password=="" || password=="Password") {
			 document.getElementById("passlogfront").style.border = "1px solid #FF0000";
			 err++;		
		}
		else {
			document.getElementById("passlogfront").style.border = "1px solid #7F9DB9";
		}
		if(echeck(email)==false){
			 document.getElementById("emaillogfront").style.border = "1px solid #FF0000";
			 err++;		
		}
		else {
			 document.getElementById("emaillogfront").style.border = "1px solid #7F9DB9";
		}
		if(err==0) {
			document.getElementById("loginmsgfront").innerHTML="<font color=#FF0000>Please Wait ...</font>";	
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
				req.onreadystatechange=processrequestforlogbasefront;
				req.open("GET","<?php echo $html->url('/user/chklogin/');?>"+email+'/'+password+'/'+rem,true);	
				req.send(null);					
			}	
		}	
	}
  function processrequestforlogbasefront() {
	if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				var rem='';
				if(document.getElementById("rem").checked==true) {
					rem='Y';
				}
				else {
					rem='N';
				}
				if(req.responseText==0) {		
					document.getElementById("loginmsgfront").innerHTML="<font color=#FF0000><em>Invalid login</em> </font>";
				}
				if(req.responseText=="membershipexipre") {		
					document.getElementById("loginmsgfront").innerHTML="<font color=#FF0000><em>You account has expired</em> </font>";
				}
				else if(req.responseText=="premiumfirstlogin") {
					window.location.href='<?php e($html->url('/user/premiumuserwelcomepage'));?>';
				}	
				else if(req.responseText=="premiumvariouslogin") {
					window.location.href='<?php e($html->url('/user/premiumuserwelcomepage/'));?>';
				}	
				else {
					window.location.href='<?php e($html->url('/user/freeuserwelcomepage'));?>';
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

function forpassword() {
	$("#frpass").toggle("slow");
	 document.getElementById("passmsg").innerHTML="";
}

function emailpass() {
	var err=0;
	var emailaddress=document.getElementById("passemail").value;
	if(echeck(emailaddress)==false){
		document.getElementById("passemail").style.border = "1px solid #FF0000";
		err++;		
	}
	else {
		document.getElementById("passemail").style.border = "1px solid #7F9DB9";
	}
	if(err==0) {
		document.getElementById("passmsgfront").innerHTML="<br><font color=#FF0000>Please Wait ........</font>";
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
			req.open("GET","<?php echo $html->url('/user/forgotpasswordfront/');?>"+emailaddress,true);	
			req.send(null);					
		}	
	}
}
function processrequestforgotpass() {
	if(req.readyState==4)
		{					
			if(req.status==200)
			{			
				document.getElementById("passmsgfront").innerHTML=req.responseText; 
			}
		}
	}

</script>
<!-- added on 23.6 -->
<div style="float: right; width: 176px;">
<!-- added on 23.6 -->
<div class="visitor" style="position:absolute; top:165px">
						<div class="vis_up">
							<img src="<?php e($this->webroot);?>img/visitor_up.png" alt="" />
						</div>
						<div class="vis_mid">
							<h2 style="text-align: left; padding-left: 10px;">Welcome Visitor!</h2>
							<?php
							$usercooke='';
							$password='';
							$chkcookarr=$this->requestAction('/user/chkcookarr');
							?>
							<div id="side-bar-login-wrapper-reyeng">
								<form action="javascript:void%200;" onsubmit="return Chklogin()">
									<input class="mass" type="text" id="emaillogfront" name="E Mail" <?php if(count($chkcookarr)<=0) {?> value="E Mail"  <?php } else {  ?> value="<?php e($chkcookarr[0]['tbl_rems']['username']);?>" <?php } ?>   onFocus="if(this.value=='E Mail')this.value='';" onBlur="if(this.value=='')this.value='E Mail';" /><br />
									<div>
									<input class="mass50" type="password" id="passlogfront" name="Password" <?php if(count($chkcookarr)<=0) {?> value="Password"  <?php } else {  ?> value="<?php e($chkcookarr[0]['tbl_rems']['password']);?>" <?php } ?> onFocus="if(this.value=='Password')this.value='';" onBlur="if(this.value=='')this.value='Password';"/><br />
									<input class="button-reyeng small float_right" type="submit" value="Log in"  onclick="Chklogin()" style="cursor:pointer"/></div>
									<br />
							</div>
								<span  style="padding-left:12px"><input type="checkbox" id="rem" value="Y" name="rem" <?php if(count($chkcookarr)>0) {?> checked="checked" <?php } ?>/> Remember Me </span>
								<br />
								<br />
							  <span  style="padding-left:12px; text-decoration:underline; cursor:pointer" onclick="forpassword()">Forgot Password</span>
							  
							  <span id="frpass" style="display:none; ">
							  	<br />
							  	<input type="text"  id="passemail" class="mass" onFocus="if(this.value=='Your Email Address')this.value='';" onBlur="if(this.value=='')this.value='Your Email Address';" value="Your Email Address"/>
								<br />
								<br />
								&nbsp;&nbsp;<input  type="button" value="Go"  style="background:url(http://indianhorsedatabase.com/app/webroot/img/log_in_btn.png) no-repeat 0 0; border: 0; color:#FFF; font-weight:bold; padding:0; margin: 4px 0 0 0; width: 30px; height: 18px; cursor:pointer" onclick="emailpass()"/>
								<br />
								<br />
								<span id="passmsgfront" style="padding-left:6px;"></span>							  
							  </span>
							  
							  <span id="loginmsgfront" style="padding-left:15px"></span>								
							</form>
							<h4>Or Create a<br />free account</h4>
							<a href="<?php e($html->url('/user/selectmembership'));?>">Sign Up</a>
							
							<h3>Membership Advantages </h3>
							<?php
							$membership_arr=$this->requestaction('/content/listmembership');
							if(count($membership_arr)>0) {							
							?>
							<ul>
								<?php
								if(is_array($membership_arr)) {
									foreach($membership_arr as $key=>$val) :
									?>
										<li><a href="<?php e($html->url('/content/membershipdetail/'.$val['Membership']['id']));?>" style="padding-left: 15px;"><?php e($val['Membership']['advantagename']);?></a></li>									
									<?php									
									endforeach;								
								}
								?>				
								
							</ul>
							<?php
							}
							?>
						</div>
						<div class="vis_bottom"><img src="<?php e($this->webroot);?>img/visitor_bottom.png" alt="" border="0" /></div>
						<!-- added on 23.6 -->
						</div>	
						<div style="height: 15px;"></div>
						<div class="visitor" style="position:absolute; top:560px">
						<div class="vis_up">&nbsp;</div>
						<div class="vis_mid">
						<!-- added on 23.6 -->	
						<?php
						$advertisementarr=$this->requestAction('/advertisement/listall');
						if(count($advertisementarr)>0) { 
							foreach($advertisementarr as $key=>$val) :						
						?>
						<!-- added on 23.6 -->						
							<!--<div class="advertisement" style="cursor:pointer; height:auto" onclick="window.location.href='http://<?php //e($val['Advertisement']['url']);?>'">-->
							<!-- added on 23.6 -->
								<!--<h2 style="text-align: left; padding-left: 10px;"><?php //e($val['Advertisement']['name']);?></h2>-->
								<p style="text-align: center;"><?php e($val['Advertisement']['shortdescription']);?></p> 
								<p>&nbsp;</p>
									<?php
									if($val['Advertisement']['image']!="") {
									?>
										<img class="message" src="<?php e($this->webroot);?>img/advertisementimage/<?php e($val['Advertisement']['image']);?>" alt=""  height="44" width="44" style="padding-left:6px" align="absmiddle"/>
									<?php
									}
									?>
								<?php
								if($val['Advertisement']['url']!="") {
								?>
									<a href="http://<?php e($val['Advertisement']['url']);?>" target="_blank"><?php e($val['Advertisement']['url']);?></a>
								<?php
								}
								?>
							<!-- added on 23.6 -->
						<!--</div>-->
						<!-- added on 23.6 -->	
						<?php
							endforeach;							
						}
						?>									
					</div>
					<!-- added on 23.6 -->
																					<div class="vis_bottom">&nbsp;</div>
																					</div>
																					</div>
																					<!-- added on 23.6 -->