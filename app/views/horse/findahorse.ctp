<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
	function details(hornamename,horseid) {
		if(parseInt(horseid)) {
			window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
		}	
	}
	function stabledetails(stableid) {
		if(parseInt(stableid)) {
			window.location.href='<?php e($html->url('/stable/viewprofile/'));?>'+stableid;		
		}	
	}	
	function userdetails(user_id) {
		if(user_id) {
			window.location.href='<?php e($html->url('/user/viewaccount/'));?>'+user_id;		
		}
	}	
	function gotostable() {
		window.location.href='<?php e($html->url('/horse/findstable/'));?>';
	}
	function findmembers() {
		window.location.href='<?php e($html->url('/horse/findamembers/'));?>';
	}
	
	function resethrinfo() {
		document.getElementById("horsename").value="Enter name" ;	
		document.getElementById("gender").value="" ;
		document.getElementById("height").value="" ;	
		document.getElementById("color").value="" ;		
		document.getElementById("breed").value="" ;			
		document.getElementById("age").value="" ;		
		document.getElementById("ownername").value="Enter name" ;	
		document.getElementById("breedname").value="Enter name" ;	
		document.getElementById("location").value="Enter name" ;	
	}
	function resetstableinfo() {
		document.getElementById("stablename").value="Enter name" ;	
		document.getElementById("stablelocation").value="Enter name" ;
	}	
	function resetbreesearchinfo() {
		document.getElementById("breedername").value="enter breeder name" ;
		document.getElementById("breederlocation").value="Enter location" ;
	}	
</script>
<script language="javascript">
	function horsesearchtab() {
		document.getElementById("horsearchtb").className ="personal_info22_active" ;	
		document.getElementById("horsesearch").style.display="block";
		document.getElementById("stablesearchtb").className ="payment_details22" ;	
		document.getElementById("stablehearch").style.display="none";
		document.getElementById("breedersearchtb").className ="email_confirmation22" ;	
		document.getElementById("breedsearch").style.display="none"	
		
		document.getElementById("stablesearchresult").style.display="none"	
		document.getElementById("horsesearchresult").style.display="block";
		document.getElementById("membersearch").style.display="none"
		
	}
	function stablesearchtab() {
		document.getElementById("horsearchtb").className ="personal_info22" ;	
		document.getElementById("horsesearch").style.display="none";
		document.getElementById("stablesearchtb").className ="payment_details22_active" ;	
		document.getElementById("stablehearch").style.display="block";
		document.getElementById("breedersearchtb").className ="email_confirmation22" ;	
		document.getElementById("breedsearch").style.display="none"	;
		
		document.getElementById("stablesearchresult").style.display="block"	
		document.getElementById("horsesearchresult").style.display="none";
		document.getElementById("membersearch").style.display="none"
		
	}
	function breedersearchtab() {
		document.getElementById("horsearchtb").className ="personal_info22" ;	
		document.getElementById("horsesearch").style.display="none";
		document.getElementById("stablesearchtb").className ="payment_details22" ;	
		document.getElementById("stablehearch").style.display="none";
		document.getElementById("breedersearchtb").className ="email_confirmation22_active" ;	
		document.getElementById("breedsearch").style.display="block"	
		
		document.getElementById("stablesearchresult").style.display="none"	
		document.getElementById("horsesearchresult").style.display="none";
		document.getElementById("membersearch").style.display="block"
		
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
					req.open("GET","<?php echo $html->url('/state/liststateforsearch/');?>"+HorseCountry,true);	
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
					req.open("GET","<?php echo $html->url('/town/listtownforsearch/');?>"+Horsestate,true);	
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
		
		function liststatblestate() {
			var countrystable=document.getElementById("countrystable").value;
			if(parseInt(countrystable)) {
				document.getElementById("stablest").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestliststablestate;
					req.open("GET","<?php echo $html->url('/state/liststablestate/');?>"+countrystable,true);	
					req.send(null);					
				}
			}						
		}		
		function processrequestliststablestate() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("stablest").innerHTML=req.responseText;									
				}
			}
		}	
		
		function liststabletownshow() {
			var stablestate=document.getElementById("stablestate").value;
			if(parseInt(stablestate)) {
				document.getElementById("stabletwn").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestliststabletown;
					req.open("GET","<?php echo $html->url('/town/liststabletown/');?>"+stablestate,true);	
					req.send(null);					
				}
			}	
		}		
		function processrequestliststabletown() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("stabletwn").innerHTML=req.responseText;									
				}
			}		
		}			
		function listmemberstate() {
			var membercountry=document.getElementById("membercountry").value;
			if(parseInt(membercountry)) {
				document.getElementById("memstate").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestmembercountry;
					req.open("GET","<?php echo $html->url('/state/listmemstate/');?>"+membercountry,true);	
					req.send(null);					
				}
			}	
		}		
		function processrequestmembercountry() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("memstate").innerHTML=req.responseText;									
				}
			}			
		}	
		
		function listmembertownshow() {
			var memberstate=document.getElementById("memberstate").value;
			if(parseInt(memberstate)) {
				document.getElementById("memtown").innerHTML="<font color=#FF0000>Please wait....</font>";
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
					req.onreadystatechange=processrequestlistmemtownall;
					req.open("GET","<?php echo $html->url('/town/listmemtownall/');?>"+memberstate,true);	
					req.send(null);					
				}
			}
		}
		
		function processrequestlistmemtownall() {
			if(req.readyState==4)
			{				
				if(req.status==200)
				{							
					document.getElementById("memtown").innerHTML=req.responseText;									
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
							<div id="searchwrapperreyeng">
								<div id="searchthreecolumntabsreyeng">
									<div <?php if($searchcriteria==""|| $searchcriteria=="Horse") { ?>class="personal_info22_active" <?php } else { ?> class="personal_info22" <?php } ?> id="horsearchtb" onClick="horsesearchtab()">Horses
									</div>
									<div <?php if($searchcriteria=="Stable")  { ?> class="payment_details22_active" <?php } else { ?> class="payment_details22" <?php } ?> id="stablesearchtb" onClick="gotostable()" >Stables
									</div>
								</div>
								<form action="" method="get" name="frm" style="margin-top: 33px;">
									<span id="horsesearch"  <?php if($searchcriteria==""|| $searchcriteria=="Horse") { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>							
										<div class="profile_info">													
											<div class="po_inf_mid">
												<div class="searchnamegenderboxreyeng">
													<div class="searchfilterwrapperreyeng float_left">
														<label class="formarea">Name:</label>
														<input class="visson" name="horsename" id="horsename" type="text" <?php if($horsename!="") { ?> value="<?php e($horsename);;?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';" />
													</div>
													<div class="searchfilterwrapperreyeng float_right">
														<label class="formarea">Gender:</label>
														<select name="gender" id="gender" size="1" class="dropdown98">
															<option selected="selected" value=""></option>
															<?php
															if(is_array($genderarr)) {
															foreach($genderarr as $key=>$val) :
															if($gender==$val['Gender']['id']) {
															$sel='selected=selected';
															}
															else {
															$sel='';
															}
															e("<option value=".$val['Gender']['id']." $sel>".$val['Gender']['gender']."</option>");
															endforeach;
															}
															?>
														</select>
													</div>
												</div>
												<div class="clear"></div>
												<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
												<h3 class="xo">Filter Results</h3>	
													<div class="fonto">		
														<div class="form_box59">
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Breed:</label>
																<select name="breed" id="breed" size="1" class="dropdown98">
																	<option selected="selected"></option>
																	<?php
																	if(is_array($breed_arr)) {
																	foreach($breed_arr as $key=>$val) :	
																	if($val['Breed']['id']==$breed) {
																	$sel='selected=selected' ;
																	}
																	else {
																	$sel='';
																	}							
																	e("<option value=".$val['Breed']['id']." $sel>".$val['Breed']['breed']."</option>");
																	endforeach;							
																	}					
																	?>
																</select>
																<div class="clear"></div>
															</div>	
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Age:</label>
																<select name="age" size="1" class="dropdown98">
																	<option selected="selected"></option>
																	<?php
																	for($i=1;$i<=25;$i++) {
																	if($i==$age) {
																	$sel='selected=selected';
																	}
																	else {
																	$sel='';
																	}
																	e("<option value=".$i." $sel>".$i."</option>");										  
																	}											  
																	?>
																</select>
																<div class="clear"></div>		
															</div>									
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Height:</label>
																<select name="height" id="height" size="1" class="dropdown98">
																	<option selected="selected" value=""></option>
																	<?php
																	if(is_array($height_arr)) {
																	foreach($height_arr as $key=>$val) :
																	if($val['Height']['id']==$height) {
																	$sel='selected=selected' ;
																	}
																	else {
																	$sel='';
																	}	
																	e("<option value=".$val['Height']['id']." $sel>".$val['Height']['height']."</option>");								
																	endforeach;							
																	}					
																	?>
																</select>
																<div class="clear"></div>	
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Color:</label>
																<select name="color"  id="color" size="1" class="dropdown98">
																<option selected="selected"></option>
																	<?php
																	if(is_array($coatcolor_arr)) {
																	foreach($coatcolor_arr as $key=>$val) :
																	if($val['Coatcolor']['id']==$color) {
																	$sel='selected=selected' ;
																	}
																	else {
																	$sel='';
																	}
																	e("<option value=".$val['Coatcolor']['id']." $sel>".$val['Coatcolor']['color']."</option>");								
																	endforeach;							
																	}					
																	?>
																</select>
																<div class="clear"></div>		
															</div>						
														</div>										
														<div class="form_box59">
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Owner:</label>
																<input class="visson" name="ownername" id="ownername" type="text" <?php if($ownername!="") { ?> value="<?php e($ownername);;?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Breeder:</label>
																<input class="visson" name="breedname" id="breedname" type="text" <?php if($breedname!="") { ?> value="<?php e($breedname);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>							
															</div>													
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Sire:</label>
																<input class="visson" name="sire" id="sire" type="text" <?php if($sire!="") { ?> value="<?php e($sire);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Dam:</label>
																<input class="visson" name="dam" id="dam" type="text" <?php if($dam!="") { ?> value="<?php e($dam);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';"/>
																<div class="clear"></div>			
															</div>							
														</div>
														<div class="form_box59">											
															<div class="clear"></div>						
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Registered:</label>
																<select name="registeredstatus" class="dropdown98" id="registeredstatus" >
																	<option value="">All Horses </option> 
																	<option value="Y" <?php if($registeredstatus=="Y") { ?> selected="selected" <?php } ?>>Registered </option> 
																	<option value="N" <?php if($registeredstatus=="N") { ?> selected="selected" <?php } ?>>Not Registered </option> 											
																</select>
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Country:</label>
																<select name="country_id" class="dropdown98" id="HorseCountry" onChange="liststate()">
																	<option value="">Select Country </option>
																	<?php
																	if(is_array($country_arr)) {
																	foreach($country_arr as $key=>$val) :	
																	if($val['Country']['id']==$country_id) {
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
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">State:</label>
																<span id="showregion">
																	<select name="state_id" class="dropdown98" id="Horsestate" onChange="listtown()">
																		<option value="">Select state  </option>
																		<?php
																		if(is_array($state_arr)) {
																		foreach($state_arr as $key=>$val) :		
																		if($val['State']['id']==$state_id) {
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
																<div class="clear"></div>
															</div>
															<div class="searchfilterwrapperreyeng">
																<label class="formarea">Town/Region:</label>
																<span id="showtown">
																	<select name="town_id" class="dropdown98" id="HorseLocation" >
																		<option value="">Select Town </option>
																		<?php
																		if(is_array($town_arr)) {
																		foreach($town_arr as $key=>$val) :
																		if($val['Town']['id']==$town_id) {
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
															</div>
															<div class="clear"></div>
														</div>
														<div class="clear"></div>
													</div>	
													<input class="button-reyeng" type="submit" value="Search"  name="horsesearch"/>
													<input class="button-reyeng" type="button" value="Reset"  name="resethorseinfo" onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>								
												</div>
											</div>								
										</span>
										<span id="stablehearch" <?php if($searchcriteria=="Stable") { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
											<div class="profile_info_search" style="margin-top: 30px;">
												<div class="po_inf_mid" style="margin: 18px 0 0; padding-top:60px;">
													<div class="form_box">
														<label class="formarea"> <strong>Name :</strong></label>
														<input name="stablename"  id="stablename" <?php if($stablename!="") { ?> value="<?php e($stablename);?>" <?php }  else { e("value='enter stable name'"); } ?> type="text" size="30" value="enter stable name" onFocus="if(this.value=='enter stable name')this.value='';" onBlur="if(this.value=='')this.value='enter stable name';"/>
														<div class="clear"></div>
													</div>
													<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
													<h3 class="xo">Filter Results</h3>																	
													<div class="form_box">
														<label class="formarea"> <strong>Country:</strong></label>
														<select name="countrystable"  id="countrystable" class="dropdown98" onChange="liststatblestate()">
															<option value=""></option>
															<?php
															if(is_array($country_arr)) {
															foreach($country_arr as $key=>$val) :	
															if($val['Country']['id']==$countrystable) {
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
														<div class="clear"></div>
													</div>					
													<div class="form_box">
														<label class="formarea"> <strong>State:</strong></label>
														<span id="stablest">
															<select name="stablestate"  id="stablestate" class="dropdown98" onChange="liststabletownshow()">
																<option value=""></option>
																<?php
																if(is_array($statestatearr)) {
																foreach($statestatearr as $key=>$val) :	
																if($val['State']['id']==$stablestate) {
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
														<div class="clear"></div>
													</div>						
													<div class="form_box">
														<label class="formarea"> <strong>Town/Region:</strong></label>
														<span id="stabletwn">
															<select name="stabletownid"  id="stabletownid" class="dropdown98"> 
																<option value=""></option>
																<?php
																if(is_array($stabletownarr)) {
																foreach($stabletownarr as $key=>$val) :	
																if($val['Town']['id']==$stabletownid) {
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
														<div class="clear"></div>
													</div>
													<input class="submit_btn_other" type="submit" value="Search"  name="stablesearch"/>
													<input class="submit_btn_other" type="button" value="Reset"  onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
												</div>
												<div class="po_inf_btm">&nbsp;</div>						
											</div>
										</span>	
										<span id="breedsearch" <?php if($searchcriteria=="Member")  { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
											<div class="profile_info_search" style="margin-top: 30px;">			
												<div class="po_inf_mid" style="margin: 18px 0 0;">
													<div class="form_box">
														<label class="formarea"> <strong>Name :</strong></label>
														<input name="breedername" id="breedername" type="text" size="30" <?php if($breedername!="") { ?> value="<?php e($breedername);?>" <?php }  else { e("value='enter breeder name'"); } ?> onFocus="if(this.value=='enter breeder name')this.value='';" onBlur="if(this.value=='')this.value='enter breeder name';"/>
														<div class="clear"></div>
													</div>
													<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
													<h3 class="xo">Filter Results</h3>	
													<div class="form_box">
														<label class="formarea"> <strong>Country:</strong></label>
														<select name="membercountry" class="dropdown98" id="membercountry" onChange="listmemberstate()">
															<option value="">Select Country </option>
															<?php
															if(is_array($country_arr)) {
															foreach($country_arr as $key=>$val) :	
															if($val['Country']['id']==$membercountry) {
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
														<div class="clear"></div>
													</div>
													<div class="form_box">
														<label class="formarea"> <strong>State:</strong></label>
														<span id="memstate">
															<select name="memberstate"  id="memberstate" class="dropdown98" onChange="listmembertownshow()">
																<option value=""></option>
																<?php
																if(is_array($memberstatearr)) {
																foreach($memberstatearr as $key=>$val) :	
																if($val['State']['id']==$_GET['memberstate']) {
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
														<div class="clear"></div>
													</div>					
													<div class="form_box">
														<label class="formarea"> <strong>Town/Region:</strong></label>
														<span id="memtown">
															<select name="membertown"  id="membertown" class="dropdown98">
																<option value=""></option>
																<?php
																if(is_array($membertownarr)) {
																foreach($membertownarr as $key=>$val) :	
																if($val['Town']['id']==$_GET['membertown']) {
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
														<div class="clear"></div>
													</div>	
													<input class="submit_btn_other" type="submit" value="Search" name="breedersearch"/>
													<input class="submit_btn_other" type="button" value="Reset" onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
												</div>
											</div>				
										</span>					
										<?php
										if($searchcriteria=='Horse') { 
										?>
										<span id="horsesearchresult"  style="display:block">
										<div class="profile_info">
										<div class="po_inf_mid">
										<?php
										if(count($horslistarr)>0) {
										if(is_array($horslistarr)) {
										foreach($horslistarr as $key=>$val):
										?>
										<div class="pannel">
											<div class="big1" style="width: 90px;">
												<?php
												$imagedirectory="horseimage";
												$image=$val['Horse']['image'];
												if($image!="") {
												if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],90,91);								
												?>									
												<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>
												<?php
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="91" height="91" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
												<?php
												}
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="91" height="91" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
												<?php
												}
												?>											
											</div>
											<div class="big2" style="width: 545px;"><p class="kits" style="width: 505px; padding-left: 20px; padding-right: 20px;">
												<span  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"><a href="javascript:void(0)"><?php e($val['Horse']['name']);?></a></span><br />
													<div style="float: left; width: 240px; padding-left: 20px;">
														<?php 
														$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
														e($gender['Gender']['gender']);
														?>
														<br />
														Year :
														<?php 
														if($val['Horse']['year']) {
														e($val['Horse']['year']);
														}
														else {
														e("NA");
														}									
														?>											
														<br>
														<?php 
														$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
														e($breedname);											
														?>											
													</div>
													<div style="float: left; width: 240px; margin-left: 25px;">
														<?php 
														if($val['Horse']['countryid']) {
														$countryname=$this->requestAction('/country/countryname/'.$val['Horse']['countryid']);
														e("".$countryname['Country']['country'].",  ");											
														}
														if($val['Horse']['state_id']) {
														$statename=$this->requestAction('/state/Statename/'.$val['Horse']['state_id']);
														e("".$statename['State']['statename'].",  ");											
														}											
														if($val['Horse']['town_id']) {
														$townname=$this->requestAction('/town/townname/'.$val['Horse']['town_id']);
														e($townname['Town']['town']);											
														}											
														?>
														<?php										
														e("<br>");
														e($val['Horse']['sire']);
														e("<br>");
														e($val['Horse']['dam']);
														?>
													</div>
													<div style="clear: both; line-height: 0; font-size: 0;"></div>
													</div>		
													<div class="big4">
														<input class="button-reyeng" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>
													</div>
													<div class="clear"></div>										
												</div>		
												<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
												<?php
												endforeach;
												}
												}
												else  {
												e("<div align=center><h3>There is no horse matching your search criteria</h3></br></div>");	
												}
												?>				
											</div>
										</div>	
										<?php
										if($pagistr!="") { 
										?>
										<div class="pagination">
											<ul>
												<?php
												e($prevpage);
												e($pagistr);				
												e($nextpage);?>
											</ul>
										</div>
									</span>
									<?php
									}
									?>
									<?php
									}	
									//e($searchcriteria);			
									if($searchcriteria!="") {
									?>
									<?php				
									}	
									if($searchcriteria!="") {
									?>
									<?php			
									}						
									?>			
								</form>		
							</div>
							</div>
							<div style="clear: both; line-height: 0; font-size: 0;"></div>
						</div>
						<div class="bottom">
							<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
						</div>
						<?php
						e($this->renderelement('frontfooter'));		
						?>	
	</body>
</html>
