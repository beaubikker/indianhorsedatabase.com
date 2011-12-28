<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function chklogmembervalid() {
		var err=0;
		var email=document.getElementById("emailmemlog").value;
		var password=document.getElementById("passlogmem").value;
		if(password=="" || password=="Password") {
			 document.getElementById("passlogmem").style.border = "1px solid #FF0000";
			 err++;		
		}
		else {
			document.getElementById("passlogmem").style.border = "1px solid #7F9DB9";
		}
		if(echeck(email)==false){
			 document.getElementById("emailmemlog").style.border = "1px solid #FF0000";
			 err++;		
		}
		else {
			 document.getElementById("emailmemlog").style.border = "1px solid #7F9DB9";
		}
		if(document.getElementById("rem1").checked==true) {
			rem='yes' ;
		}
		else {
			rem='no' ;
		}
		if(err==0) {
			document.getElementById("logmemmsg").innerHTML="<font color=#FF0000>Please Wait ...</font>";	
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
				req.onreadystatechange=processrequestforlogbasefrontlog;
				req.open("GET","<?php echo $html->url('/user/chklogin/');?>"+email+'/'+password+'/'+rem,true);
				req.send(null);					
			}	
		}	
	}
  function processrequestforlogbasefrontlog() {
	if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==0) {		
					document.getElementById("logmemmsg").innerHTML="<font color=#FF0000><em>Invalid login</em> </font>";
				}	
				if(req.responseText=="membershipexipre") {		
					document.getElementById("loginmsgfront").innerHTML="<font color=#FF0000><em>You account has expired</em> </font>";
				}
				if(req.responseText=="F") {
					window.location.href='<?php e($html->url('/user/freeuserwelcomepage'));?>';
				}	
				if(req.responseText=="premiumfirstlogin") {
					window.location.href='<?php e($html->url('/user/premiumuserfirstlogin'));?>';
				}	
				if(req.responseText=="premiumvariouslogin") {
					window.location.href='<?php e($html->url('/user/premiumuserwelcomepage'));?>';
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
					$usercooke='';
					$password='';
					$chkcookarr=$this->requestAction('/user/chkcookarr');
					?>
					<div style="float: left; width: 762px;">
					<h1 class="top">Member Login</h1>							
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
							<div class="signin_box_main">
								<form action="" style="padding-left: 65px; margin-top: 10px;">
									User Id:<input class="mass3" size="100" type="text" id="emailmemlog" onFocus="if(this.value=='E Mail')this.value='';" onBlur="if(this.value=='')this.value='E Mail';" <?php if(count($chkcookarr)<=0) {?> value="E Mail"  <?php } else {  ?> value="<?php e($chkcookarr[0]['tbl_rems']['username']);?>" <?php } ?>/><br />
									Password:<input class="mass9" size="100" id="passlogmem" type="password" name="Password" <?php if(count($chkcookarr)<=0) {?> value="Password"  <?php } else {  ?> value="<?php e($chkcookarr[0]['tbl_rems']['password']);?>" <?php } ?> onFocus="if(this.value=='Password')this.value='';" onBlur="if(this.value=='')this.value='Password';" /><br />
									<a href="<?php e($html->url('/user/selectmembership'));?>"/><b><font color="#994F26">Click Here</font></b> </a> <font color="#994F26">To Register </font> <input class="mass5" type="button" value="Submit"  onClick="chklogmembervalid()" style="cursor:pointer; margin-left: 42px;"/>
									<br /><br>
									<div align="left"><span><input type="checkbox" id="rem1" value="Y" name="rem" <?php if(count($chkcookarr)>0) {?> checked="checked" <?php } ?>/> Remember Me </span></div>
									<br>
									<span id="logmemmsg"></span>
								</form>
							</div>
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