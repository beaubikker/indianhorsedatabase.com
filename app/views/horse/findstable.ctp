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
	function findhorse() {
		window.location.href='<?php e($html->url('/horse/findahorse/'));?>';
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
		
	}
	function stablesearchtab() {
		
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
						
								</div>
						<form action="" method="get" name="frm"">
							<span id="stablehearch" <?php if($searchcriteria=="Stable") { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
								<div class="profile_info">
									<div class="po_inf_mid">
										<div class="searchnamegenderboxreyeng">
											<div align="center">
												<label class="formarea">Name:</label>
												<input class="visson" name="stablename"  id="stablename" <?php if($stablename!="") { ?> value="<?php e($stablename);?>" <?php }  else { e("value='enter stable name'"); } ?> type="text" size="30" value="enter stable name" onFocus="if(this.value=='enter stable name')this.value='';" onBlur="if(this.value=='')this.value='enter stable name';"/>
												<div class="clear"></div>
											</div>
										</div>
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
										<h3 class="xo">Filter Results</h3>
										<div class="fonto">
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
													<label class="formarea">Country:</label>
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
											</div>
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
													<label class="formarea">State:</label>
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
											</div>
											<div class="form_box59">
												<div class="searchfilterwrapperreyeng">
												<label class="formarea">Town/Region:</label>
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
											</div>
											<div class="clear"></div>
										</div>
										<input class="button-reyeng" type="submit" value="Search"  name="stablesearch"/>
										<input class="button-reyeng" type="button" value="Reset"  onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
									</div>						
								</div>
							</span>	
							<?php
							if($searchcriteria!="") {
							?>
							<span id="stablesearchresult"  style="display:block">
								<div class="profile_info top-margin">
									<div class="po_inf_mid">
										<?php
										if(count($horslistarr)>0) {
										if(is_array($horslistarr)) {
										foreach($horslistarr as $key=>$val):
										?>
										<div class="pannel">
											<div class="big1" style="width: 90px;">
												<?php
												$imagedirectory="stable_image";
												$image=$val['Stable']['stable_image'];
												if($image!="") {
												if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
												$xy = $rsz->imgResize(rootpth()."stable_image/".$image,90,91);								
												?>									
												<img src="<?php e($this->webroot);?>img/stable_image/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>"  onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91" onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												}
												else {
												?>
												<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91" onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer">
												<?php
												}
												?>											
											</div>
											<div class="big2" style="width: 130px;">
												<p class="kits">
													<span onClick="stabledetails('<?php e($val['Stable']['id']);?>')" style="cursor:pointer"><?php e($val['Stable']['stable_name']);?>
													</span><br />
													
												</p>
											</div>
											<div class="big3">
												<p class="axe"><?php e(substr($val['Stable']['about'],0,300));?></p>
											</div>		
											<div class="big4">
												<input class="button-reyeng" type="button" value="View"  onClick="stabledetails('<?php e($val['Stable']['id']);?>')"/>										
											</div>														
										</div>		
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
										<?php
										endforeach;
										}
										}
										else  {
										e("<div align=center><h3>There is no stable matching your search criteria</h3></br></div>");	
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
								<?php
								}
								?>
							</span>
							<?php				
							}	
							?>			
						</form>		
					</div>
				<div style="clear: both; line-height: 0; font-size: 0;"></div>
			</div>
		</div>
		<div class="bottom">
			<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
		</div>
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
	</body>
</html>
