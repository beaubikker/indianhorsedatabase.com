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
		
	}
	function resetstableinfo() {
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
								<form action="" method="get" name="frm">
									<span id="horsesearch"  <?php if($searchcriteria==""|| $searchcriteria=="Horse") { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>							
										<div class="profile_info">													
											<div class="po_inf_mid">
														<div id="searchnamefiltercontainerreyeng"> 
														
														<input class="mainsearchfieldreyeng" name="horsename" id="horsename" type="text" <?php if($horsename!="") { ?> value="<?php e($horsename);;?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Enter name')this.value='';" onBlur="if(this.value=='')this.value='Enter name';" />
													
														<div class="fonto">		
														<div class="form_box59">
														
														<div class="searchfilterwrapperreyeng">
														<select name="gender" id="gender" size="1" class="dropdown98">
															<option selected="selected" value="">Gender</option>
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
													
													<div class="searchfilterwrapperreyeng">
																<select name="breed" id="breed" size="1" class="dropdown98">
																	<option selected="selected" value="">Breed</option>
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
																<select name="color"  id="color" size="1" class="dropdown98">
																<option selected="selected" value="">Color</option>
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
																</div>						
						</div>						
														</div>
														</div>	
														
																							
														<div id="siredamsearchboxreyeng">
														<div class="siresearchboxreyeng">
																							
																<input class="visson" name="sire" id="sire" type="text" <?php if($sire!="") { ?> value="<?php e($sire);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Sire')this.value='';" onBlur="if(this.value=='')this.value='Sire';"/>
																<div class="clear"></div>
																</div>
																<div class="damsearchboxreyeng">
																<input class="visson" name="dam" id="dam" type="text" <?php if($dam!="") { ?> value="<?php e($dam);?>" <?php }  else { e("value='Enter name'"); } ?> onFocus="if(this.value=='Dam')this.value='';" onBlur="if(this.value=='')this.value='Sire';"/>
																
																<div class="clear"></div>
														
														</div>
														</div>

															</div>				
															<div class="reset-searchbuttonwrapperreyeng">
															
															<input class="button-reyeng reset" type="button" value="List all horses"  name="resethorseinfo" onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
															<input class="button-reyeng" type="submit" value="Search"  name="horsesearch"/>
															</div>			
														</div>
																				
											</div>
																			
										</span>		
										<?php
										if($searchcriteria=='Horse') { 
										?>
										<span id="horsesearchresult"  style="display:block">
										<div class="profile_info">
										<div class="po_inf_mid">
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />	
										<?php
										if(count($horslistarr)>0) {
										if(is_array($horslistarr)) {
										foreach($horslistarr as $key=>$val):
										?>
											<div id="horsesearchresultwrapperreyeng">
												<div class="horseserachresultsdetailsimagereyeng">
												<?php
												$imagedirectory="horseimage";
												$image=$val['Horse']['image'];
												if($image!="") {
												if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."horseimage/".$val['Horse']['image'],103,103);								
												?>									
												<img src="<?php e($this->webroot);?>img/horseimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>
												<?php
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="103" height="103" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
												<?php
												}
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="103" height="103" style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
												<?php
												}
												?>		
												</div>									
											<div class="horsesearchresultsdetailswrapperreyeng">
												<div class="horsesearchresultdetailsnamegenderbreedreyeng">
												<div id="horsesearchresultdetailsiredamreyeng">
														<div class="horsesearchresultdetailssirereyeng">
															<h3>
																<?php										
																e($val['Horse']['sire']);
																?>
															</h3>
														</div>
														<div class="horsesearchresultdetailsdamreyeng">
															<h3>
															
															
															
																<?php
																 e($val['Horse']['dam_id']);
																 ?>	
															</h3>
														</div>
														<div class="clear"></div>
													</div>			
													<div class="horsesearchresultdetailsreyeng name">
														<span  style="cursor:pointer" onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')">
															<a class="name" href="javascript:void(0)"><?php e($val['Horse']['name']);?>
															</a>
															<br>
															</span>
														</div>
														<div class="horsesearchresultdetailsreyeng">
															<?php 
															$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
															e($gender['Gender']['gender']);
															?>	
														</div>								
														<div class="horsesearchresultdetailsreyeng">
															<?php 
															$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
															e($breedname);											
															?>
														</div>	
																					
													</div>
													
														<input class="button-reyeng small searchresults" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>
														</div>
													<div style="clear: both; line-height: 0; font-size: 0;"></div>
													</div>		

												<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
												<?php
												endforeach;
												}
												}
												else  {
												e("<div align=center><h3>There is no horse matching your search criteria</h3><br></br></div>");	
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
