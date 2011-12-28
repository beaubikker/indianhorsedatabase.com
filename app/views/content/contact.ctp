<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function Chkvalid() {
		var err=0;
		var name=document.getElementById("name").value;
		var email=document.getElementById("email").value;
		var subject=document.getElementById("subject").value;
		var message=document.getElementById("message").value; 
		if(name=="") {
			document.getElementById("name").style.border = "1px solid #FF0000";
			err++;		
		}
		else {
			document.getElementById("name").style.border = "1px solid #666666";			
		}	
		if(email=="") {
			document.getElementById("email").style.border = "1px solid #FF0000";
			err++;		
		}
		else {
			document.getElementById("email").style.border = "1px solid #666666";			
		}
		if(email!="") {
			if (echeck(email)==false){
				document.getElementById("email").style.border = "1px solid #FF0000";
				err++;	
			}
			else {
				document.getElementById("email").style.border = "1px solid #666666";
			}		
		}		
		if(subject=="") {
			document.getElementById("subject").style.border = "1px solid #FF0000";
			err++;		
		}
		else {
			document.getElementById("subject").style.border = "1px solid #666666";			
		}	
		if(message=="") {
			document.getElementById("message").style.border = "1px solid #FF0000";
			err++;		
		}
		else {
			document.getElementById("message").style.border = "1px solid #666666";			
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
				req.open("GET","<?php echo $html->url('/content/mailtouser/');?>"+name+"/"+email+"/"+subject+"/"+message,true);	
				req.send(null);					
			}
		}
		else {
			document.getElementById("msg").innerHTML="";
		}
	}
	
	function processrequest() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{			
				document.getElementById("name").value='';
				document.getElementById("email").value='';
				document.getElementById("subject").value='';
				document.getElementById("message").value='';
				document.getElementById("msg").innerHTML=req.responseText;		
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
					?>
					<div style="float: left; width: 762px;">					
						<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
					  <div class="po_inf_mid">	
					  		<div>&nbsp;</div>
							<?php e($homecontent_arr[0]['Content']['content']); ?>
							<img class="toper" src="<?php e($this->webroot);?>img//line1.jpg" alt="" />
							<div>&nbsp;</div>
							<div>&nbsp;</div>
							<h3>By e-mail:</h3>
							<div>&nbsp;</div>
							<div class="form_box">
								<label class="formarea">Your Name:</label><input name="name" id="name" type="text" size="30" />
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">E-mail:</label><input name="email" id="email" type="text" size="30" />
								<div class="clear"></div>
							</div>
							<div class="form_box">
								<label class="formarea">Subject:</label>
								<input name="subject" id="subject" type="text" size="30" />
								<div class="clear"></div>
							</div>
							<div class="form_box" style="width:865px">
								<label class="formarea">Message:</label><textarea class="formarea1"  style=" padding-left:15px;border:1px solid #F2CE87; width:400px; height:100px;" name="message" id="message" value=""  /></textarea>
								<div class="clear"></div>
							</div>
							<input class="mass150" type="button" value="Send"  onClick="Chkvalid()" style="cursor:pointer"/>
							<br>
							<br>
							<span id="msg" style="padding-left:10px"></span>
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
