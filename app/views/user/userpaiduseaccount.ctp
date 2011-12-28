<?php
e($this->renderelement('topheader'));
$userarr=$this->requestaction('/user/userdetails');
?>
<script language="javascript">
	$(document).ready(function(){
		$(".changename").click(function(){
			$("#changename").toggle("slow");
		});	
	});		
	$(document).ready(function(){
		$(".changeemail").click(function(){
			$("#changeemail").toggle("slow");
		});	
	});		
	$(document).ready(function(){
		$(".changelocation").click(function(){
			$("#changelocation").toggle("slow");
		});	
	});	
	$(document).ready(function(){
		$(".deactive").click(function(){
			$("#deactive").toggle("slow");
		});	
	});	
	function closenoti() {
		$("#notification").toggle("slow");
	}
	
	function changepassword() {
		$("#chnagepassword").toggle("slow");	
	}
	function delstablenotifi(stable_id) {
		if(parseInt(stable_id)) {
			document.getElementById("notilist").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=notificationlisting;
				req.open("GET","<?php echo $html->url('/user/notificationlisting/stalenotification/');?>"+stable_id,true);	
				req.send(null);					
			}			
		}	
	}
	
	
	function delhorsenoti(horse_id) {
		if(parseInt(horse_id)) {
			document.getElementById("notilist").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=notificationlisting;
				req.open("GET","<?php echo $html->url('/user/notificationlisting/horsenotification/');?>"+horse_id,true);	
				req.send(null);					
			}			
		}	
	}	
	function delusernoti(user_id) {
		if(parseInt(user_id)) {
			document.getElementById("notilist").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=notificationlisting;
				req.open("GET","<?php echo $html->url('/user/notificationlisting/usernotification/');?>"+user_id,true);	
				req.send(null);					
			}			
		}
	}	
	
	function noti() {
			$("#notification").toggle("slow");
			document.getElementById("notilist").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=notificationlisting;
				req.open("GET","<?php echo $html->url('/user/notificationlisting/');?>",true);	
				req.send(null);					
			}
	}	
	
	function notificationlisting() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{					
				document.getElementById("notilist").innerHTML=req.responseText;				
			}
		}	
	}
</script>
<script language="javascript">
	function changenameclose() {
		$("#changename").toggle("slow");
	}	
	function changeemailclose() {
		$("#changeemail").toggle("slow");
	}	
	function changedeactiveclose() {
		$("#deactive").toggle("slow");
	}	
	function changedeactivecloseloc() {
		$("#changelocation").toggle("slow");
	}
	
	function changename() {
		var UserFirstname=document.getElementById("UserFirstname").value;
		if(UserFirstname=="") {
			document.getElementById("UserFirstname").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("UserFirstname").style.border = "1px solid #7F9DB9";
			document.getElementById("namemsg").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.open("GET","<?php echo $html->url('/user/changename/');?>"+UserFirstname,true);	
				req.send(null);					
			}
		}
	}
	
	function chkdeactivatereason() {
		var UserDeactivate=document.getElementById("UserDeactivate").value;
		if(UserDeactivate=="") {
			document.getElementById("UserDeactivate").style.border = "1px solid #FF0000";
		} 
		else {
			document.getElementById("UserDeactivate").style.border = "1px solid #7F9DB9";
			document.getElementById("deactivatemsg").innerHTML="<font color=#FF0000><em>Deactivating.....</em></font>";
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
				req.onreadystatechange=processrequest2;
				req.open("GET","<?php echo $html->url('/user/deactivateaccount/');?>"+UserDeactivate,true);	
				req.send(null);					
			}
		}
	}	
	
	function processrequest2() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==1) {		
					window.location.href='<?php e($html->url('/user/deactivateaccountsuccess'));?>'
				}		
			}
		}
	}	
	function processrequest() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==1) {		
					window.location.href='<?php e($html->url('/user/userpaiduseaccount'));?>'
				}		
			}
		}
	}	
	function chanegemail() {	
		var err=0;	
		var UserEmailAddress=document.getElementById("UserEmailAddress").value;
		if(UserEmailAddress=="") {
			document.getElementById("UserEmailAddress").style.border = "1px solid #FF0000";
			err++;		
		} 
		if(UserEmailAddress!="")  {
			if(echeck(UserEmailAddress)==false){
				document.getElementById("UserEmailAddress").style.border = "1px solid #FF0000";
				err++;		
			}		
		}		
		if(err==0) {
			document.getElementById("UserFirstname").style.border = "1px solid #7F9DB9";
			document.getElementById("emailmsg").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=processrequest1;
				req.open("GET","<?php echo $html->url('/user/chaneemail/');?>"+UserEmailAddress,true);	
				req.send(null);					
			}
		}
	}	
	function changeloc() {
		var err=0;	
		var country=document.getElementById("country").value;
		var town=document.getElementById("town").value;
		var state=document.getElementById("state").value;
		if(country=="") {
			document.getElementById("country").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("country").style.border = "1px solid #F2CE87";		
		}
		
		if(state=="") {
			document.getElementById("state").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("state").style.border = "1px solid #F2CE87";		
		}
		
		if(town=="") {
			document.getElementById("town").style.border = "1px solid #FF0000";
			err++;		
		} 
		else {
			document.getElementById("town").style.border = "1px solid #F2CE87";		
		}
		if(err==0) {			
			document.getElementById("changelocmsg").innerHTML="<font color=#FF0000><em>Please wait.....</em></font>";
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
				req.onreadystatechange=processrequest1changeloc;
				req.open("GET","<?php echo $html->url('/user/changeloc/');?>"+country+'/'+state+'/'+town,true);	
				req.send(null);					
			}		
		}		
	}	
	function processrequest1() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==1) {		
					window.location.href='<?php e($html->url('/user/userpaiduseaccount'));?>'
				}		
				else {
					document.getElementById("changelocmsg").innerHTML=req.responseText;
				}
			}
		}
	}
	
	
	function processrequest1changeloc() {
		if(req.readyState==4)
		{					
			if(req.status==200)
			{		
				if(req.responseText==1) {		
					window.location.href='<?php e($html->url('/user/userpaiduseaccount'));?>'
				}		
				else {
					document.getElementById("emailmsg").innerHTML=req.responseText;
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


		function liststate() {
			var HorseCountry=document.getElementById("country").value;
			if(parseInt(HorseCountry)) {
				document.getElementById("showregion").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestlistate;
					req.open("GET","<?php echo $html->url('/state/liststateforuser/');?>"+HorseCountry,true);	
					req.send(null);					
				}
			}
		}		
	function processrequestlistate() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("showregion").innerHTML=req.responseText;									
				}
			}
		}
	
		function listtown() {
			var Horsestate=document.getElementById("state").value;
			if(parseInt(Horsestate)) {
				document.getElementById("showtown").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestlisttown;
					req.open("GET","<?php echo $html->url('/town/listtownforuser/');?>"+Horsestate,true);	
					req.send(null);					
				}
			}		
		}
		
		function processrequestlisttown() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("showtown").innerHTML=req.responseText;									
				}
			}
		}
		
	function chngepass(){			
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
								<h3 class="big90">Name</h3>
								<hr class="line_base" />
								<p class="big92">Your real name<span class="sub52"><?php e($userarr['User']['firstname']);?></span></p>
							</div>								
							<div class="ihd25">					
								<h3 class="big90">Password</h3>
								<a href="javascript:void(0)" class="big91" onClick="changepassword()">Change</a>
								<hr class="line_base" />
								<p class="big92">What you use to log in.<span class="sub52">*******</span></p>
							</div>
							<div class="ihd25">					
								<h3 class="big90">E-mail</h3>
								<a href="javascript:void(0)" class="changeemail" style="float:right; text-align: right; width:65px; padding: 10px 20px 5px; color: #994F26; text-decoration:none; font-size: 14px;line-height: 22px;">Change</a>
								<hr class="line_base" />
								<p class="big92">Set your email contact information.<span class="sub52"><?php e($userarr['User']['email_address']);?></span></p>
							</div>
							
							<div class="ihd25">					
								<h3 class="big90">Change Location</h3>
								<a href="javascript:void(0)" class="changelocation" style="float:right; text-align: right; width:65px; padding: 10px 20px 5px; color: #994F26; text-decoration:none; font-size: 14px;line-height: 22px;">Change</a>
								<hr class="line_base" />
								<p class="big92"><span class="sub52"></span></p>
							</div>
							
							<div class="ihd25">					
								<h3 class="big90">Deactivate Membership</h3>
								<a href="javascript:void(0)" class="deactive" style="float:right; text-align: right; width:65px; padding: 10px 20px 5px; color: #994F26; text-decoration:none; font-size: 14px;line-height: 22px;">deactivate</a>
								<hr class="line_base" />
								<p class="big92"><span class="sub52"></span></p>
							</div>							
							<div class="ihd25">					
								<h3 class="big90">Extend Membership </h3>
								<a href="<?php e($html->url('/user/extendmembership'));?>" class="big91">Change</a>
								<hr class="line_base" />
								<p class="big92"><span class="sub52"></span></p>
							</div>
							<div class="ihd25">					
								<h3 class="big90">Subscriptions</h3>
								<a href="javascript:void(0)" onClick="noti()" class="big91">Manage</a>
								<hr class="line_base" />
								<p class="big92"><span class="sub52"></span></p>
							</div>
							<div class="ihd25">					
								<h3 class="big90">Edit Profile</h3>
								<a href="<?php e($html->url('/user/account'));?>" class="big91">Edit</a>
								<hr class="line_base" />
								<p class="big92"><span class="sub52"></span></p>
							</div>	
							<div class="ihd25">					
								<h3 class="big90">Edit Stable Profile</h3>
								<?php
								$stablearr=$this->requestAction('/stable/viewuserstabename');
								if(count($stablearr)>0) {
								?>
									<a href="<?php e($html->url('/stable/editstable/'.$stablearr[0]['Stable']['id']));?>" class="big91">Edit</a>
								<?php
								}
								else {
								?>
									<a href="<?php e($html->url('/stable/stableprofile/'));?>" class="big91">Edit</a>								
								<?php
								}								
								?>
								<p class="big92"><span class="sub52"></span></p>
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
	<span id="changename" style="display:none">
			<div class="pop_up_2" style="position:absolute; top:250px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Change Name</h3>
		<h4 onClick="changenameclose()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table align="center" width="100%" cellpadding="0">
			<tr>
				<td><b style="padding:7px 0 0 15px;">Name : </b></td>
				<td><?php e($form->text('User.firstname',array("size"=>"30","value"=>$userarr['User']['firstname'],"class"=>"frmtext")));?>	</td>
			</tr>	
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style="padding-left:18px"><input class="divbutton" type="button" value="Change"  style="cursor:pointer" onClick="changename()">
					<span id="namemsg"></span>			
				</td>
			</tr>
		</table>	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
	</span>		
	
	
	<span id="changeemail" style="display:none">
		<div class="pop_up_2" style="position:absolute; top:300px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Change Email</h3>
		<h4 onClick="changeemailclose()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table align="center" width="100%" cellpadding="0">
			<tr>
				<td><b style="padding:7px 0 0 15px;">Email : </b></td>
				<td><?php e($form->text('User.email_address',array("size"=>"30","value"=>$userarr['User']['email_address'],"class"=>"frmtext")));?>	</td>
			</tr>	
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style="padding-left:18px"><input class="divbutton" type="button" value="Change"  style="cursor:pointer" onClick="chanegemail()">
					<span id="emailmsg"></span>			
				</td>
			</tr>
		</table>	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
	</span>	
	
	
	
	
	<span id="chnagepassword" style="display:none">
		<div class="pop_up_2" style="position:absolute; top:300px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Change Password</h3>
		<h4 onClick="changepassword()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table align="center" width="100%" cellpadding="0">
			<tr>
				<td><b style="padding:7px 0 0 15px;">Password : </b></td>
				<td>
					<?php e($form->password('User.password',array("size"=>"30","class"=>"frmtext")));?>	
				</td>
			</tr>	
			<tr>
				<td>&nbsp;</td>
			</tr>
			
			<tr>
				<td><b style="padding:7px 0 0 15px;">New Password : </b></td>
				<td>
					<?php e($form->password('User.newpassword',array("size"=>"30","class"=>"frmtext")));?>	
				</td>
			</tr>
			
			<tr>
				<td>&nbsp;</td>
			</tr>
			
			<tr>
				<td><b style="padding:7px 0 0 15px;">Confirm Password : </b></td>
				<td>
					<?php e($form->password('User.conpassword',array("size"=>"30","class"=>"frmtext")));?>	
				</td>
			</tr>
			
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style="padding-left:18px"><input class="divbutton" type="button" value="Change"  style="cursor:pointer" onClick="chngepass()">
					<br><span id="passmsg"></span>			
				</td>
			</tr>
		</table>	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>
	</span>
	
	
	
	<span id="deactive" style="display:none">			
			<div class="pop_up_2" style="position:absolute; top:300px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Deactivate Account</h3>
		<h4 onClick="changedeactiveclose()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table align="center" width="100%" cellpadding="0">
			<tr>
				<td valign="top"><b style="padding:7px 0 0 15px;">Deactivation Reason : </b></td>
				<td><?php e($form->textarea('User.deactivate',array("rows"=>"4","cols"=>35,"class">"textareaclass")));?>	</td>
			</tr>	
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style="padding-left:18px"><input class="divbutton" type="button" value="Submit"  style="cursor:pointer" onClick="chkdeactivatereason()">
					<span id="deactivatemsg"></span>			
				</td>
			</tr>
		</table>	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>		
	</span>	
	
	
	<span id="changelocation" style="display:none">			
			<div class="pop_up_2" style="position:absolute; top:300px; left:240px; border: 1px solid #EFBB7A;" >
		<h3 class="dilraj">Change Location</h3>
		<h4 onClick="changedeactivecloseloc()" style="cursor:pointer">close x</h4>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<table align="center" width="100%" cellpadding="0">
			<tr>
				<td valign="top"><b style="padding:7px 0 0 15px;">Country : </b></td>
				<td>
					<select name="country" id="country" class="dropdown" onChange="liststate()">
						<option value="">Select  Country </option>
						<?php
						if(count($country_arr)>0) {
							foreach($country_arr as $key=>$val) :
								if($val['Country']['id']==$userarr['User']['countryid']) {
									$sel='selected=selected';
								}
								else {
									$sel='';
								}
								e("<option value=".$val['Country']['id']." $sel>".$val['Country']['country']."</option>");							
							endforeach;						
						}
						?>
						</select>				
				</td>
			</tr>	
			
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr>
				<td valign="top"><b style="padding:7px 0 0 15px;">State : </b></td>
				<td>
					<span id="showregion">
						<select name="state" id="state" class="dropdown" onChange="listtown()">
							<option value="">Select  State </option>
							<?php
							if(count($state_arr)>0) {
								foreach($state_arr as $key=>$val) :
									if($val['State']['id']==$userarr['User']['state_id']) {
										$sel='selected=selected';
									}
									else {
										$sel='';
									}
									e("<option value=".$val['State']['id']." $sel>".$val['State']['statename']."</option>");							
								endforeach;						
							}
							?>
							</select>	
						</span>			
				</td>
			</tr>
			
			
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr>
				<td valign="top"><b style="padding:7px 0 0 15px;">Town : </b></td>
				<td>
					<span id="showtown">
							<select name="town" id="town" class="dropdown">
								<option value="">Select  Town </option>
								<?php
								if(count($town_arr)>0) {
									foreach($town_arr as $key=>$val) :
										if($val['Town']['id']==$userarr['User']['town_id']) {
											$sel='selected=selected';
										}
										else {
											$sel='';
										}
										e("<option value=".$val['Town']['id']." $sel>".$val['Town']['town']."</option>");							
									endforeach;						
								}
								?>
								</select>	
					</span>			
				</td>
			</tr>	
			
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td></td>
				<td align="left" style="padding-left:18px"><input class="divbutton" type="button" value="Submit"  style="cursor:pointer" onClick="changeloc()">
					<span id="changelocmsg"></span>			
				</td>
			</tr>
		</table>	
		<p>&nbsp;</p>
		<p>&nbsp;</p>
		<p>&nbsp;</p>
	</div>		
	</span>	
	
	<span id="notification" style="display:none">
		<div class="pop_up_2" style="position:absolute; top:300px; left:240px; border: 1px solid #EFBB7A;" >
			<span id="notilist">
			
			</span>
		</div>
	</span>
	
</body>
</html>