<?php e($this->renderElement('header_logon'));?> 
<script language="javascript">
function moreimg() {
		var hiddval=document.getElementById("hiddval").value;
		hiddval++;
		var i;
		var msg='';
		msg='<br>'
		if(hiddval) {
			for(i=1;i<=hiddval;i++) {
				msg=msg+"<span id=imagsh_"+i+"><input type=file class=button1 name=img_"+i+" class=look id=img_"+i+">&nbsp&nbsp;<input type=button value=Cancel class=button onclick=can('"+i+"') id=can_"+i+" style=cursor:pointer><br></span>";			
			}	
			document.getElementById("imgval").innerHTML=msg;
		}
		document.getElementById("hiddval").value=hiddval;
	}	
	function can(no) {
		if(no) {
			document.getElementById("img_"+no).style.display="none";
			document.getElementById("can_"+no).style.display="none";
			document.getElementById("imagsh_"+no).style.display="none";			
			no--;
			document.getElementById("hiddval").value=no ;
		}
	}
	function listingextinghorse() {
		document.getElementById("listhorse").style.display="block";
		document.getElementById("horsemessage").style.display="none";
		var horsename=document.getElementById("HorseName").value;
		var len=horsename.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorse;
					req.open("GET","<?php echo $html->url('/horse/listhorseindatabase/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listhorse").innerHTML="" ;
			}
	}	
	
	function assignoffspring(horsename) {
		document.getElementById("Offspring").value=horsename;
		document.getElementById("listforoffspring").style.display="none";
	}	
	function listoffspring() {
		var horsename=document.getElementById("Offspring").value;
		var len=horsename.length;
			if(len>1){
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
					req.onreadystatechange=listoffspringoff;
					req.open("GET","<?php echo $html->url('/horse/listoffspring/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listforoffspring").innerHTML="" ;
			}	
	}
	
	function listoffspringoff() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listforoffspring").innerHTML=req.responseText					
				}
			}		
		}
	
		
	function listmemberowner() {
		document.getElementById("listowner").style.display="block";
		var HorseOwnername=document.getElementById("HorseOwnername").value;
		var len=HorseOwnername.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorselistowner;
					req.open("GET","<?php echo $html->url('/horse/listownerallforadmin/');?>"+HorseOwnername,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listowner").innerHTML="" ;
			}
	}	
	
	function liststable() {
		var HorseStablename=document.getElementById("HorseStablename").value;
		document.getElementById("liststb").style.display="block";
		var len=HorseStablename.length;
			if(len>1){
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
					req.onreadystatechange=processrequestliststableall;
					req.open("GET","<?php echo $html->url('/horse/liststablealladmin/');?>"+HorseStablename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("liststb").innerHTML="" ;
			}	
	}
		
	function listbred() {
		var HorseBredName=document.getElementById("HorseBredName").value;
		document.getElementById("listbed").style.display="block";
		var len=HorseBredName.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlistbredall;
					req.open("GET","<?php echo $html->url('/horse/listbredalladmin/');?>"+HorseBredName,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listbed").innerHTML="" ;
			}	
	}	
	
	function assignbred(stable_id,stable_name) {
		document.getElementById("HorseBredName").value=stable_name;
		document.getElementById("listbed").style.display="none";
	}	
	function processrequestliststableall() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					if(req.responseText==0) {
						//document.getElementById("HorseStablename").value='';
					}
					else {
						document.getElementById("liststb").innerHTML=req.responseText
					}					
				}
			}
		}	
		
		function processrequestlistbredall() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listbed").innerHTML=req.responseText					
				}
			}		
		}			
		function assignstable(stable_id,stable_name) {
			document.getElementById("HorseStablename").value=stable_name;
			document.getElementById("liststb").style.display="none";
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
					req.onreadystatechange=liststableallcountrytownn;
					req.open("GET","<?php echo $html->url('/horse/liststableallcountrytownnadmin/');?>"+stable_id,true);	
					document.getElementById("loc").innerHTML="<font color=#FF0000>Please wait....</font>";
					req.send(null);					
				}
		}
		
		function liststableallcountrytownn() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("loc").innerHTML=req.responseText					
				}
			}
		}		
		
		function notliststable() {
			document.getElementById("liststb").style.display="none";
		}
		
	 function processrequestlisthorselistowner() {
		if(req.readyState==4)
			{				
				if(req.status==200)
				{			
					document.getElementById("listowner").innerHTML=req.responseText					
				}
			}
		}			
	function notlistmemberowner() {
		document.getElementById("listowner").style.display="none";
	}	
	function assignowner(firstname,lastname,user_id) {
		document.getElementById("HorseOwnername").value=firstname+" "+lastname;
		document.getElementById("listowner").style.display="none";
		document.getElementById("hiddownerid").value=user_id;
	}	
	function assignmember(firstname,lastname,breederid) {
		document.getElementById("hiddbreederid").value=breederid;
		document.getElementById("HorseBreeder").value=firstname+" "+lastname;
		document.getElementById("listmem").style.display="none";
	}		
	function listmemberall() {
		document.getElementById("listmem").style.display="block";
		var HorseBreeder=document.getElementById("HorseBreeder").value;
		var len=HorseBreeder.length;
			if(len>1){
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
					req.onreadystatechange=processrequestlisthorsemember;
					req.open("GET","<?php echo $html->url('/horse/listallmemberadmin/');?>"+HorseBreeder,true);	
					req.send(null);					
				}		
			}
		if(len<=1) {
			document.getElementById("listmem").innerHTML="" ;
		}
	}		
		function notlistmemberall() {
			document.getElementById("listmem").style.display="none";
		}
		function processrequestlisthorsemember() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{	
					document.getElementById("listmem").innerHTML=req.responseText					
				}
			}
		}
	
	function listingextinghorsesire() {
		document.getElementById("listsirehorse").style.display="block";
		var horsename=document.getElementById("HorseSire").value;
		var len=horsename.length;
		if(len>1){
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
					req.onreadystatechange=processrequestlisthorsesire;
					req.open("GET","<?php echo $html->url('/horse/listsirehorsedatabaseadmin/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listsirehorse").innerHTML="" ;
			}
		}		
		function assignsire(horsename) {
			document.getElementById("HorseSire").value=horsename;
			document.getElementById("listsirehorse").style.display="none";
		}		
		function assigndam(horsename) {
			document.getElementById("HorseDam").value=horsename;
			document.getElementById("listsiredam").style.display="none";
		}	
		
		function showdeathfild() {
			document.getElementById("deathfield").style.display="block" ;
		}		
		function dontshowdeathfild(){
			document.getElementById("deathfield").style.display="none" ;		
		}		
		function showregister() {
			document.getElementById("regcode").style.display="block" ;
		}
		function dontshowregister() {
			document.getElementById("regcode").style.display="none" ;
		}	
	function listingextinghorsedam() {
		document.getElementById("listsiredam").style.display="block";
		var horsename=document.getElementById("HorseDam").value;
		var len=horsename.length;
		if(len>1){
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
					req.onreadystatechange=processrequestlisthorsedam;
					req.open("GET","<?php echo $html->url('/horse/listdamhorsedatabaseadmin/');?>"+horsename,true);	
					req.send(null);					
				}		
			}
			if(len<=1) {
				document.getElementById("listsiredam").innerHTML="" ;
			}
		}		
		
		function notlistingextinghoredam() {
			document.getElementById("listsiredam").style.display="none";
		}		
		function processrequestlisthorsedam() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listsiredam").innerHTML=req.responseText					
				}
			}
		}	
	function processrequestlisthorsesire() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listsirehorse").innerHTML=req.responseText					
				}
			}
		}		
		function processrequestlisthorse() {
			if(req.readyState==4)
			{					
				if(req.status==200)
				{			
					document.getElementById("listhorse").innerHTML=req.responseText					
				}
			}
		}		
		function notlistingextinghorsesire() {
			document.getElementById("listsirehorse").style.display="none";
		}			
	function noofimages() {
		var num=document.getElementById("num").value;
		var msg='';
		var divval='';
		var cntr=0;
		var divclass='';
		if(parseInt(num)) {	
				if(num>8) {
					msg='<font color=#FF0000><em><b>You cannot upload more than 8 pictures </b></em></font>'
				}
				else {
					document.getElementById("hiddval").value=parseInt(num);
					for(i=1;i<=num;i++) {
						if(cntr%2==0) {
							divclass='left';
						}
						else {
							divclass='right';
						}
						divval='<div class='+divclass+'><div class=pox style="padding:6px 10px; 0 0"><strong>Image '+i+':</strong><input  type="file"  name=image_'+i+'></div></div>';
						msg=msg+divval;	
						cntr++;			
					}	
					msg=msg+'<input class="submit_btn100" type="submit" value="Upload" />';
				}
				document.getElementById("imgshow").innerHTML=msg;	
							
			}		
		}	
		function chkhorse() {
			document.getElementById("listhorse").style.display="none";
			document.getElementById("horsemessage").style.display="block";
			var horsename=document.getElementById("HorseName").value;
			var len=horsename.length;
			if(len>2){
				document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>Checking please wait ......</em></b></font>";
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
					req.open("GET","<?php echo $html->url('/horse/chkhorse/');?>"+horsename,true);	
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
						//document.getElementById("valid").disabled=true;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>This horse exists</em></b></font>";
					}
					else {
						//document.getElementById("valid").disabled=false;
						document.getElementById("horsemessage").innerHTML="<font color=#FF0000><b><em>You can use this horse</em></b></font>";
					}						
				}
			}
		}	
	 function liststate() {
			var HorseCountry=document.getElementById("HorseCountry").value;
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
					req.open("GET","<?php echo $html->url('/state/liststate/');?>"+HorseCountry,true);	
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
			var Horsestate=document.getElementById("Horsestate").value;
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
					req.open("GET","<?php echo $html->url('/town/listtown/');?>"+Horsestate,true);	
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
	</script>
<table width="98%" border="0" cellspacing="0" cellpadding="5" align="center">
<tr>
	<td>
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td valign="top" align="left"  class="page_heading_small"><?php e($html->image('icon_control_panel.gif', array('border'=>'0','alt'=>'','align'=>'absmiddle'))); ?>&nbsp;Add Horse </td>
			</tr> 
		</table>
	</td>
</tr>
<tr>
	<td valign="top" align="left" class="box">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width="100%" align="center">
			<form name="frm" id="event" method="post" action="" enctype="multipart/form-data">	
			<?php e($form->hidden('Horse.posted_date',array("value"=>date('Y-m-d')))); ?>			
				<table width="92%" border="0" cellspacing="1" cellpadding="5" align="center" class="header_bordercolor" style="background-color:#FFFFFF;">
				  <tr class="header_bgcolor" height="26">
					<td colspan="2" class="headertext"><b>&nbsp;Add Horse </b></td>
				  </tr>				  
				  <tr class="even_tr">
					<td colspan="2" align="center" class="err"><b>Note</b> : * fields are mandatory.</td>
				  </tr>						  			  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Horse Name <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Horse.name',array("size"=>"30","class"=>"look","onchange"=>"chkhorse()","onkeypress"=>"listingextinghorse()","autocomplete"=>"off")); ?>
						<br />
						<span id="listhorse" class="listhorseview" style="overflow:visible;position:relative; padding-left:-5px;"></span>
						<span id="horsemessage"></span>
						<input type="checkbox" name="data[Horse][nameunknownoption]" value="Y" id="nameunknownoption"><font color="#994F26"> Unknown</font>
					</td>
				 </tr>	
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Gender <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][gender]" class="look" size="1" id="gender">
									<option value="">Select Gender </option>
									<?php
									if(is_array($genderarr)) {
										foreach($genderarr as $key=>$val) :
											e("<option value=".$val['Gender']['id'].">".$val['Gender']['gender']."</option>");
										endforeach;
									}
									?>
								</select>
						 <br><span class="error"><?php echo $form->error('Horse.gender');?>
						 </span>
					</td>
				 </tr>	
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Breed <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][breed_id]" class="look">
							<option value="">Select Breed </option>
							<?php
							if(is_array($breed_arr)) {
								foreach($breed_arr as $key=>$val) :
									if($val['Breed']['id']==$breed_id) {
										$sel="selected=selected";
									}
									else {
										$sel='';
									}
									e("<option value=".$val['Breed']['id']." $sel>".$val['Breed']['breed']."</option>");
								
								endforeach;							
							}					
							?>						
						</select>
						 <br><span class="error"><?php echo $form->error('Horse.breed_id');?>
						 </span>
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Year: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Horse.year',array("class"=>"look","size"=>"30")); ?>
				   </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Deceased : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <input type="radio" id="diedyes" name="data[Horse][deathstat]" value="Y" onClick="showdeathfild()">
									<font color="#994F26">Yes</font> <input type="radio" id="diedno" name="data[Horse][deathstat]" value="N" onClick="dontshowdeathfild()" checked="checked">
									<font color="#994F26">No</font>
									<div id="deathfield" style="display:none;" align="left">	
										<br>
										<p>Year of death :	</p>													
                                 		<input type="text" class="look" name="data[Horse][yearofdeath]" id="year" size="30">   
										<br>
									</div> 
				   </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Sire : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Horse.sire',array("size"=>"30","class"=>"look","onkeypress"=>"listingextinghorsesire()","autocomplete"=>"off")); ?>
						 <span id="listsirehorse" style="overflow:visible;"></span>
						 <input type="checkbox" name="data[Horse][sireunknowoption]" value="Y"><font color="#994F26"> Unknown</font>
					 </td>
				 </tr>
				 
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Dam: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->text('Horse.dam',array("size"=>"30","class"=>"look","onkeypress"=>"listingextinghorsedam()","autocomplete"=>"off")); ?>
						<span id="listsiredam" style="overflow:visible;"></span>
						<input type="checkbox" name="data[Horse][damunknownoption]" value="Y"><font color="#994F26"> Unknown</font>
					 </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Height <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][height_id]" class="look">
							<option value="">Select height </option>
							<?php
							if(is_array($height_arr)) {
								foreach($height_arr as $key=>$val) :
									if($val['Height']['id']==$height_id) {
										$sel="selected=selected";
									}
									else {
										$sel='';
									}
									e("<option value=".$val['Height']['id']." $sel>".$val['Height']['height']."</option>");
								
								endforeach;							
							}					
							?>						
						</select>
						 <br><span class="error"><?php echo $form->error('Horse.height_id');?>
						 </span>
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Coatcolor <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][coatcolor_id]" class="look">
							<option value="">Select Coatcolor </option>
							<?php
							if(is_array($coatcolor_arr)) {
								foreach($coatcolor_arr as $key=>$val) :
									if($val['Coatcolor']['id']==$coatcolor_id) {
										$sel="selected=selected";
									}
									else {
										$sel='';
									}
									e("<option value=".$val['Coatcolor']['id']." $sel>".$val['Coatcolor']['color']."</option>");
								
								endforeach;							
							}					
							?>						
						</select>
						 <br><span class="error"><?php echo $form->error('Horse.coatcolor_id');?>
						 </span>
					</td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Registered: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 			<font color="#994F26">Yes</font> <input type="radio" name="data[Horse][registered]" value="Y"  onClick="showregister()">	
																			&nbsp;&nbsp;<font color="#994F26">No</font>
																			<input type="radio" name="data[Horse][registered]" checked="checked" value="N" onClick="dontshowregister()">
									<div id="regcode" style="display:none;" align="left">	
										<br>
										<p>Number :	</p>													
                                 		<input type="text" name="data[Horse][registration_code]" id="registrationcode" size="30" class="look">  
										<br>
									</div> 
				   </td>
				 </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Bloodline: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Horse.bloodline',array("class"=>"look","size"=>"30")); ?>
					 </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text"> Breeder: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->text('Horse.breeder',array("size"=>"30","class"=>"look"," onkeypress"=>"listmemberall()","autocomplete"=>"off")); ?>
						<span id="listmem" style="overflow:visible;"></span>
					</td>
				 </tr>	
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text"> Owner: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->text('Horse.ownername',array("size"=>"30","class"=>"look","onkeypress"=>"listmemberowner()","autocomplete"=>"off")); ?>
						 <span id="listowner" style="overflow:hidden; padding-left:15px"></span>
					</td>
				 </tr> 	
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Stable: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->text('Horse.stablename',array("size"=>"30","onkeypress"=>"liststable()","autocomplete"=>"off")); ?>
						<span id="liststb" style="overflow:visible;"></span>
					 </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Horse  Image <span class="err">*</span>: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->file('Horse.image',array("class"=>"look")); ?>
						 <input name="button" type="button" class="button" onclick="moreimg()" value="More"/>
               			 <br />
                      <span id="imgval"> </span>
                      <input type="hidden" id="hiddval" value="" name="hiddval" />
					</td>
				 </tr>
				 <tr class="even_tr">
				 <td width="30%" align="left" valign="top" class="bold_text">&nbsp; </td>
				 	<td>
					 <span id="loc">	
					 <table> 
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Country: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][countryid]" class="dropdown" id="HorseCountry" onChange="liststate()">
								<option value="">Select Country </option>
								<?php
								if(is_array($country_arr)) {
									foreach($country_arr as $key=>$val) :									
										e("<option value=".$val['Country']['id'].">".$val['Country']['country']."</option>");								
									endforeach;							
								}					
								?>						
							</select>
							<br><span class="error"><?php echo $form->error('Stable.countryid');?>
					</td>
				  </tr>			  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">State: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
							<span id="showregion">
								<select name="data[Horse][state_id]" class="dropdown" id="Horsestate" onChange="listtown()">
									<option value="">Select state  </option>
									<?php
									if(is_array($state_arr)) {
										foreach($state_arr as $key=>$val) :									
											e("<option value=".$val['State']['id'].">".$val['State']['statename']."</option>");								
										endforeach;							
									}					
									?>						
								</select>	
							</span>
							<br><span class="error"><?php echo $form->error('Stable.state_id');?>
					</td>
				  </tr>
				  
				  
				   <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Town/Region: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<span id="showtown">
								<select name="data[Horse][town_id]" class="dropdown" id="HorseLocation" >
									<option value="">Select Town/Region  </option>
									<?php
									if(is_array($town_arr)) {
										foreach($town_arr as $key=>$val) :									
											e("<option value=".$val['Town']['id'].">".$val['Town']['town']."</option>");								
										endforeach;							
									}					
									?>						
								</select>	
							</span>
							<br><span class="error"><?php echo $form->error('Stable.town_id');?>
					</td>
				  </tr>	
				  </table>
				  </span>	
				  </td>
				  </tr>
				  <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Born at: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<?php echo $form->text('Horse.bred_name',array("size"=>"30","onkeypress"=>"listbred()","autocomplete"=>"off")); ?>
						 <span id="listbed" style="overflow:visible; z-index:85000000; position: absolute; left: 25px;"></span>
					 </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Prize won: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->text('Horse.prize_won',array("class"=>"look","size"=>"30")); ?>
					 </td>
				 </tr>
				 <tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Select Sales Status <span class="err">*</span> : </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						<select name="data[Horse][sales_status]" class="look">
							<option value="" selected="selected"></option>
							<option value="S">For Sale </option>	
							<option value="Stud" <?php if($sales_status=="Stud") { ?> selected="selected" <?php } ?>>For Stud </option>	
							<option value="Notsale" <?php if($sales_status=="Notsale") { ?> selected="selected" <?php } ?>>Not For Sale </option>
						</select>						 
					</td>
				 </tr>				 						  
				 	<tr class="even_tr" style="padding:10px;">
					<td width="30%" align="left" valign="top" class="bold_text">Other Details: </td>
					<td width="70%" align="left" valign="top" class="smalltext">
						 <?php echo $form->textarea('Horse.other_details',array("class"=>"look","rows"=>"8","cols"=>"82")); ?>
						  <br><span class="error"><?php echo $form->error('Horse.other_details');?>
						 </span>
					 </td>
				 </tr> 		 				 			 
				  <tr class="even_tr">
				  	<td>&nbsp;</td>
					<td align="left" class="bold_text" valign="top">
						<input type="submit" value="Save" class="button">
						&nbsp;&nbsp;&nbsp;
						<input type="button" class="button" value="Cancel" onClick="javascript: location.href='<?php echo $html->url('/horse') ;?>'" />					</td>
				  </tr>
  			  </table>
			</form>
		</td>
	</tr>		
</table>
</td>
</tr>
</table>
<?php e($this->renderElement('footer_logon'));?> 
