<?php
e($this->renderelement('topheader'));
?>
<script language="javascript">
			function details(hornamename,horseid) {
				if(parseInt(horseid)) {
					window.location.href='<?php e($html->url('/horse/details/'));?>'+hornamename+'/'+horseid ;		
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
					<h1 class="top">View Horses For Sale</h1>		
					<form action="<?php e($html->url('/horse/salehorse'));?>" method="get" name="salehorse">
					<div class="profile_info">
						<div class="po_inf_up">&nbsp;</div>
						<div class="po_inf_mid">
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
														
							<div class="radio_box" style="padding-left: 25px; float: left; width: auto;">
								<input type="radio" value="S" name="salestaus" <?php if($salestaus=="S" || $salestaus=="" || $salestaus=="Sale" ) { ?> checked="checked" <?php } ?> ><a>Sale</a><br />
								<input type="radio" value="Stud" name="salestaus" <?php if($salestaus=="Stud") { ?> checked="checked" <?php } ?> ><a>Stud</a><br />
								<input class="submit_btn" type="submit" value="Search" name="search" />
							</div>
							<div class="clear"></div>
						</div>	
					</form>	
					
								
					<h1 class="top" style="width: auto;">Filter The Search Result </h1>
					<div class="link">						
						<ul>
							<li><a href="<?php e($html->url('/horse/salehorse'.$pagelink));?>&orderby=name">Name</a></li>
							<li>|</li>
							<li><a href="<?php e($html->url('/horse/salehorse'.$pagelink));?>&orderby=posted_date">Date</a></li>
							<li>|</li>
							<li><a href="<?php e($html->url('/horse/salehorse'.$pagelink));?>&orderby=price">Price</a></li>
						</ul>
					</div>			
					
							
					<div class="profile_info">
						<div class="po_inf_mid">
							<?php
							if(count($horslistarr)>0) {
									if(is_array($horslistarr)) {
										foreach($horslistarr as $key=>$val):
										if($salestaus=="S" || $salestaus=="Sale")  {
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
											<span>For :
											 <?php
											 e("<b>Sale</b>");								
											 ?></span>
											 <br>
											 <br /><span>Price :
											 <?php
											 if($val['Sale']['pricerange_fromid']) {
											 	$pricerange=$this->requestAction('/horse/pricerange/'.$val['Sale']['pricerange_fromid']);
												e($pricerange['Pricerange']['pricefrom']);
											 }	
											  e("--");		
											 //e($val['Sale']['pricerange_toid']);										 
											 if($val['Sale']['pricerange_toid']) {
											 	$pricerange=$this->requestAction('/horse/pricerange/'.$val['Sale']['pricerange_toid']);
												e($pricerange['Pricerange']['pricefrom']);
											 }								
											 ?></span>											
											<br><Span> Breed : <?php 
											$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
											e($breedname);											
											 ?>		
											 </Span>											 
											 <br> <br><Span> Gender :
											 <?php 
												$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
												e($gender['Gender']['gender']);  
											 ?>										 	
											 </Span>
											 </div>
											 <div style="float: left; width: 240px; margin-left: 25px;">
											 <span><?php 
											e($val['Sale']['salesdescription']);
											?></span>
											 </div>
											 <div style="clear: both; line-height: 0; font-size: 0;"></div>									
											 </p>
											 </div>		
											<div class="big4">
												<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>										
											</div>														
										</div>		
										<?php
										}										
										else {
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
											<span>For :
											 <?php
											 e("<b>Stud</b>");								
											 ?></span>
											 <br>
											 <span>Year :
											 <?php 
												if($val['Horse']['year']) {
													e($val['Horse']['year']);
												}
												else {
													e("NA");
												}									
											 ?></span>
											 <br /><span>Price :
											  <?php
											 if($val['Stud']['pricerange_fromid']) {
											 	$pricerange=$this->requestAction('/horse/pricerange/'.$val['Stud']['pricerange_fromid']);
												e($pricerange['Pricerange']['pricefrom']);
											 }	
											 e("--");		
											 //e($val['Sale']['pricerange_toid']);										 
											 if($val['Stud']['pricerange_toid']) {
											 	$pricerange=$this->requestAction('/horse/pricerange/'.$val['Stud']['pricerange_toid']);
												e($pricerange['Pricerange']['pricefrom']);
											 }								
											 ?></span>											
											<br><Span> Breed : <?php 
											$breedname=$this->requestAction('/horse/breedname/'.$val['Horse']['breed_id']);
											e($breedname);											
											 ?>		
											 </Span>											 
											 <br><Span> Gender :
											 <?php 
												$gender=$this->requestAction('/horse/gendername/'.$val['Horse']['gender']);
												e($gender['Gender']['gender']);  
											 ?>										 	
											 </Span>
											 </div>
											 <div style="float: left; width: 240px; margin-left: 25px;">
											 <span><?php 
											e($val['Sale']['salesdescription']);
											e("<br>");
											e($val['Horse']['sire']);
											e("<br>");
											e($val['Horse']['dam']);
											?></span>
											 </div>
											 <div style="clear: both; line-height: 0; font-size: 0;"></div>
											 </p>
											 </div>		
											<div class="big4">
												<input class="submit_btn9" type="button" value="View"  onClick="details('<?php e(str_replace(" ", "-",$val['Horse']['name']));?>','<?php e($val['Horse']['id']);?>')"/>										
											</div>														
										</div>
										<img class="line1" src="<?php e($this->webroot);?>img/line1.jpg" alt="" />	
										<?php
										}
										endforeach;
									}
								}
								else  {
									e("<div align=center><font color=#FF0000><em><b>Sorry! No horse found from database </b></em></font></div>");	
								}
							//}
							?>				
							<div>&nbsp;</div>													
						</div>
						<div class="po_inf_btm">&nbsp;</div>						
					</div>	
					</div>
					<div style="clear: both; line-height: 0; font-size: 0;"></div>
					<?php
					if($searchcondition=='yes') {
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
					}
					?>
			  </div>				
				<div class="bottom">
					<img src="<?php e($this->webroot);?>img//sub_body_footer.png" alt="" />
				</div>
			</div>
		</div>		
		<?php
		e($this->renderelement('frontfooter'));		
		?>
	</div>
		
</body>
</html>
