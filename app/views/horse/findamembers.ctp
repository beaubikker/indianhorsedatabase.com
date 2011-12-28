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
					<!-- added on 23.6 -->
					<!--<div>-->	
					<div style="float: left; width: 762px;">
					<!-- added on 23.6 -->		
					<div id="searchthreecolumntabsreyeng">
						<div <?php if($searchcriteria==""|| $searchcriteria=="Horse") { ?>class="personal_info22_active" <?php } else { ?> class="personal_info22" <?php } ?> id="horsearchtb" onClick="findhorse()">Horses</div>
						<div <?php if($searchcriteria=="Stable")  { ?> class="payment_details22_active" <?php } else { ?> class="payment_details22" <?php } ?> id="stablesearchtb" onClick="gotostable()" >Stables</div>
						<div <?php if($searchcriteria=="Member")  { ?> class="email_confirmation22_active" <?php } else { ?> class="email_confirmation22" <?php } ?> id="breedersearchtb" onClick="findmembers()">Members</div>
					</div>
							<form action="" method="get" name="frm">


					<span id="breedsearch" <?php if($searchcriteria=="Member")  { ?> style="display:block" <?php } else { ?> style="display:none" <?php } ?>>
						<div class="profile_info_search">			
						<div class="po_inf_mid">
								<div class="searchnamegenderboxreyeng">
									<div class="searchfilterwrapperreyeng float_left">
										<label class="formarea">Name:</label>
										<input class="visson" name="breedername" id="breedername" type="text" size="30" <?php if($breedername!="") { ?> value="<?php e($breedername);?>" <?php }  else { e("value='enter breeder name'"); } ?> onFocus="if(this.value=='enter breeder name')this.value='';" onBlur="if(this.value=='')this.value='enter breeder name';"/>
										<div class="clear"></div>
									</div>
								</div>
							<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />
						<div>&nbsp;</div>
						<h3 class="xo">Filter Results</h3>	
						<div>&nbsp;</div>
						
						<div class="form_box59">
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
						<div class="form_box59">
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
						<div class="form_box59">
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
						<div class="clear"></div>	
						
						<input class="submit_btn_other" type="submit" value="Search" name="breedersearch"/>
						<input class="submit_btn_other" type="button" value="Reset" onClick="window.location.href='<?php e($html->url('/horse/findahorse'));?>'"/>
						<div>&nbsp;</div>
						<div>&nbsp;</div>
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>				
					</span>					
								<div class="po_inf_btm">&nbsp;</div>						
				<?php
				if($searchcriteria=='Member') {}	
				//e($searchcriteria);			
				if($searchcriteria!="") {
				 ?>
				 		<span id="membersearch" style="display:block">
						<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
							<?php
							if(count($horslistarr)>0) {
								if(is_array($horslistarr)) {
									foreach($horslistarr as $key=>$val):
									?>
										<div class="pannel">
											<div class="big1" style="width: 90px;">
												<?php
												$imagedirectory="profileimage";
												$image=$val['User']['image'];
												if($image!="") {
													if(file_exists(rootpth()."/".$imagedirectory."/".$image)) {
														$xy = $rsz->imgResize(rootpth()."profileimage/".$image,90,91);								
														?>									
														<img src="<?php e($this->webroot);?>img/profileimage/<?php e($image);?>" alt="" width="<?php e($xy[0]);?>"  height="<?php e($xy[1]);?>">
													<?php
													}
													else {
														?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
														<?php
													}
												}
												else {
													?>
														<img src="<?php e($this->webroot);?>img/noimage.jpg" alt="" width="90" height="91">
													<?php
												}
												?>											
											</div>
											<div class="big2" style="width: 130px;"><p class="kits"><?php e($val['User']['firstname']);?><br /><span>Date: <?php e(date('F Y', strtotime($val['User']['registered_date']))); ?></span></p></div>
											<div class="big3"><p class="axe"><?php e(substr($val['User']['about_me'],0,300));?></p></div>		
											<div class="big4">
												<input class="submit_btn9" type="button" value="View"  onClick="userdetails('<?php e(base64_encode($val['User']['id']));?>')"/>										
											</div>														
										</div>		
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />		
									<?php
									endforeach;
								}
							}
							else  {
								e("<div align=center><font color=#FF0000><em><b>Sorry! No user found from database </b></em></font></div>");	
							}
							?>				
							<div>&nbsp;</div>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
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
				 <!-- added on 23.6 -->
				 <!--<div class="bottom">
					<img src="<?php //e($this->webroot);?>img/sub_body_footer.png" alt="" />
				</div>-->
				<!-- added on 23.6 -->				
			 </form>		
		
	</div>
	<!-- added on 23.6 -->
	<div style="clear: both; line-height: 0; font-size: 0;"></div>
	<!-- added on 23.6 -->
	</div>
	<!-- added on 23.6 -->
	<div class="bottom">
		<img src="<?php e($this->webroot);?>img/sub_body_footer.png" alt="" />
	</div>
	<!-- added on 23.6 -->	 
		<?php
		e($this->renderelement('frontfooter'));		
		?>	
</body>
</html>
